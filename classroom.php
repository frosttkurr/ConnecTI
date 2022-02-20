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
        <title><?php echo $classname ?></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="style/classroom.css">
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
        <div class="row" style="margin-top: 15px;">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <?php
                    $path_cover = "cover/";
                    echo 
                        '<form actions="profile.php?id=user_id" method="POST" enctype="multipart/form-data">
                            <center>
                                <div class="box-cover" style="background-image: url(classcover/'.$classcover.');"></div>
                                <div class="box-describe">
                                    <div class="col-sm-12" style="text-align: left; margin-top: 15px; margin-left: 35px; color: #171717;">
                                        <img src="images/discussion.svg" alt="" width="75px" style="float: left; margin-right:25px;">
                                        <p style="font-size: 32px; padding-top:13px; float: left;"><b>'.$classname.'</b></p>
                                        <button type="button" id="pengaturan" name="sunting" class="btn">Pengaturan</button>
                                    </div>
                                </div>
                            </center> 
                        </form>
                    ';
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2" style="margin-left:89px;"></div>
            <div class="col-sm-4">
                <div class="row d-flex" style="margin-top:15px;">
                    <div id="insert_post" class="col-sm-12">
                        <div class="col-sm-12" style="background-color: #ECECEC; height: 35px; border-radius: 15px 15px 0 0; padding-top:6px; padding-left:10px;">
                            <?php 
                                $path_profile = "users/";
                                echo '<div class="profile-status" style="background-image: url('.$path_profile.$user_image.'); margin-left:15px"></div>';
                            ?>  
                            <p style="margin-left:45px">Perbarui Status Anda</p>
                        </div>
                        <form action="classroom.php?class_id=<?php echo $class_id; ?>" method="POST" id="f" enctype="multipart/form-data">
                            <textarea class="form-control" id="content" rows="3" name="content" placeholder="Berbagi kiriman..." style="padding-top:20px; padding-left:35px;border-radius:0;resize:none;"></textarea>
                            <div class="col-sm-12" style="background-color: #ECECEC; height: 42px; border-radius: 0 0 15px 15px; padding-top:3px; padding-left:25px; padding-bottom:10px; display: inline-flex;">
                                <div id="upload-image">
                                    <input type="file" name="upload_image" size="30" accept="image/*" style="opacity:0;">
                                </div>
                                <div id="upload-docs">
                                    <input type="file" name="upload_docs" size="30" accept=".xlsx,.xls,.doc,.docx,.ppt,.pptx,.txt,.pdf" style="opacity:0;">
                                </div>
                                <button type="submit" id="btn-post" name="kirim2" class="btn">Kirim</button>
                            </div>
                        </form>
                        <?php postClassroom(); ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-3" style="margin-top:15px; margin-left:19px;">
                <div class="row d-flex">
                    <div id="keterangan" class="col-sm-12">
                        <div class="col-sm-11" style="background-color: #ECECEC; height: 35px; border-radius: 15px 15px 0 0; padding-top:6px; padding-left:10px;">
                            <p style="margin-left:20px"><b>Tentang</b></p>
                        </div>
                        <div class="col-sm-11" style="background-color: #FBFBFB; height: auto; border-radius: 0 0 15px 15px; padding-top:10px; padding-left:30px; padding-right:25px; padding-bottom:10px;">
                            <?php
                                $query = mysqli_query($db_connect, "SELECT keterangan FROM classroom WHERE id_classroom='$class_id'");
                                $row = $query->fetch_assoc();
                                echo '
                                    <p style="font-size:15x; margin-bottom:0; padding:0;">'.$row['keterangan'].'</p>
                                ';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2" style="margin-left:89px;"></div>
            <div class="col-sm-4">
                <div class="row d-flex">
                    <div id="post_group" class="col-sm-12">
                        <?php echo get_postClassroom(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
        </div>
    </body>
    <script>
        $(document).ready(function() {
            $("#pengaturan").click(function() {
                window.open("settings-classroom.php?class_id=<?php echo $class_id ?>","_self");
            });
        });
    </script>
</html>