<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<link rel="icon" href="favicon.ico" type="image/icon" sizes="16x16">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Quizzer | Feedback</title>

<link rel="stylesheet" href="css/bootstrap.min.css"/>
<link rel="stylesheet" href="css/bootstrap-theme.min.css"/>
<link rel="stylesheet" href="css/font.css">

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

<?php
if (@$_GET['w']) {
    echo '<script>alert("' . @$_GET['w'] . '");</script>';
}
?>

<!-- ================= CUSTOM STYLING ================= -->
<style>
body {
    font-family: 'Roboto', sans-serif;
    background: linear-gradient(120deg, #000000, #111111);
    min-height: 100vh;
    margin: 0;
}

/* ===== HEADER ===== */
.header {
    padding: 15px 30px;
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
    padding: 6px 16px;
    font-size: 12px;
}

.logb:hover {
    background: #ffffff;
    color: #000000;
}

/* ===== CONTENT ===== */
.bg1 {
    padding: 60px 0;
}

.panel {
    background: #ffffff;
    border-radius: 12px;
    padding: 35px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.4);
}

/* ===== TITLE ===== */
.panel h2 {
    font-weight: 700;
    color: #333333;
    margin-bottom: 25px;
}

/* ===== FORM ===== */
.form-control {
    border-radius: 8px;
    height: 44px;
    border: 1px solid #dddddd;
}

textarea.form-control {
    height: auto;
}

.form-control:focus {
    border-color: #4f46e5;
    box-shadow: 0 0 0 1px #4f46e5;
}

/* ===== BUTTON ===== */
.btn-primary {
    background: #4f46e5;
    border: none;
    border-radius: 8px;
    padding: 10px 30px;
    font-weight: 600;
}

.btn-primary:hover {
    background: #4338ca;
}

/* ===== FOOTER ===== */
.footer {
    padding: 25px 0;
    text-align: center;
}

.footer span,
.footer a {
    color: #dddddd;
    font-size: 14px;
    text-decoration: none;
}

.footer a:hover {
    color: #ffffff;
    text-decoration: underline;
}

/* ===== MODAL ===== */
.modal-content {
    border-radius: 12px;
}
</style>
<!-- ================= END STYLING ================= -->

</head>

<body>

<!-- ===== HEADER ===== -->
<div class="row header">
    <div class="col-md-6">
        <span class="logo">Quizzer</span>
    </div>
    <div class="col-md-6 text-right">
        <?php
        include_once 'dbConnection.php';
        session_start();
        if ((!isset($_SESSION['username']))) {
            echo '<a href="#" class="logb btn" data-toggle="modal" data-target="#myModal">
            <span class="glyphicon glyphicon-log-in"></span> Login</a>&nbsp;';
        } else {
            echo '<a href="logout.php?q=feedback.php" class="logb btn">
            <span class="glyphicon glyphicon-log-out"></span> Logout</a>&nbsp;';
        }
        ?>
        <a href="index.php" class="logb btn">
            <span class="glyphicon glyphicon-home"></span> Home
        </a>
    </div>
</div>

<!-- ===== LOGIN MODAL ===== -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Login to your Account</h4>
      </div>
      <div class="modal-body">
        <form action="login.php?q=index.php" method="POST">
          <div class="form-group">
            <input name="username" class="form-control" placeholder="Username" required>
          </div>
          <div class="form-group">
            <input name="password" type="password" class="form-control" placeholder="Password" required>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-primary">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- ===== FEEDBACK ===== -->
<div class="bg1">
    <div class="row">
        <div class="col-md-3"></div>

        <div class="col-md-6 panel">
            <h2 class="text-center">Feedback</h2>

            <?php
            if (@$_GET['q']) {
                echo '<div class="alert alert-success text-center">
                <span class="glyphicon glyphicon-ok"></span> ' . @$_GET['q'] . '
                </div>';
            } else {
                echo '
                <form method="post" action="feed.php?q=feedback.php">

                <div class="form-group">
                    <label>Name</label>
                    <input name="name" class="form-control" placeholder="Enter your name" required>
                </div>

                <div class="form-group">
                    <label>Subject</label>
                    <input name="subject" class="form-control" placeholder="Short description" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input name="email" type="email" class="form-control" placeholder="Enter your email" required>
                </div>

                <div class="form-group">
                    <label>Feedback</label>
                    <textarea name="feedback" rows="5" class="form-control" 
                    placeholder="Write your feedback here..." required></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Send Feedback</button>
                </div>

                </form>';
            }
            ?>
        </div>

        <div class="col-md-3"></div>
    </div>
</div>

<!-- ===== FOOTER ===== -->
<div class="row footer">
    <div class="col-md-12">
        <span>Organized by Quizzer, Institute's Name, Place</span><br><br>
        <a href="feedback.php">Feedback</a> |
        <a href="about.php">About Quizzer</a>
    </div>
</div>

</body>
</html>
