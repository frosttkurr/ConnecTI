<?php
    session_start();
    include("includes/connection.php");
    if (isset($_SESSION['u_name'])) {
        echo "<script>window.open('home.php', '_self')</script>";
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di ConnecTI</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/login.css">
    <link rel="shortcut icon" type="image/x-icon" href="images/logoti.png">
</head>
<body>
    <header>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-header bg-light" style="height: 70px">
                    <a href="#">
                         <img id="logo-ti" src="images/logoti.png" alt="" width="55px" style="float: left; margin-right: 15px;">
                    </a>
                    <a href="#" style="color: #785233; text-decoration:none; text-shadow: 4px 3px 3px rgb(0,0,0, 0.3); font-size: 28px">
                        <strong>ConnecTI<strong>
                    </a>
                    <p id="login-key" style="float: right; color:#171717; text-decoration:none; font-size: 19px">
                        <img src="images/house-key.svg" alt="" width="35px" style="margin-right: 5px;">
                        Masuk/Daftar 
                    </p>    
                </div>
            </div>
        </div>
    </header>
    <div class="row">
        <div class="col-sm-6">
            <div id="welcome1">
                <h2 class="welcometext1"><strong>Selamat Datang<br>Civitas TI</strong></h2>
                <h3 class="welcometext2">Kelola akun Anda dan mulai berteman<br>dengan Civitas TI lainnya!</h3>
            </div>
        </div>
        <div class="col-sm-6">
            <form autocomplete="off" action="" method="POST" style="margin-top: 10%; margin-left: 17%">
                <div class="form-group mb-2">
                    <label style="color: white; font-size: 55px; text-shadow: 4px 3px 3px rgb(0,0,0, 0.7);">Login</label>
                    <input type="text" class="form-control" placeholder="Username/NIM" name="uname" style="background: rgb(255,255,255, 0.8);" required="required">
                </div>
                <div class="form-group mb-2">
                    <input type="password" class="form-control" placeholder="Password" name="pwd" style="background: rgb(255,255,255, 0.8);" required="required">
                </div>
                <button type="submit" id="login" class="btn" style="background-color: #ECBB4E;" name="login">
                    Login
                    <?php
                        include("includes/login.php");
                    ?>
                </button>
            </form>
            <br>
            <form autocomplete="off" action="" method="POST" style="margin-left: 17%">
                <div class="form-group mb-2">
                    <label style="color: white; font-size: 55px; text-shadow: 4px 3px 3px rgb(0,0,0, 0.7);">Daftar</label>
                    <input type="text" class="form-control" placeholder="Username/NIM" name="uname" style="background: rgb(255,255,255, 0.8);" required="required">
                </div>
                <div class="form-group mb-2">
                    <input type="text" class="form-control" placeholder="Nama Depan" name="firstname" style="background: rgb(255,255,255, 0.8);" required="required">
                </div>
                <div class="form-group mb-2">
                    <input type="text" class="form-control" placeholder="Nama Belakang" name="lastname" style="background: rgb(255,255,255, 0.8);" required="required">
                </div>
                <div class="form-group mb-2">
                    <input type="email" class="form-control" placeholder="Email" name="email" style="background: rgb(255,255,255, 0.8);" required="required">
                </div>
                <div class="form-group mb-2">
                    <input type="password" class="form-control" placeholder="Password" name="pwd" style="background: rgb(255,255,255, 0.8);" required="required">
                </div>
                <button type="submit" id="daftar" class="btn" style="background-color: #785233;" name="signup">
                    Daftar
                    <?php
                        include("includes/register.php");
                    ?>
                </button>
            </form>
        </div>
    </div>
    <footer class="footer mt-auto py-3 fixed-bottom bg-light">
        <h4><center>Platform Sosial Media TI - ConnecTI</center></h4>
    </footer>
</body>
</html>