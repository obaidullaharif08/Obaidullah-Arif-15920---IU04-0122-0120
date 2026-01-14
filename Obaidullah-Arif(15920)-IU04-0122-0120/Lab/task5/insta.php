<?php
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($email == "" || $fullname == "" || $username == "" || $password == "") {
        $error = "All fields are required.";
    } else {
        $success = "Account created successfully!";
    }
}
?>
