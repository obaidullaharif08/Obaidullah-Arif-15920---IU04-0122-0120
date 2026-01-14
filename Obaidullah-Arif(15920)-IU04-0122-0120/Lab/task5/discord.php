<?php
session_start();

$valid_email = "user@example.com";
$valid_password = "password123"; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email == $valid_email && $password == $valid_password) {
        $_SESSION['email'] = $email;
        header("Location: dashboard.php"); 
    } else {
        $error_message = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Failed</title>
</head>
<body>
    <?php if (isset($error_message)) { echo "<p style='color: red;'>" . $error_message . "</p>"; } ?>
    <p><a href="index.html">Try Again</a></p>
</body>
</html>
