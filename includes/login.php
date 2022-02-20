<?php
    if(isset($_POST['login'])) {
        $user_name = $_POST['uname'];
        $password = md5($_POST['pwd']);

        $error = "Username atau Password salah!";

        $select_user = "SELECT * FROM users WHERE u_name='$user_name' AND u_pass='$password' AND status_user='verified'";    
        $query = mysqli_query($db_connect, $select_user);
        $check_user = mysqli_num_rows($query);

        if ($check_user == 1) {
            $_SESSION['u_name'] = $user_name;
            echo "<script>window.open('home.php','_self')</script>";
        } else {
            echo "<script>alert('$error')</script>";
        }
    }
?>