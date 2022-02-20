<?php
    if(isset($_POST['signup'])){
        $user_name = $_POST['uname'];
        $first_name = $_POST['firstname'];
        $last_name = $_POST['lastname'];
        $user_email = $_POST['email'];
        $password = $_POST['pwd'];
        $status = 'verified';
        $posts = 'no';
        $profile_pic = "default.jpg";
        $profile_cover = "default.jpg";

        $error_pass = "Password harus 8 karakter atau lebih!";
        $error_user = "Username atau Email sudah digunakan!";

        $check_user = "SELECT * FROM users WHERE u_name='$user_name' OR u_email='$user_email'";
        $run_user = mysqli_query($db_connect, $check_user);

        if(strlen($password)<8) {
            echo "<script>alert('$error_pass')</script>";
            exit();
        }

        $check = mysqli_num_rows($run_user);

        if($check > 0){
            echo "<script>alert('$error_user')</script>";
            echo "<script>window.open('landing-page.php','_self')</script>";
        } else {
            $data_insert = "INSERT INTO users (f_name, l_name, u_name, u_pass, u_email, u_image, u_cover, u_prodi, u_reg_date, status_user, posts)
            VALUES ('$first_name', '$last_name', '$user_name', md5('$password'), '$user_email', '$profile_pic', '$profile_cover', 'Teknologi Informasi' ,NOW(), '$status', '$posts')";

            $run_data_insert = mysqli_query($db_connect, $data_insert);

            if ($run_data_insert){
                $_SESSION['u_name'] = $user_name;
                echo "<script>window.open('home.php', '_self')</script>";
            }
        }
    }
?>