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
    <title>Sunting Profil - <?php echo $fullname ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style/settings.css">
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
    <div class="d-flex justify-content-center" style="margin-top: 15px;">
        <div class="container-fluid" style="background-color: #ECECEC; margin-top: 15px; height: 50px; width: 1080px; border-radius: 15px 15px 0 0; padding-top: 8px; padding-left: 25px; padding-bottom: 45px;">
           <div><h3 style="font-weight: bolder;">Sunting Profil</h3></div>
         </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="container-fluid" style="background-color: #FFFFFF; height: auto; width: 1080px; border-radius: 0 0 15px 15px; padding-top: 25px; padding-left: 25px; padding-right: 25px;">
            <form autocomplete="off" action="" method="POST" enctype="multipart/form-data">
                <div class="col-sm-12">
                    <table class="table">
                        <tr>
                            <td><label><b>Foto Profil</b></label></td>
                            <td>
                                <label class="btn btn-secondary">Unggah File
                                    <input type="file" id="upload" name="u_image" accept="image/*">
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td><label><b>Foto Sampul</b></label></td>
                            <td>
                                <label class="btn btn-secondary">Unggah File
                                    <input type="file" id="upload" class="btn btn-light" style="" name="u_cover" accept="image/*">
                                </label>
                            </td>
                        </tr>
                        <?php
                            echo '
                                <tr>
                                    <td><label><b>Nama Depan</b></label></td>
                                    <td><input type="text" class="form-control" name="firstname" placeholder="'.$firstname.'" value="'.$firstname.'" style="padding-left: 7px;"></td>
                                </tr>
                                <tr>
                                    <td><label><b>Nama Belakang</b></label></td>
                                    <td><input type="text" class="form-control" name="lastname" placeholder="Nama Belakang" value="'.$lastname.'" style="padding-left: 7px;"></td>
                                </tr>
                                <tr>
                                    <td><label><b>Konsentrasi</b></label></td>
                                    <td><input type="text" class="form-control" name="konsentrasi" placeholder="Konsentrasi" value="'.$user_konsentrasi.'" style="padding-left: 7px;"></td>
                                </tr>
                                <tr>
                                    <td><label><b>Angkatan</b></label></td>
                                    <td><input type="text" class="form-control" name="angkatan" placeholder="Angkatan" value="'.$user_angkatan.'" style="padding-left: 7px;"></td>
                                </tr>
                            ';
                        ?>
                    </table>
                </div>
                <div class="col-sm-12">
                    <table class="table">
                        <tr>
                            <td><label><b>Organisasi</b></label></td>
                            <td></td>
                            <?php
                                $get_organisasi = "SELECT id_organisasi, head_organisasi, tahun_organisasi, val_organisasi FROM organisasi WHERE id_user='$user_id' ORDER BY tahun_organisasi DESC";
                                $result = mysqli_query($db_connect, $get_organisasi);
                                while ($row = $result->fetch_assoc()) {
                                    echo '
                                        <tr>
                                            <td style="display:none;"><input type="text" name="id_organisasi[]" class="form-control" placeholder="'.$row['id_organisasi'].'" style="padding-left: 7px;" value="'.$row['id_organisasi'].'"></td> 
                                            <td><input type="text" name="head_organisasi[]" class="form-control" placeholder="'.$row['head_organisasi'].'" style="padding-left: 7px;" value="'.$row['head_organisasi'].'"></td>
                                            <td><input type="text" name="tahun_organisasi[]" class="form-control" placeholder="'.$row['tahun_organisasi'].'" style="padding-left: 7px;" value="'.$row['tahun_organisasi'].'"></td>
                                            <td><input type="text" name="val_organisasi[]" class="form-control" placeholder="'.$row['val_organisasi'].'" style="padding-left: 7px;" value="'.$row['val_organisasi'].'"></td>
                                        </tr>
                                    ';
                                }  
                            ?>
                            <tr>
                                <td><input type="text" name="add_head_organisasi" class="form-control" placeholder="Tambah" style="padding-left: 7px;"><small>Nama Organisasi</small></td>
                                <td><input type="text" name="add_tahun_organisasi" class="form-control" placeholder="Tambah" style="padding-left: 7px;"><small>Tahun</small></td> 
                                <td><input type="text" name="add_val_organisasi" class="form-control" placeholder="Tambah" style="padding-left: 7px;"><small>Jabatan</small></td>
                            </tr>
                        </tr>
                        <tr>
                            <td><label><b>Kepanitiaan</b></label></td>
                            <td></td>
                            <?php
                                $get_kepanitiaan = "SELECT id_kepanitiaan, head_kepanitiaan, tahun_kepanitiaan, val_kepanitiaan FROM kepanitiaan WHERE id_user='$user_id' ORDER BY tahun_kepanitiaan DESC";
                                $result = mysqli_query($db_connect, $get_kepanitiaan);
                                while ($row = $result->fetch_assoc()) {
                                    echo '
                                        <tr>
                                            <td style="display:none;"><input type="text" name="id_kepanitiaan[]" class="form-control" placeholder="'.$row['id_kepanitiaan'].'" style="padding-left: 7px;" value="'.$row['id_kepanitiaan'].'"></td> 
                                            <td><input type="text" name="head_kepanitiaan[]" class="form-control" placeholder="'.$row['head_kepanitiaan'].'" style="padding-left: 7px;" value="'.$row['head_kepanitiaan'].'"></td>
                                            <td><input type="text" name="tahun_kepanitiaan[]" class="form-control" placeholder="'.$row['tahun_kepanitiaan'].'" style="padding-left: 7px;" value="'.$row['tahun_kepanitiaan'].'"></td>
                                            <td><input type="text" name="val_kepanitiaan[]" class="form-control" placeholder="'.$row['val_kepanitiaan'].'" style="padding-left: 7px;" value="'.$row['val_kepanitiaan'].'"></td>
                                        </tr>
                                    ';
                                }  
                            ?>
                            <tr>
                                <td><input type="text" name="add_head_kepanitiaan" class="form-control" placeholder="Tambah" style="padding-left: 7px;"><small>Nama Kegiatan</small></td>
                                <td><input type="text" name="add_tahun_kepanitiaan" class="form-control" placeholder="Tambah" style="padding-left: 7px;"><small>Tahun</small></td> 
                                <td><input type="text" name="add_val_kepanitiaan" class="form-control" placeholder="Tambah" style="padding-left: 7px;"><small>Posisi</small></td>
                            </tr>
                        </tr>
                        <tr>
                            <td><label><b>Prestasi</b></label></td>
                            <td></td>
                            <?php
                                $get_prestasi = "SELECT id_prestasi, head_prestasi, tahun_prestasi, val_prestasi FROM prestasi WHERE id_user='$user_id' ORDER BY tahun_prestasi DESC";
                                $result = mysqli_query($db_connect, $get_prestasi);
                                while ($row = $result->fetch_assoc()) {
                                    echo '
                                        <tr>
                                            <td style="display:none;"><input type="text" name="id_prestasi[]" class="form-control" placeholder="'.$row['id_prestasi'].'" style="padding-left: 7px;" value="'.$row['id_prestasi'].'"></td>
                                            <td><input type="text" name="head_prestasi[]" class="form-control" placeholder="'.$row['head_prestasi'].'" style="padding-left: 7px;" value="'.$row['head_prestasi'].'"></td>
                                            <td><input type="text" name="tahun_prestasi[]" class="form-control" placeholder="'.$row['tahun_prestasi'].'" style="padding-left: 7px;" value="'.$row['tahun_prestasi'].'"></td>
                                            <td><input type="text" name="val_prestasi[]" class="form-control" placeholder="'.$row['val_prestasi'].'" style="padding-left: 7px;" value="'.$row['val_prestasi'].'"></td>
                                        </tr>
                                    ';
                                }  
                            ?>
                            <tr>
                                <td><input type="text" name="add_head_prestasi" class="form-control" placeholder="Tambah" style="padding-left: 7px;"><small>Nama Lomba</small></td>
                                <td><input type="text" name="add_tahun_prestasi" class="form-control" placeholder="Tambah" style="padding-left: 7px;"><small>Tahun</small></td>
                                <td><input type="text" name="add_val_prestasi" class="form-control" placeholder="Tambah" style="padding-left: 7px;"><small>Prestasi</small></td>
                            </tr>
                        </tr>
                    </table>
                    <div class="container" style="padding-bottom:10px;">
                        <center>
                            <button type="submit" name="cancel" class="btn" style="background-color: red; width: 125px;">Cancel</button>
                            <button type="submit" name="submit" class="btn" style="background-color: #785233; width: 125px;">Selesai</button>
                        </center>
                            <?php
                                include("function/crud_profile.php");
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