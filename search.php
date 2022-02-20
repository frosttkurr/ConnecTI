<?php
	session_start();
	include("includes/connection.php");
	if (!isset($_SESSION['u_name'])) {
        echo "<script>window.open('landing-page.php','_self')</script>";
	} else {
        include("includes/get-data.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Classroom</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style/search.css">
    <link rel="shortcut icon" type="image/x-icon" href="images/logoti.png">
</head>
<body>
    <div class="header">
        <header>
            <?php
                include("includes/header.php");
            ?>
        </header>
    </div>
    <div class="d-flex justify-content-center">
        <div class="container-fluid" style="background-color: #ECECEC; margin-top: 15px; height: 50px; width: 1080px; border-radius: 15px 15px 0 0; padding-top: 8px; padding-left: 45px; padding-bottom: 45px;">
            <div>
                <img src="images/loupe.svg" alt="" width="38px" style="float: left; margin-right:15px;">
                <h3 style="font-weight: bolder; width:500px;">Hasil Penelusuran</h3>
            </div>
         </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="container-fluid" style="background-color: #FFFFFF; height: auto; width: 1080px; border-radius: 0 0 15px 15px; padding-bottom: 15px; padding-left: 65px;">
            <div class="row">
                <?php search(); ?>
            </div>
        </div>
    </div>
    <div class="footer">
    </div>
</body>
</html>