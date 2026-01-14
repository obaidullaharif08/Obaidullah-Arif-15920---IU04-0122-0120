<?php
session_start();
if (isset($_SESSION["username"])) {
    session_destroy();
}
include_once 'dbConnection.php';
$ref      = isset($_GET['q']) ? $_GET['q'] : 'index.php';
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

if ($username === '' || $password === '') {
    header("location:$ref?w=Wrong Username or Password");
    exit();
}

// Use prepared statement to fetch stored password hash
$stmt = $con->prepare('SELECT name, password FROM user WHERE username = ? LIMIT 1');
if (!$stmt) {
    header("location:$ref?w=Server error");
    exit();
}
$stmt->bind_param('s', $username);
$stmt->execute();
$res = $stmt->get_result();
if ($res && $res->num_rows === 1) {
    $row = $res->fetch_assoc();
    $stored = $row['password'];
    $name = $row['name'];
    $verified = false;

    // If stored hash looks like a modern password_hash value, use password_verify
    if (password_verify($password, $stored)) {
        $verified = true;
    } else {
        // Fallback for existing md5-stored passwords: compare md5 and migrate
        if (strlen($stored) === 32 && md5($password) === $stored) {
            $verified = true;
            // Migrate to password_hash
            $newhash = password_hash($password, PASSWORD_DEFAULT);
            $up = $con->prepare('UPDATE user SET password = ? WHERE username = ?');
            if ($up) {
                $up->bind_param('ss', $newhash, $username);
                $up->execute();
                $up->close();
            }
        }
    }

    if ($verified) {
        $_SESSION["name"]     = $name;
        $_SESSION["username"] = $username;
        header("location:account.php?q=1");
        exit();
    }
}
header("location:$ref?w=Wrong Username or Password");
?>