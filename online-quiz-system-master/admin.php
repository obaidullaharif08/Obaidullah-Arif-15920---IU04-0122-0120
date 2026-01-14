<?php
session_start();
include_once 'dbConnection.php';

$ref = isset($_GET['q']) ? $_GET['q'] : 'index.php';

if (!isset($_POST['uname'], $_POST['password'])) {
    header("location:$ref?w=Invalid request");
    exit();
}

$username = trim($_POST['uname']);
$password = $_POST['password'];

if ($username === '' || $password === '') {
    header("location:$ref?w=Access denied");
    exit();
}

// CHANGE THIS VARIABLE IF NEEDED
$db = isset($con) ? $con : $conn;

$stmt = $db->prepare("SELECT password FROM admin WHERE username=?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    header("location:$ref?w=Access denied");
    exit();
}

$row = $result->fetch_assoc();

// TEMPORARY PLAINTEXT CHECK (FOR DEBUG)
if ($row['password'] !== $password && !password_verify($password, $row['password'])) {
    header("location:$ref?w=Access denied");
    exit();
}

// SUCCESS
session_unset();
$_SESSION['username'] = $username;
$_SESSION['name'] = 'Admin';
$_SESSION['key'] =
'54585c506829293a2d4c3b68543b316e2e7a2d277858545a36362e5f39';

header("location:dash.php");
exit();
