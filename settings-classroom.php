<?php
	session_start();
	include("includes/connection.php");
	if (!isset($_SESSION['u_name'])) {
        echo "<script>window.open('landing-page.php','_self')</script>";
	} else {
        if (isset($_GET['class_id'])) {
            $class_id = $_GET['class_id'];
            $select = "SELECT * FROM classroom WHERE id_classroom='$class_id'";
            $run = mysqli_query($db_connect, $select);
            $row = mysqli_fetch_array($run);
            $classname = $row['nama_classroom'];
            $classdetail = $row['keterangan'];
            $classcover = $row['classroom_cover'];
        }
        if ($class_id < 0 || $class_id == "") {
            echo '<script>window.open("home.php", "_self")</script>';
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sunting Classroom - <?php echo $classname ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style/settings-classroom.css">
    <link rel="shortcut icon" type="image/x-icon" href="images/logoti.png">
</head>
<body>
    <div class="header">
        <header>
            <?php
                include("includes/get-data.php");
                include("includes/header.php");
            ?>
        </header>
    </div>
    <div class="d-flex justify-content-center" style="margin-top: 15px;">
        <div class="container-fluid" style="background-color: #ECECEC; margin-top: 15px; height: 50px; width: 1080px; border-radius: 15px 15px 0 0; padding-top: 8px; padding-left: 25px; padding-bottom: 45px;">
           <div><h3 style="font-weight: bolder;">Sunting Classroom</h3></div>
         </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="container-fluid" style="background-color: #FFFFFF; height: auto; width: 1080px; border-radius: 0 0 15px 15px; padding-top: 25px; padding-left: 25px; padding-right: 25px;">
            <form autocomplete="off" action="" method="POST" enctype="multipart/form-data">
                <div class="col-sm-12">
                    <table class="table">
                        <tr>
                            <td><label><b>Foto Sampul</b></label></td>
                            <td>
                                <label class="btn btn-secondary">Unggah File
                                    <input type="file" id="upload" class="btn btn-light" style="" name="class_cover" accept="image/*">
                                </label>
                            </td>
                        </tr>
                        <?php
                            echo '
                                <tr>
                                    <td><label><b>Nama Kelas</b></label></td>
                                    <td><input type="text" class="form-control" name="nama_classroom" placeholder="'.$classname.'" value="'.$classname.'" style="padding-left: 7px;"></td>
                                </tr>
                                <tr>
                                    <td><label><b>Keterangan</b></label></td>
                                    <td><textarea class="form-control" name="keterangan" placeholder="'.$classdetail.'" style="padding-left: 7px; resize:none;">'.$classdetail.'</textarea></td>
                                </tr>
                            ';
                        ?>
                    </table>
                    <div class="container" style="padding-bottom:15px;">
                        <center>
                            <button type="submit" name="cancel2" class="btn" style="background-color: red; width: 125px;">Cancel</button>
                            <button type="submit" name="edit" class="btn" style="background-color: #785233; width: 125px;">Selesai</button>
                        </center>
                            <?php
                                include("function/update_classroom.php");
                            ?>
                    </div>
                </div>
            </form>
         </div>
    </div>
    <div class="footer">
    </div>
</body>
</html>