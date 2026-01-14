<?php
include_once 'dbConnection.php';
ob_start();

// Extract and basic server-side validation
$name     = isset($_POST['name']) ? trim($_POST['name']) : '';
$gender   = isset($_POST['gender']) ? trim($_POST['gender']) : '';
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$phno     = isset($_POST['phno']) ? trim($_POST['phno']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$cpassword = isset($_POST['cpassword']) ? $_POST['cpassword'] : '';
$branch   = isset($_POST['branch']) ? trim($_POST['branch']) : '';
$rollno   = isset($_POST['rollno']) ? trim($_POST['rollno']) : '';

$name = ucwords(strtolower($name));

session_start();
// Required fields (now phone number is required and must be 11 digits)
if ($name === '' || $username === '' || $password === '' || $cpassword === '' || $rollno === '' || $branch === '' || $gender === '' || $phno === '') {
    $_SESSION['flash_q7'] = 'All fields are required.';
    $_SESSION['prefill'] = array('name' => $name, 'username' => $username, 'gender' => $gender, 'phno' => $phno, 'branch' => $branch, 'rollno' => $rollno);
    header('location:index.php');
    ob_end_flush();
    exit();
}

// Password checks
if ($password !== $cpassword) {
    $_SESSION['flash_q7'] = 'Passwords do not match.';
    $_SESSION['prefill'] = array('name' => $name, 'username' => $username, 'gender' => $gender, 'phno' => $phno, 'branch' => $branch, 'rollno' => $rollno);
    header('location:index.php');
    ob_end_flush();
    exit();
}
if (strlen($password) < 5 || strlen($password) > 100) {
    $_SESSION['flash_q7'] = 'Password must be between 5 and 100 characters.';
    $_SESSION['prefill'] = array('name' => $name, 'username' => $username, 'gender' => $gender, 'phno' => $phno, 'branch' => $branch, 'rollno' => $rollno);
    header('location:index.php');
    ob_end_flush();
    exit();
}

// Phone number check (digits only, exactly 11)
if (!ctype_digit($phno) || strlen($phno) !== 11) {
    $_SESSION['flash_q7'] = 'Phone number must be exactly 11 digits.';
    $_SESSION['prefill'] = array('name' => $name, 'username' => $username, 'gender' => $gender, 'phno' => $phno, 'branch' => $branch, 'rollno' => $rollno);
    header('location:index.php');
    ob_end_flush();
    exit();
}

// Prepare statements to prevent SQL injection and check duplicates
$stmt = $con->prepare('SELECT username, rollno FROM user WHERE rollno = ? OR username = ?');
if (!$stmt) {
    $_SESSION['flash_q7'] = 'Server error. Try again later.';
    header('location:index.php');
    ob_end_flush();
    exit();
}
$stmt->bind_param('ss', $rollno, $username);
$stmt->execute();
$res = $stmt->get_result();
if ($res && $res->num_rows > 0) {
    $row = $res->fetch_assoc();
    $conflictMsg = 'Username or roll number already exists. Please choose another.';
    if (isset($row['rollno']) && $row['rollno'] == $rollno) {
        $conflictMsg = 'Roll number already registered.';
    } elseif (isset($row['username']) && $row['username'] == $username) {
        $conflictMsg = 'Username already exists.';
    }
    $_SESSION['flash_q7'] = $conflictMsg;
    $_SESSION['prefill'] = array('name' => $name, 'username' => $username, 'gender' => $gender, 'phno' => $phno, 'branch' => $branch, 'rollno' => $rollno);
    header('location:index.php');
    ob_end_flush();
    exit();
}
$stmt->close();

// Hash password using PHP's password_hash
$password_hashed = password_hash($password, PASSWORD_DEFAULT);

// Insert new user with prepared statement (explicit columns)
$ins = $con->prepare('INSERT INTO user (name, rollno, branch, gender, username, phno, password) VALUES (?, ?, ?, ?, ?, ?, ?)');
if (!$ins) {
    $_SESSION['flash_q7'] = 'Server error. Try again later.';
    $_SESSION['prefill'] = array('name' => $name, 'username' => $username, 'gender' => $gender, 'phno' => $phno, 'branch' => $branch, 'rollno' => $rollno);
    header('location:index.php');
    ob_end_flush();
    exit();
}
$ins->bind_param('sssssss', $name, $rollno, $branch, $gender, $username, $phno, $password_hashed);
$exec = $ins->execute();
if ($exec) {
    $_SESSION["username"] = $username;
    $_SESSION["name"]     = $name;
    header("location:account.php?q=1");
} else {
    $_SESSION['flash_q7'] = 'Registration failed. Please try again.';
    $_SESSION['prefill'] = array('name' => $name, 'username' => $username, 'gender' => $gender, 'phno' => $phno, 'branch' => $branch, 'rollno' => $rollno);
    header('location:index.php');
}
$ins->close();
ob_end_flush();
?>