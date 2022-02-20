<?php
    if (isset($_POST['submit'])) {
        $firstname_tmp = $_POST['firstname'];
        $lastname_tmp = $_POST['lastname'];
        $konsentrasi_tmp = $_POST['konsentrasi'];
        $angkatan_tmp = $_POST['angkatan'];
        $u_image = $_FILES['u_image']['name'];
        $image_tmp = $_FILES['u_image']['tmp_name'];
        $u_cover = $_FILES['u_cover']['name'];
        $cover_tmp = $_FILES['u_cover']['tmp_name'];
        $random_number = rand(1,1000);
        $add_head_organisasi = $_POST['add_head_organisasi'];
        $add_tahun_organisasi = $_POST['add_tahun_organisasi'];
        $add_val_organisasi = $_POST['add_val_organisasi'];
        $add_head_kepanitiaan = $_POST['add_head_kepanitiaan'];
        $add_tahun_kepanitiaan = $_POST['add_tahun_kepanitiaan'];
        $add_val_kepanitiaan = $_POST['add_val_kepanitiaan'];
        $add_head_prestasi = $_POST['add_head_prestasi'];
        $add_tahun_prestasi = $_POST['add_tahun_prestasi'];
        $add_val_prestasi = $_POST['add_val_prestasi'];
                                        
        if ($firstname_tmp == "" && $lastname_tmp == "" && $angkatan_tmp == "") {
            echo '<script>alert("Nama dan Angkatan tidak boleh kosong!")</script>';
            echo '<script>window.open("profile.php","_self")</script>';
        } else if ($firstname_tmp == "" || $lastname_tmp == "" || $angkatan_tmp == "") {
            echo '<script>alert("Nama atau Angkatan tidak boleh kosong!")</script>';
            echo '<script>window.open("profile.php","_self")</script>';
        }
    
        if ($u_image != "") {
            move_uploaded_file($image_tmp, "users/$u_image.$random_number");
            mysqli_query($db_connect, "UPDATE users SET u_image='$u_image.$random_number' WHERE id_user='$user_id'");
        }
        if ($u_cover != "") {
            move_uploaded_file($cover_tmp, "cover/$u_cover.$random_number");
            mysqli_query($db_connect, "UPDATE users SET u_cover='$u_cover.$random_number' WHERE id_user='$user_id'");
        }
        if ($firstname_tmp != "") {
            mysqli_query($db_connect, "UPDATE users SET f_name='$firstname_tmp' WHERE id_user='$user_id'");
        }
        if ($lastname_tmp != "") {
            mysqli_query($db_connect, "UPDATE users SET l_name='$lastname_tmp' WHERE id_user='$user_id'");
        }
        if ($konsentrasi_tmp != "") {
            mysqli_query($db_connect, "UPDATE users SET u_konsentrasi='$konsentrasi_tmp' WHERE id_user='$user_id'");
        }
        if ($angkatan_tmp != "") {
            mysqli_query($db_connect, "UPDATE users SET u_angkatan='$angkatan_tmp' WHERE id_user='$user_id'");
        }

        //Add Organisasi
        if ($add_head_organisasi != "" && $add_tahun_organisasi != "" && $add_val_organisasi != "") {
            mysqli_query($db_connect, "INSERT INTO organisasi (id_user,head_organisasi,tahun_organisasi,val_organisasi) VALUES ('$user_id','$add_head_organisasi','$add_tahun_organisasi','$add_val_organisasi')");
        }
        //Edit Organisasi
        for ($i=0;$i<(count($_POST['id_organisasi']));$i++) {
            foreach ($_POST['head_organisasi'] as $head_organisasi) {
                $temp_id = $_POST['id_organisasi'][$i++];
                mysqli_query($db_connect, "UPDATE organisasi SET head_organisasi='$head_organisasi' WHERE id_organisasi='$temp_id'");
            }   
        }
        for ($i=0;$i<(count($_POST['id_organisasi']));$i++) {
            foreach ($_POST['tahun_organisasi'] as $tahun_organisasi) {
                $temp_id = $_POST['id_organisasi'][$i++];
                mysqli_query($db_connect, "UPDATE organisasi SET tahun_organisasi='$tahun_organisasi' WHERE id_organisasi='$temp_id'");
            }   
        }         
        for ($i=0;$i<(count($_POST['id_organisasi']));$i++) {
            foreach ($_POST['val_organisasi'] as $val_organisasi) {
                $temp_id = $_POST['id_organisasi'][$i++];
                mysqli_query($db_connect, "UPDATE organisasi SET val_organisasi='$val_organisasi' WHERE id_organisasi='$temp_id'");
            }                
        }
        //Delete Organisasi
        mysqli_query($db_connect, "DELETE FROM organisasi WHERE id_user='$user_id' AND head_organisasi='' AND tahun_organisasi=0 AND val_organisasi=''");

        //Add Kepanitiaan
        if ($add_head_kepanitiaan != "" && $add_tahun_kepanitiaan != "" && $add_val_kepanitiaan != "") {
            mysqli_query($db_connect, "INSERT INTO kepanitiaan (id_user,head_kepanitiaan,tahun_kepanitiaan,val_kepanitiaan) VALUES ('$user_id','$add_head_kepanitiaan','$add_tahun_kepanitiaan','$add_val_kepanitiaan')");
        }
        //Edit Kepanitiaan
        for ($i=0;$i<(count($_POST['id_kepanitiaan']));$i++) {
            foreach ($_POST['head_kepanitiaan'] as $head_kepanitiaan) {
                $temp_id = $_POST['id_kepanitiaan'][$i++];
                mysqli_query($db_connect, "UPDATE kepanitiaan SET head_kepanitiaan='$head_kepanitiaan' WHERE id_kepanitiaan='$temp_id'");
            }   
        }
        for ($i=0;$i<(count($_POST['id_kepanitiaan']));$i++) {
            foreach ($_POST['tahun_kepanitiaan'] as $tahun_kepanitiaan) {
                $temp_id = $_POST['id_kepanitiaan'][$i++];
                mysqli_query($db_connect, "UPDATE kepanitiaan SET tahun_kepanitiaan='$tahun_kepanitiaan' WHERE id_kepanitiaan='$temp_id'");
            }   
        }         
        for ($i=0;$i<(count($_POST['id_kepanitiaan']));$i++) {
            foreach ($_POST['val_kepanitiaan'] as $val_kepanitiaan) {
                $temp_id = $_POST['id_kepanitiaan'][$i++];
                mysqli_query($db_connect, "UPDATE kepanitiaan SET val_kepanitiaan='$val_kepanitiaan' WHERE id_kepanitiaan='$temp_id'");
            }                
        }
        //Delete Kepanitiaan
        mysqli_query($db_connect, "DELETE FROM kepanitiaan WHERE id_user='$user_id' AND head_kepanitiaan='' AND tahun_kepanitiaan=0 AND val_kepanitiaan=''");

        //Add Prestasi
        if ($add_head_prestasi != "" && $add_tahun_prestasi != "" && $add_val_prestasi != "") {
            mysqli_query($db_connect, "INSERT INTO prestasi (id_user,head_prestasi,tahun_prestasi,val_prestasi) VALUES ('$user_id','$add_head_prestasi','$add_tahun_prestasi','$add_val_prestasi')");
        }
        //Edit Prestasi
        for ($i=0;$i<(count($_POST['id_prestasi']));$i++) {
            foreach ($_POST['head_prestasi'] as $head_prestasi) {
                $temp_id = $_POST['id_prestasi'][$i++];
                mysqli_query($db_connect, "UPDATE prestasi SET head_prestasi='$head_prestasi' WHERE id_prestasi='$temp_id'");
            }   
        }
        for ($i=0;$i<(count($_POST['id_prestasi']));$i++) {
            foreach ($_POST['tahun_prestasi'] as $tahun_prestasi) {
                $temp_id = $_POST['id_prestasi'][$i++];
                mysqli_query($db_connect, "UPDATE prestasi SET tahun_prestasi='$tahun_prestasi' WHERE id_prestasi='$temp_id'");
            }   
        }         
        for ($i=0;$i<(count($_POST['id_prestasi']));$i++) {
            foreach ($_POST['val_prestasi'] as $val_prestasi) {
                $temp_id = $_POST['id_prestasi'][$i++];
                mysqli_query($db_connect, "UPDATE prestasi SET val_prestasi='$val_prestasi' WHERE id_prestasi='$temp_id'");
            }                
        }
        //Delete Prestasi
        mysqli_query($db_connect, "DELETE FROM prestasi WHERE id_user='$user_id' AND head_prestasi='' AND tahun_prestasi=0 AND val_prestasi=''");
                                    
        echo '<script>alert("Perubahan disimpan!")</script>';
        echo '<script>window.open("profile.php","_self")</script>';
    } else if (isset($_POST['cancel'])) {
        echo '<script>event.preventDefault()</script>';
        echo '<script>alert("Perubahan tidak disimpan!")</script>';
        echo '<script>window.open("profile.php","_self")</script>';
    }
?>