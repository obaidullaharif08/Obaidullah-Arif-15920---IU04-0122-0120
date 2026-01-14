<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Quizzer</title>

<link rel="icon" href="favicon.ico" type="image/icon" sizes="16x16">

<link rel="stylesheet" href="css/bootstrap.min.css"/>
<link rel="stylesheet" href="css/bootstrap-theme.min.css"/>
<link rel="stylesheet" href="css/font.css">

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

<link href="https://fonts.googleapis.com/css?family=Roboto:400,700,300" rel="stylesheet">

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

/* ===== ABOUT TITLE ===== */
.panel h2 {
    font-weight: 700;
    color: #333333;
    margin-bottom: 20px;
}

/* ===== ABOUT TEXT ===== */
.about-text {
    font-size: 14px;
    font-weight: 500;
    color: #444444;
    line-height: 1.7;
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
    <div class="col-lg-6">
        <span class="logo">Quizzer</span>
    </div>

    <div class="col-md-6 text-right">
        <?php
        include_once 'dbConnection.php';
        session_start();
        if ((!isset($_SESSION['username']))) {
            echo '<a href="#" class="logb btn" data-toggle="modal" data-target="#myModal">Login</a>&nbsp;';
        } else {
            echo '<a href="logout.php?q=feedback.php" class="logb btn">Logout</a>&nbsp;';
        }
        ?>
        <a href="index.php" class="logb btn">Home</a>
    </div>
</div>

<!-- ===== LOGIN MODAL ===== -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content title1">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Login to your Account</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" action="login.php?q=index.php" method="POST">
          <div class="form-group">
            <div class="col-md-12">
              <input name="username" placeholder="Enter your username-id" class="form-control">
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">
              <input type="password" name="password" placeholder="Enter your Password" class="form-control">
            </div>
          </div>
          <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">Log in</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- ===== ABOUT CONTENT ===== -->
<div class="bg1">
    <div class="row">
        <div class="col-md-3"></div>

        <div class="col-md-6 panel">
            <h2 align="center">About Quizzer</h2>

            <div class="about-text">
            <?php
            $file = fopen("about.txt", "r");
            while (!feof($file)) {
                $string = fgets($file);
                $num = strlen($string) - 1;
                $c = str_split($string);
                for ($i = 0; $i < $num; $i++) {
                    if ($i > 0) {
                        $last = $c[$i - 1];
                    } else {
                        $last = '';
                    }
                    if ($c[$i] == ' ' && $last == ' ') {
                        echo '&nbsp;';
                    } else {
                        echo $c[$i];
                    }
                }
                echo "<br />";
            }
            fclose($file);
            ?>
            </div>
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
