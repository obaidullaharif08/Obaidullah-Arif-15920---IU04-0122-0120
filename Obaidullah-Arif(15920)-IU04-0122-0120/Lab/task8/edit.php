<?php
include "db.php";
include "header.php";

if (!isset($_GET['id'])) {
    header("Location: product.php");
    exit;
}

$id = $_GET['id'];

// Fetch current product data
$result = mysqli_query($conn, "SELECT * FROM products WHERE id = $id");
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

    mysqli_query($conn, "UPDATE products SET Name='$name', Type='$type', Company='$company', Price='$price' WHERE id=$id");

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
