<?php
include "db.php";
include "header.php"; 

if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    mysqli_query($conn, "DELETE FROM products WHERE id = $id");
    header("Location: product.php");
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM products");
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<h2>Products List</h2>

<table border="1" width="100%" style="text-align:center;">
    <tr>
        <th>Name</th>
        <th>Type</th>
        <th>Company</th>
        <th>Price</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($data as $row) { ?>
        <tr>
            <td><?php echo $row['Name']; ?></td>
            <td><?php echo $row['Type']; ?></td>
            <td><?php echo $row['Company']; ?></td>
            <td><?php echo $row['Price']; ?></td>
            <td>
                    <a href="edit.php?id=<?php echo $row['id']; ?>" style="color:blue; text-decoration:none; margin-right:10px;">Edit</a>
                    <a href="product.php?delete_id=<?php echo $row['id']; ?>" 
                       onclick="return confirm('Are you sure you want to delete this product?');" 
                       style="color:red; text-decoration:none;">Delete</a>
                </td>
        </tr>
    <?php } ?>
</table>

<?php include "footer.php"; ?>