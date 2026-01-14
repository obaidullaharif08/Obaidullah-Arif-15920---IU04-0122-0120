<?php
include "db.php";
include "header.php";

if (!isset($_GET['id'])) {
    header("Location: product.php");
    exit;
}

$id = intval($_GET['id']);

$stmt = mysqli_prepare($conn, "SELECT * FROM products WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$product = mysqli_fetch_assoc($result);

if (!$product) {
    echo "Product not found!";
    exit;
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $company = $_POST['company'];
    $price = $_POST['price'];

    $update = mysqli_prepare(
        $conn,
        "UPDATE products SET Name=?, Type=?, Company=?, Price=? WHERE id=?"
    );
    mysqli_stmt_bind_param($update, "sssdi", $name, $type, $company, $price, $id);
    mysqli_stmt_execute($update);

    header("Location: product.php");
    exit;
}
?>


<h2>Edit Product</h2>

<form method="post">
    <label>Name:</label><br>
    <input type="text" name="name" value="<?php echo htmlspecialchars($product['Name']); ?>" required><br><br>

    <label>Type:</label><br>
    <input type="text" name="type" value="<?php echo htmlspecialchars($product['Type']); ?>" required><br><br>

    <label>Company:</label><br>
    <input type="text" name="company" value="<?php echo htmlspecialchars($product['Company']); ?>" required><br><br>

    <label>Price:</label><br>
    <input type="number" name="price" value="<?php echo htmlspecialchars($product['Price']); ?>" required><br><br>

    <button type="submit" name="submit">Update Product</button>
</form>

<?php include "footer.php"; ?>
