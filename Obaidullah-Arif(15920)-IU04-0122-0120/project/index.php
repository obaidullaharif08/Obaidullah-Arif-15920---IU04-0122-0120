<?php
session_start();
if(isset($_SESSION['username']) && (!isset($_SESSION['key']))){
   header('location:account.php?q=1');
}
else if(isset($_SESSION['username']) && isset($_SESSION['key']) && $_SESSION['key'] == '54585c506829293a2d4c3b68543b316e2e7a2d277858545a36362e5f39'){
   header('location:dash.php?q=0');
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Quizzer</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="icon" href="favicon.ico">
<link rel="stylesheet" href="css/bootstrap.min.css"/>
<link rel="stylesheet" href="css/bootstrap-theme.min.css"/>
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700,300" rel="stylesheet">

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- ================= CUSTOM STYLING ================= -->
<style>
body {
    font-family: 'Roboto', sans-serif;
    background: linear-gradient(120deg, #000000, #111111);
    min-height: 100vh;
    margin: 0;
}

.logo {
    color: #ffffff;
    font-size: 28px;
    font-weight: 700;
}

.logb {
    background: transparent;
    border: 1px solid #ffffff;
    color: #ffffff;
    border-radius: 8px;
    padding: 6px 18px;
}

.logb:hover {
    background: #ffffff;
    color: #000000;
}

.bg1 {
    padding: 70px 40px;
}

.bg1 .col-md-7 {
    padding-top: 120px;
    color: #ffffff;
}

.bg1 .col-md-7::before {
    content: "Online Quiz Platform";
    display: block;
    font-size: 44px;
    font-weight: 700;
    margin-bottom: 15px;
}

.bg1 .col-md-7::after {
    content: "Register now and participate in secure, fast and smart quizzes.";
    font-size: 16px;
    color: #cccccc;
}

.panel {
    background: #ffffff;
    border-radius: 12px;
    padding: 30px 35px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.4);
}

.panel h3 {
    font-weight: 700;
    margin-bottom: 20px;
    color: #333333;
}

.form-control {
    height: 44px;
    border-radius: 8px;
    border: 1px solid #dddddd;
}

.form-control:focus {
    border-color: #4f46e5;
    box-shadow: 0 0 0 1px #4f46e5;
}

.btn-primary {
    width: 100%;
    height: 44px;
    font-weight: 600;
    background: #4f46e5;
    border: none;
    border-radius: 8px;
}

.btn-primary:hover {
    background: #4338ca;
}

#errormsg {
    text-align: center;
    color: red;
    margin-bottom: 10px;
}

/* ===== FOOTER ===== */
.footer {
    padding: 25px 0;
    text-align: center;
}

.footer a {
    color: #dddddd;
    margin: 0 10px;
    text-decoration: none;
}

.footer a:hover {
    color: #ffffff;
    text-decoration: underline;
}

.modal-content {
    border-radius: 12px;
}
</style>
<!-- ================= END STYLING ================= -->

<script>
function validateForm() {
  var y = document.forms["form"]["name"].value;
  if (y == "") { document.getElementById("errormsg").innerHTML="Name must be filled out."; return false; }

  var br = document.forms["form"]["branch"].value;
  if (br == "") { document.getElementById("errormsg").innerHTML="Please select your branch"; return false; }

  var rn = document.forms["form"]["rollno"].value.split("/");
  if (rn.length != 3) { document.getElementById("errormsg").innerHTML="Incorrect Roll Number format"; return false; }

  var g = document.forms["form"]["gender"].value;
  if (g=="") { document.getElementById("errormsg").innerHTML="Please select gender"; return false; }

  var x = document.forms["form"]["username"].value;
  if (x.length < 4) { document.getElementById("errormsg").innerHTML="Username must be at least 4 characters"; return false; }

  var m = document.forms["form"]["phno"].value;
  if (m.length != 11) { document.getElementById("errormsg").innerHTML="Phone must be 11 digits"; return false; }

  var a = document.forms["form"]["password"].value;
  var b = document.forms["form"]["cpassword"].value;
  if (a.length < 5 || a.length > 15) { document.getElementById("errormsg").innerHTML="Password must be 5–15 characters"; return false; }
  if (a != b) { document.getElementById("errormsg").innerHTML="Passwords do not match"; return false; }
}
</script>
</head>

<body>

<!-- ===== HEADER ===== -->
<div class="header">
    <div class="row">
        <div class="col-md-6">
            <span class="logo">Quizzer</span>
        </div>
        <div class="col-md-6 text-right">
            <a href="#" class="btn logb" data-toggle="modal" data-target="#myModal">Login</a>
        </div>
    </div>
</div>

<!-- ===== MAIN ===== -->
<div class="bg1">
<div class="row">

<div class="col-md-7"></div>

<div class="col-md-4 panel">
<form name="form" action="sign.php?q=account.php" method="POST" onsubmit="return validateForm()">
<h3 align="center">Create Account</h3>

<div id="errormsg"></div>

<input class="form-control" name="name" placeholder="Full Name"><br>
<input class="form-control" name="rollno" placeholder="Roll No (BE/10XXX/YY)"><br>

<select class="form-control" name="gender">
<option value="">Select Gender</option>
<option value="M">Male</option>
<option value="F">Female</option>
</select><br>

<select class="form-control" name="branch">
<option value="">Select Branch</option>
<option value="CSE">Computer Science</option>
<option value="ECE">Electronics</option>
<option value="EEE">Electrical</option>
<option value="IT">IT</option>
</select><br>

<input class="form-control" name="username" placeholder="Username"><br>
<input class="form-control" name="phno" placeholder="Mobile Number"><br>
<input class="form-control" type="password" name="password" placeholder="Password"><br>
<input class="form-control" type="password" name="cpassword" placeholder="Confirm Password"><br>

<button type="submit" class="btn btn-primary">Register Now</button>
</form>
</div>

</div>
</div>

<!-- ===== FOOTER ===== -->
<div class="footer">
    <a href="feedback.php">Feedback</a> |
    <a href="about.php">About Quizzer</a> |
    <a href="#" data-toggle="modal" data-target="#adminModal">Admin Login</a>
</div>

<!-- ===== USER LOGIN MODAL ===== -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Login</h4>
      </div>
      <div class="modal-body">
        <form action="login.php?q=index.php" method="POST">
          <input class="form-control" name="username" placeholder="Username"><br>
          <input class="form-control" type="password" name="password" placeholder="Password"><br>
          <button class="btn btn-primary">Login</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- ===== ADMIN LOGIN MODAL ===== -->
<div class="modal fade" id="adminModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Admin Login</h4>
      </div>
      <div class="modal-body">
        <form action="admin.php?q=index.php" method="POST">
          <input class="form-control" name="uname" placeholder="Admin Username"><br>
          <input class="form-control" type="password" name="password" placeholder="Admin Password"><br>
          <button class="btn btn-primary">Login</button>
        </form>
      </div>
    </div>
  </div>
</div>

</body>
</html>
