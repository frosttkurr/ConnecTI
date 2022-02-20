<?php
    if (isset($_POST['create'])) {
        $nama_classroom = $_POST['nama_classroom'];
        $keterangan = $_POST['keterangan'];
        $class_cover = $_FILES['class_cover']['name'];
        $cover_tmp = $_FILES['class_cover']['tmp_name'];
        $random_number = rand(1,1000);
                                        
        if ($nama_classroom == "" && $keterangan == "" && $class_cover == "") {
            echo '<script>alert("Isian tidak boleh kosong!")</script>';
            echo '<script>window.open("add-classroom.php","_self")</script>';
            exit();
        }
        if ($nama_classroom == "") {
            echo '<script>alert("Nama classroom tidak boleh kosong!")</script>';
            echo '<script>window.open("add-classroom.php","_self")</script>';
            exit();
        }
    
        if ($nama_classroom != "" && $keterangan  != "" && $class_cover != "") {
            move_uploaded_file($cover_tmp, "classcover/$class_cover.$random_number");
            mysqli_query($db_connect, "INSERT INTO classroom (nama_classroom,keterangan,classroom_cover) VALUES ('$nama_classroom','$keterangan','$class_cover')");
        } else if ($nama_classroom != "" && $keterangan  != "" && $class_cover == "") {
            mysqli_query($db_connect, "INSERT INTO classroom (nama_classroom,keterangan,classroom_cover) VALUES ('$nama_classroom','$keterangan','default.jpg')");
        } else if ($nama_classroom != "" && $keterangan  == "" && $class_cover == "") {
            mysqli_query($db_connect, "INSERT INTO classroom (nama_classroom,classroom_cover) VALUES ('$nama_classroom','default.jpg')");
        }
        echo '<script>alert("Classroom berhasil di buat!")</script>';
        echo '<script>window.open("list-classroom.php","_self")</script>';
    } else if (isset($_POST['cancel3'])) {
        echo '<script>event.preventDefault()</script>';
        echo '<script>alert("Classroom tidak dibuat!")</script>';
        echo '<script>window.open("list-classroom.php","_self")</script>';
    }
?>