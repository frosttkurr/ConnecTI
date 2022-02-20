<?php
    session_start();
    include("includes/connection.php");
    if (isset($_GET['u_id'])) {
        $u_id = $_GET['u_id'];
        $select = "SELECT * FROM users WHERE id_user='$u_id'";
        $run = mysqli_query($db_connect, $select);
        $row = mysqli_fetch_array($run);
        $firstname = $row['f_name'];
        $lastname = $row['l_name'];
        $fullname = $firstname.' '.$lastname;
    }
    if ($u_id < 0 || $u_id == "") {
        echo '<script>window.open("home.php", "_self")</script>';
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $fullname ?></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="style/users.css">
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
                    if (isset($_GET['u_id'])) {
                        global $db_connect;
                        
                        $user_id = $_GET["u_id"];
                        $path_profile = "users/";
                        $path_cover = "cover/";

                        $select = "SELECT * FROM users WHERE id_user='$user_id'";
                        $run = mysqli_query($db_connect, $select);
                        $row = mysqli_fetch_array($run);
                        $user_id = $row['id_user'];
                        $username = $row['u_name'];
                        $firstname = $row['f_name'];
                        $lastname = $row['l_name'];
                        $fullname = $firstname.' '.$lastname;
                        $user_image = $row['u_image'];
                        $user_cover = $row['u_cover'];
                        $user_prodi = $row['u_prodi'];
                        $user_konsentrasi = $row['u_konsentrasi'];
                        $user_angkatan = $row['u_angkatan'];
                    
                        echo 
                            '<form actions="profile.php?id=user_id" method="POST" enctype="multipart/form-data">
                                <center>
                                    <div class="box-cover" style="background-image: url('.$path_cover.$user_cover.');"></div>
                                    <div class="round-profile" style="background-image: url('.$path_profile.$user_image.');"></div>
                                    <div class="box-describe">
                                        <div class="col-sm-8" style="text-align: left; margin-top: 5px; margin-left: 60px; color: #171717;">
                                            <p style="font-size: 32px; margin-top:8px; margin-bottom:5px;"><b>'.$fullname.'</b></p>
                                            <p style="font-size: 20px">'.$user_konsentrasi.' — '.$user_prodi.' — '.$user_angkatan.'</p>
                                        </div>
                                    </div>
                                </center> 
                            </form>
                        ';
                ?>
                        <div class="d-flex justify-content-center">
                            <div class="container-fluid" style="background-color: #ECECEC; margin-top: 15px; height: 50px; width: 1080px; border-radius: 15px 15px 0 0; padding-top: 8px; padding-left: 48px; padding-bottom: 45px;">
                                <h3 style="font-weight: bolder;">Organisasi</h3>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="container-fluid" style="background-color: #FFFFFF; height: auto; width: 1080px; border-radius: 0 0 15px 15px; padding-top: 10px; padding-left: 48px; padding-bottom: 10px;">
                                <?php
                                    $organisasi = mysqli_query($db_connect, "SELECT head_organisasi, tahun_organisasi, val_organisasi FROM organisasi WHERE id_user='$user_id' ORDER BY tahun_organisasi DESC");
                                    while($row = $organisasi->fetch_assoc()) {
                                        echo '
                                            <h5 style="font-weight: bolder;">'.$row['val_organisasi'].'</h5>
                                            <h6 style="font-weight: normal;">'.$row['head_organisasi'].' '.$row['tahun_organisasi'].'</h6>
                                        ';
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="container-fluid" style="background-color: #ECECEC; margin-top: 15px; height: 50px; width: 1080px; border-radius: 15px 15px 0 0; padding-top: 8px; padding-left: 48px; padding-bottom: 45px;">
                                <h3 style="font-weight: bolder;">Kepanitiaan</h3>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="container-fluid" style="background-color: #FFFFFF; height: auto; width: 1080px; border-radius: 0 0 15px 15px; padding-top: 10px; padding-left: 48px; padding-bottom: 10px;">
                                <?php
                                    $kepanitiaan = mysqli_query($db_connect, "SELECT head_kepanitiaan, tahun_kepanitiaan, val_kepanitiaan FROM kepanitiaan WHERE id_user='$user_id' ORDER BY tahun_kepanitiaan DESC");
                                    while($row = $kepanitiaan->fetch_assoc()) {
                                        echo '
                                            <h5 style="font-weight: bolder;">'.$row['val_kepanitiaan'].'</h5>
                                            <h6 style="font-weight: normal;">'.$row['head_kepanitiaan'].' '.$row['tahun_kepanitiaan'].'</h6>
                                        ';
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="container-fluid" style="background-color: #ECECEC; margin-top: 15px; height: 50px; width: 1080px; border-radius: 15px 15px 0 0; padding-top: 8px; padding-left: 48px; padding-bottom: 45px;">
                                <h3 style="font-weight: bolder;">Prestasi</h3>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="container-fluid" style="background-color: #FFFFFF; height: auto; width: 1080px; border-radius: 0 0 15px 15px; padding-top: 10px; padding-left: 48px; padding-bottom: 10px;">
                                <?php
                                    $prestasi = mysqli_query($db_connect, "SELECT head_prestasi, tahun_prestasi, val_prestasi FROM prestasi WHERE id_user='$user_id' ORDER BY tahun_prestasi DESC");
                                    while($row = $prestasi->fetch_assoc()) {
                                        echo '
                                            <h5 style="font-weight: bolder;">'.$row['val_prestasi'].'</h5>
                                            <h6 style="font-weight: normal;">'.$row['head_prestasi'].' '.$row['tahun_prestasi'].'</h6>
                                        ';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <div class="footer">
        </div>
    </body>
</html>