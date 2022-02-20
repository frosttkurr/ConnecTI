<?php
    include("function/functions.php");
    $user = $_SESSION['u_name'];
    $get_user = "SELECT * from users WHERE u_name='$user'";
    $result = mysqli_query($db_connect, $get_user);
    while ($row = $result->fetch_assoc()) {
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
    
        $get_posts = "SELECT * FROM posts WHERE id_user='$user_id'";
        $result_posts = mysqli_query($db_connect, $get_posts);
        $posts = mysqli_num_rows($result_posts);
    }
?>