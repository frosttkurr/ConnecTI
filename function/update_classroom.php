<?php
    if (isset($_GET['class_id'])) {
        $class_id = $_GET['class_id'];
    }
    if (isset($_POST['edit'])) {
        $nama_classroom = $_POST['nama_classroom'];
        $keterangan = $_POST['keterangan'];
        $class_cover = $_FILES['class_cover']['name'];
        $cover_tmp = $_FILES['class_cover']['tmp_name'];
        $random_number = rand(1,1000);
                                        
        if ($nama_classroom == "" && $keterangan == "" && $class_cover == "") {
            echo '<script>alert("Isian tidak boleh kosong!")</script>';
            echo '<script>window.open("classroom.php?class_id='.$class_id.'","_self")</script>';
            exit();
        } else if ($nama_classroom == "") {
            echo '<script>alert("Nama classroom tidak boleh kosong!")</script>';
            echo '<script>window.open("classroom.php?class_id='.$class_id.'","_self")</script>';
            exit();
        }
    
        if ($nama_classroom != "") {
            mysqli_query($db_connect, "UPDATE classroom SET nama_classroom='$nama_classroom' WHERE id_classroom='$class_id'");
        }
        if ($keterangan  != "") {
            mysqli_query($db_connect, "UPDATE classroom SET keterangan='$keterangan' WHERE id_classroom='$class_id'");
        }
        if ($class_cover != "") {
            move_uploaded_file($cover_tmp, "classcover/$class_cover.$random_number");
            mysqli_query($db_connect, "UPDATE classroom SET classroom_cover='$class_cover.$random_number' WHERE id_classroom='$class_id'");
        }
                            
        echo '<script>alert("Perubahan disimpan!")</script>';
        echo '<script>window.open("classroom.php?class_id='.$class_id.'","_self")</script>';
    } else if (isset($_POST['cancel2'])) {
        echo '<script>event.preventDefault()</script>';
        echo '<script>alert("Perubahan tidak disimpan!")</script>';
        echo '<script>window.open("classroom.php?class_id='.$class_id.'","_self")</script>';
    }
?>