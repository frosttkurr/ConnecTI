<?php 
    include("includes/connection.php");
    date_default_timezone_set('asia/singapore');
	$date = date("Y/m/d H:i:s");

    function insertPost() {
        if(isset($_POST['kirim'])){
            global $db_connect;
            global $user_id;
            
            $content = htmlentities($_POST['content']);
            $upload_image = $_FILES['upload_image']['name'];
            $image_tmp = $_FILES['upload_image']['tmp_name'];
            $upload_docs = $_FILES['upload_docs']['name'];
            $docs_tmp = $_FILES['upload_docs']['tmp_name'];
            $random_number = rand(1, 100);
    
            if (strlen($content) > 250){
                echo "<script>alert('Gunakan kata maksimal 250 kata!')</script>";
                echo "<script>event.preventDefault()</script>";
            } else {
                if (strlen($upload_image) >= 1 && strlen($content) >= 1 && strlen($upload_docs) >= 1){
                    move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");
                    move_uploaded_file($docs_tmp, "docspost/$upload_docs");
                    $insert = "INSERT INTO posts (id_user, post_content, upload_image, upload_docs, post_date) VALUES ('$user_id', '$content', '$upload_image.$random_number', '$upload_docs', NOW())";
                    $run = mysqli_query($db_connect, $insert);
                    if ($run) {
                        echo "<script>window.open('home.php', '_self')</script>";
                        $update = "UPDATE users SET posts='yes' WHERE id_user='$user_id'";
                        $run_update = mysqli_query($db_connect, $update);
                    }
                    exit();
                } else {
                    if ($upload_image == '' && $content == '' && $upload_docs == ''){
                        echo "<script>alert('Tidak ada konten yang dikirim!')</script>";
                        echo "<script>window.open('home.php', '_self')</script>";
                        exit();
                    } else {
                        if ($upload_image != '' && $content != '' && $upload_docs == '') {
                            move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");
                            $insert = "INSERT INTO posts (id_user, post_content, upload_image, post_date) VALUES ('$user_id', '$content', '$upload_image.$random_number', NOW())";
                            $run = mysqli_query($db_connect, $insert);
                            if ($run) {
                                echo "<script>window.open('home.php', '_self')</script>";
                                $update = "UPDATE users SET posts='yes' WHERE id_user='$user_id'";
                                $run_update = mysqli_query($db_connect, $update); 
                            }
                            exit();
                        } else if ($upload_docs != '' && $content != '' && $upload_image == '') {
                            move_uploaded_file($docs_tmp, "docspost/'$upload_docs'");
                            $insert = "INSERT INTO posts (id_user, post_content, upload_docs, post_date) VALUES ('$user_id', '$content', '$upload_docs', NOW())";
                            $run = mysqli_query($db_connect, $insert);
                            if ($run) {   
                                echo "<script>window.open('home.php', '_self')</script>";
                                $update = "UPDATE users SET posts='yes' WHERE id_user='$user_id'";
                                $run_update = mysqli_query($db_connect, $update);
                            }
                            exit();
                        } else if ($upload_docs != '' && $upload_image != ''  && $content == '') {
                            move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");
                            move_uploaded_file($docs_tmp, "docspost/'$upload_docs'");
                            $insert = "INSERT INTO posts (id_user, upload_image, upload_docs, post_date) VALUES ('$user_id', '$upload_image.$random_number', '$upload_docs', NOW())";
                            $run = mysqli_query($db_connect, $insert);
                            if ($run) {
                                echo "<script>window.open('home.php', '_self')</script>";
                                $update = "UPDATE users SET posts='yes' WHERE id_user='$user_id'";
                                $run_update = mysqli_query($db_connect, $update);
                            }
                            exit();
                        } else if ($upload_image != '' && $content == '' && $upload_docs == ''){
                            move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");
                            $insert = "INSERT INTO posts (id_user, upload_image, post_date) VALUES ('$user_id','$upload_image.$random_number', NOW())";
                            $run = mysqli_query($db_connect, $insert);
                            if ($run) {
                                echo "<script>window.open('home.php', '_self')</script>";
                                $update = "UPDATE users SET posts='yes' WHERE id_user='$user_id'";
                                $run_update = mysqli_query($db_connect, $update); 
                            }
                            exit();
                        } else if ($content != '' && $upload_docs == '' && $upload_image == '') {
                            $insert = "INSERT INTO posts (id_user, post_content, post_date) VALUES ('$user_id', '$content', NOW())";
                            $run = mysqli_query($db_connect, $insert);
                            if ($run) {
                                echo "<script>window.open('home.php', '_self')</script>";
                                $update = "UPDATE users SET posts='yes' WHERE id_user='$user_id'";
                                $run_update = mysqli_query($db_connect, $update);
                            }
                            exit();
                        } else if ($upload_docs != '' && $content == '' && $upload_image == '') {
                            move_uploaded_file($docs_tmp, "docspost/$upload_docs");
                            $insert = "INSERT INTO posts (id_user, upload_docs, post_date) VALUES ('$user_id', '$upload_docs', NOW())";
                            $run = mysqli_query($db_connect, $insert);
                            if ($run) {
                                echo "<script>window.open('home.php', '_self')</script>";
                                $update = "UPDATE users SET posts='yes' WHERE id_user='$user_id'";
                                $run_update = mysqli_query($db_connect, $update);
                            }
                            exit();
                        }
                    }
                }
            }
        }
    }

    function get_posts() {
        global $db_connect;

        $get_posts = "SELECT * FROM posts ORDER by post_date DESC";
	    $run_posts = mysqli_query($db_connect, $get_posts);
	    while ($row_posts = mysqli_fetch_array($run_posts)) {
            $post_id = $row_posts['id_post'];
            $user_id = $row_posts['id_user'];
            $content = $row_posts['post_content'];
            $upload_image = $row_posts['upload_image'];
            $upload_docs = $row_posts['upload_docs'];
            $post_date = $row_posts['post_date'];

            $user = "SELECT * FROM users WHERE id_user='$user_id' AND posts='yes'";
            $run_user = mysqli_query($db_connect, $user);
            $row_user = mysqli_fetch_array($run_user);
            $user_name = $row_user['f_name'] . " " . $row_user['l_name'];
            $user_image = $row_user['u_image'];

            if ($content != "" && strlen($upload_image) >= 1 && strlen($upload_docs) >= 1){
                echo '
                    <div class="col-sm-12" style="background-color: #ECECEC; height: auto; border-radius: 15px 15px 0 0; padding-top:10px; padding-left:5px; padding-bottom:10px; margin-top:15px;">
                        <div class="profile-status2" style="background-image: url(users/'.$user_image.'); margin-left:15px; margin-right:10px;"></div>
                        <p style="margin-left:3px; font-size:19px; margin-bottom:0; padding:0;"><a href="users.php?u_id='.$user_id.'" style="text-decoration:none; cursor:pointer; color: #171717;">'.$user_name.'</a></p>
                        <p style="font-size:12px; padding:0; margin-top:0; margin-bottom:0;"><small>'.$post_date.'</small></p>
                    </div>
                    <div class="col-sm-12" style="background-color: #FBFBFB; height: auto; border-radius: 0 0 15px 15px; padding-top:15px; padding-left:30px; padding-right:25px; padding-bottom:15px;">
                        <p style="font-size:17px; margin-bottom:0; padding:0;">'.$content.'</p>
                        <img src="imagepost/'.$upload_image.'" style="border-radius:10px; padding-top: 5px; display: block; margin: 0 auto; width:550px;">
                        <div style="padding-top: 10px;"><a href="docspost/'.$upload_docs.'" style="color: #171717;"><img src="images/google-docs.svg" style="width: 28px; height: 28px; margin-right:5px;">'.$upload_docs.'</a></div>
                    </div>
                ';
            } else {
                if ($upload_image != '' && $content != '' && $upload_docs == '') {
                    echo '
                        <div class="col-sm-12" style="background-color: #ECECEC; height: auto; border-radius: 15px 15px 0 0; padding-top:10px; padding-left:5px; padding-bottom:10px; margin-top:15px;">
                            <div class="profile-status2" style="background-image: url(users/'.$user_image.'); margin-left:15px; margin-right:10px;"></div>
                            <p style="margin-left:3px; font-size:19px; margin-bottom:0; padding:0;"><a href="users.php?u_id='.$user_id.'" style="text-decoration:none; cursor:pointer; color: #171717;">'.$user_name.'</a></p>
                            <p style="font-size:12px; padding:0; margin-top:0; margin-bottom:0;"><small>'.$post_date.'</small></p>
                        </div>
                        <div class="col-sm-12" style="background-color: #FBFBFB; height: auto; border-radius: 0 0 15px 15px; padding-top:15px; padding-left:30px; padding-right:25px; padding-bottom:15px;">
                            <p style="font-size:17px; margin-bottom:0; padding:0;">'.$content.'</p>
                            <img src="imagepost/'.$upload_image.'" style="border-radius:10px; padding-top: 5px; display: block; margin: 0 auto; width:550px;">
                        </div>
                    ';
                } else if ($upload_docs != '' && $content != '' && $upload_image == '') {
                    echo '
                        <div class="col-sm-12" style="background-color: #ECECEC; height: auto; border-radius: 15px 15px 0 0; padding-top:10px; padding-left:5px; padding-bottom:10px; margin-top:15px;">
                            <div class="profile-status2" style="background-image: url(users/'.$user_image.'); margin-left:15px; margin-right:10px;"></div>
                            <p style="margin-left:3px; font-size:19px; margin-bottom:0; padding:0;"><a href="users.php?u_id='.$user_id.'" style="text-decoration:none; cursor:pointer; color: #171717;">'.$user_name.'</a></p>
                            <p style="font-size:12px; padding:0; margin-top:0; margin-bottom:0;"><small>'.$post_date.'</small></p>
                        </div>
                        <div class="col-sm-12" style="background-color: #FBFBFB; height: auto; border-radius: 0 0 15px 15px; padding-top:15px; padding-left:30px; padding-right:25px; padding-bottom:15px;">
                            <p style="font-size:17px; margin-bottom:0; padding:0;">'.$content.'</p>
                            <div style="padding-top: 10px;"><a href="docspost/'.$upload_docs.'" style="color: #171717;"><img src="images/google-docs.svg" style="width: 28px; height: 28px; margin-right:5px;">'.$upload_docs.'</a></div>
                        </div>
                    ';
                } else if ($upload_docs != '' && $upload_image != ''  && $content == '') {
                    echo '
                        <div class="col-sm-12" style="background-color: #ECECEC; height: auto; border-radius: 15px 15px 0 0; padding-top:10px; padding-left:5px; padding-bottom:10px; margin-top:15px;">
                            <div class="profile-status2" style="background-image: url(users/'.$user_image.'); margin-left:15px; margin-right:10px;"></div>
                            <p style="margin-left:3px; font-size:19px; margin-bottom:0; padding:0;"><a href="users.php?u_id='.$user_id.'" style="text-decoration:none; cursor:pointer; color: #171717;">'.$user_name.'</a></p>
                            <p style="font-size:12px; padding:0; margin-top:0; margin-bottom:0;"><small>'.$post_date.'</small></p>
                        </div>
                        <div class="col-sm-12" style="background-color: #FBFBFB; height: auto; border-radius: 0 0 15px 15px; padding-top:15px; padding-left:30px; padding-right:25px; padding-bottom:15px;">
                            <img src="imagepost/'.$upload_image.'" style="border-radius:10px; padding-top: 5px; display: block; margin: 0 auto; width:550px;">
                            <div style="padding-top: 10px;"><a href="docspost/'.$upload_docs.'" style="color: #171717;"><img src="images/google-docs.svg" style="width: 28px; height: 28px; margin-right:5px;">'.$upload_docs.'</a></div>
                        </div>
                    ';
                } else if ($upload_image != '' && $content == '' && $upload_docs == ''){
                    echo '
                        <div class="col-sm-12" style="background-color: #ECECEC; height: auto; border-radius: 15px 15px 0 0; padding-top:10px; padding-left:5px; padding-bottom:10px; margin-top:15px;">
                            <div class="profile-status2" style="background-image: url(users/'.$user_image.'); margin-left:15px; margin-right:10px;"></div>
                            <p style="margin-left:3px; font-size:19px; margin-bottom:0; padding:0;"><a href="users.php?u_id='.$user_id.'" style="text-decoration:none; cursor:pointer; color: #171717;">'.$user_name.'</a></p>
                            <p style="font-size:12px; padding:0; margin-top:0; margin-bottom:0;"><small>'.$post_date.'</small></p>
                        </div>
                        <div class="col-sm-12" style="background-color: #FBFBFB; height: auto; border-radius: 0 0 15px 15px; padding-top:5px; padding-left:30px; padding-right:25px; padding-bottom:15px;">
                            <img src="imagepost/'.$upload_image.'" style="border-radius:10px; padding-top: 5px; display: block; margin: 0 auto; width:550px;">
                        </div>
                    ';
                } else if ($content != '' && $upload_docs == '' && $upload_image == '') {
                    echo '
                        <div class="col-sm-12" style="background-color: #ECECEC; height: auto; border-radius: 15px 15px 0 0; padding-top:10px; padding-left:5px; padding-bottom:10px; margin-top:15px;">
                            <div class="profile-status2" style="background-image: url(users/'.$user_image.'); margin-left:15px; margin-right:10px;"></div>
                            <p style="margin-left:3px; font-size:19px; margin-bottom:0; padding:0;"><a href="users.php?u_id='.$user_id.'" style="text-decoration:none; cursor:pointer; color: #171717;">'.$user_name.'</a></p>
                            <p style="font-size:12px; padding:0; margin-top:0; margin-bottom:0;"><small>'.$post_date.'</small></p>
                        </div>
                        <div class="col-sm-12" style="background-color: #FBFBFB; height: auto; border-radius: 0 0 15px 15px; padding-top:15px; padding-left:30px; padding-right:25px; padding-bottom:15px;">
                            <p style="font-size:17px; margin-bottom:0; padding:0;">'.$content.'</p>
                        </div>
                    ';
                } else if ($upload_docs != '' && $content == '' && $upload_image == '') {
                    echo '
                        <div class="col-sm-12" style="background-color: #ECECEC; height: auto; border-radius: 15px 15px 0 0; padding-top:10px; padding-left:5px; padding-bottom:10px; margin-top:15px;">
                            <div class="profile-status2" style="background-image: url(users/'.$user_image.'); margin-left:15px; margin-right:10px;"></div>
                            <p style="margin-left:3px; font-size:19px; margin-bottom:0; padding:0;"><a href="users.php?u_id='.$user_id.'" style="text-decoration:none; cursor:pointer; color: #171717;">'.$user_name.'</a></p>
                            <p style="font-size:12px; padding:0; margin-top:0; margin-bottom:0;"><small>'.$post_date.'</small></p>
                        </div>
                        <div class="col-sm-12" style="background-color: #FBFBFB; height: auto; border-radius: 0 0 15px 15px; padding-top:5px; padding-left:30px; padding-right:25px; padding-bottom:15px;">
                            <div style="padding-top: 10px;"><a href="docspost/'.$upload_docs.'" style="color: #171717;"><img src="images/google-docs.svg" style="width: 28px; height: 28px; margin-right:5px;">'.$upload_docs.'</a></div>
                        </div>
                    ';
                }
            }
        }
    }

    function postClassroom() {
        if(isset($_POST['kirim2'])){
            global $db_connect;
            global $user_id;
            $class_id = $_GET['class_id'];

            $content = htmlentities($_POST['content']);
            $upload_image = $_FILES['upload_image']['name'];
            $image_tmp = $_FILES['upload_image']['tmp_name'];
            $upload_docs = $_FILES['upload_docs']['name'];
            $docs_tmp = $_FILES['upload_docs']['tmp_name'];
            $random_number = rand(1, 100);

            if (strlen($content) > 250){
                echo "<script>alert('Gunakan kata maksimal 250 kata!')</script>";
                echo "<script>event.preventDefault()</script>";
            } else {
                if (strlen($upload_image) >= 1 && strlen($content) >= 1 && strlen($upload_docs) >= 1){
                    move_uploaded_file($image_tmp, "imageclass/$upload_image.$random_number");
                    move_uploaded_file($docs_tmp, "docsclass/$upload_docs");
                    $insert = "INSERT INTO posts_classroom (id_classroom, id_user, post_content, upload_image, upload_docs, post_date) VALUES('$class_id', '$user_id', '$content', '$upload_image.$random_number', '$upload_docs', NOW())";
                    $run = mysqli_query($db_connect, $insert);
                    if ($run) {
                        echo "<script>window.open('classroom.php?class_id=".$class_id."', '_self')</script>";
                        $update = "UPDATE users SET posts_class='yes' WHERE id_user='$user_id'";
                        $run_update = mysqli_query($db_connect, $update);
                    }
                    exit();
                } else {
                    if ($upload_image == '' && $content == '' && $upload_docs == ''){
                        echo "<script>alert('Tidak ada konten yang dikirim!')</script>";
                        echo "<script>window.open('classroom.php?class_id=".$class_id."', '_self')</script>";
                    } else {
                        if ($upload_image != '' && $content != '' && $upload_docs == '') {
                            move_uploaded_file($image_tmp, "imageclass/$upload_image.$random_number");
                            $insert = "INSERT INTO posts_classroom (id_classroom, id_user, post_content, upload_image, post_date) VALUES('$class_id', '$user_id', '$content', '$upload_image.$random_number', NOW())";
                            $run = mysqli_query($db_connect, $insert);
                            if ($run) {
                                echo "<script>window.open('classroom.php?class_id=".$class_id."', '_self')</script>";
                                $update = "UPDATE users SET posts_class='yes' WHERE id_user='$user_id'";
                                $run_update = mysqli_query($db_connect, $update);
                            }
                            exit();
                        } else if ($upload_docs != '' && $content != '' && $upload_image == '') {
                            move_uploaded_file($docs_tmp, "docsclass/'$upload_docs'");
                            $insert = "INSERT INTO posts_classroom (id_classroom, id_user, post_content, upload_docs, post_date) VALUES('$class_id', '$user_id', '$content', '$upload_docs', NOW())";
                            $run = mysqli_query($db_connect, $insert);
                            if ($run) {
                                echo "<script>window.open('classroom.php?class_id=".$class_id."', '_self')</script>";
                                $update = "UPDATE users SET posts_class='yes' WHERE id_user='$user_id'";
                                $run_update = mysqli_query($db_connect, $update);  
                            }
                            exit();
                        } else if ($upload_docs != '' && $upload_image != ''  && $content == '') {
                            move_uploaded_file($image_tmp, "imageclass/$upload_image.$random_number");
                            move_uploaded_file($docs_tmp, "docsclass/'$upload_docs'");
                            $insert = "INSERT INTO posts_classroom (id_classroom, id_user, upload_image, upload_docs, post_date) VALUES('$class_id', '$user_id', '$upload_image.$random_number', '$upload_docs', NOW())";
                            $run = mysqli_query($db_connect, $insert);
                            if ($run) {
                                echo "<script>window.open('classroom.php?class_id=".$class_id."', '_self')</script>";
                                $update = "UPDATE users SET posts_class='yes' WHERE id_user='$user_id'";
                                $run_update = mysqli_query($db_connect, $update);
                            }
                            exit();
                        } else if ($upload_image != '' && $content == '' && $upload_docs == ''){
                            move_uploaded_file($image_tmp, "imageclass/$upload_image.$random_number");
                            $insert = "INSERT INTO posts_classroom (id_classroom, id_user, upload_image, post_date) VALUES ('$class_id', '$user_id','$upload_image.$random_number', NOW())";
                            $run = mysqli_query($db_connect, $insert);
                            if ($run) {
                                echo "<script>window.open('classroom.php?class_id=".$class_id."', '_self')</script>";
                                $update = "UPDATE users SET posts_class='yes' WHERE id_user='$user_id'";
                                $run_update = mysqli_query($db_connect, $update);
                            }
                            exit();
                        } else if ($content != '' && $upload_docs == '' && $upload_image == '') {
                            $insert = "INSERT INTO posts_classroom (id_classroom, id_user, post_content, post_date) VALUES('$class_id', '$user_id', '$content', NOW())";
                            $run = mysqli_query($db_connect, $insert);
                            if ($run) {
                                echo "<script>window.open('classroom.php?class_id=".$class_id."', '_self')</script>";
                                $update = "UPDATE users SET posts_class='yes' WHERE id_user='$user_id'";
                                $run_update = mysqli_query($db_connect, $update);
                            }
                            exit();
                        } else if ($upload_docs != '' && $content == '' && $upload_image == '') {
                            move_uploaded_file($docs_tmp, "docsclass/$upload_docs");
                            $insert = "INSERT INTO posts_classroom (id_classroom, id_user, upload_docs, post_date) VALUES('$class_id', '$user_id', '$upload_docs', NOW())";
                            $run = mysqli_query($db_connect, $insert);
                            if ($run) {
                                echo "<script>window.open('classroom.php?class_id=".$class_id."', '_self')</script>";
                                $update = "UPDATE users SET posts_class='yes' WHERE id_user='$user_id'";
                                $run_update = mysqli_query($db_connect, $update);
                            }
                            exit();
                        }
                    }
                }
            }
        }
    }

    function get_postClassroom() {
        global $db_connect;
        $class_id = $_GET['class_id'];

        $get_posts = "SELECT * FROM posts_classroom WHERE id_classroom='$class_id' ORDER by post_date DESC";
	    $run_posts = mysqli_query($db_connect, $get_posts);
	    while ($row_posts = mysqli_fetch_array($run_posts)) {
            $post_id = $row_posts['id_post'];
            $user_id = $row_posts['id_user'];
            $content = $row_posts['post_content'];
            $upload_image = $row_posts['upload_image'];
            $upload_docs = $row_posts['upload_docs'];
            $post_date = $row_posts['post_date'];

            $user = "SELECT * FROM users WHERE id_user='$user_id' AND posts_class='yes'";
            $run_user = mysqli_query($db_connect, $user);
            $row_user = mysqli_fetch_array($run_user);
            $user_name = $row_user['f_name'] . " " . $row_user['l_name'];
            $user_image = $row_user['u_image'];

            if ($content != "" && strlen($upload_image) >= 1 && strlen($upload_docs) >= 1){
                echo '
                    <div class="col-sm-12" style="background-color: #ECECEC; height: auto; border-radius: 15px 15px 0 0; padding-top:10px; padding-left:5px; padding-bottom:10px; margin-top:15px;">
                        <div class="profile-status2" style="background-image: url(users/'.$user_image.'); margin-left:15px; margin-right:10px;"></div>
                        <p style="margin-left:3px; font-size:19px; margin-bottom:0; padding:0;"><a href="users.php?u_id='.$user_id.'" style="text-decoration:none; cursor:pointer; color: #171717;">'.$user_name.'</a></p>
                        <p style="font-size:12px; padding:0; margin-top:0; margin-bottom:0;"><small>'.$post_date.'</small></p>
                    </div>
                    <div class="col-sm-12" style="background-color: #FBFBFB; height: auto; border-radius: 0 0 15px 15px; padding-top:15px; padding-left:30px; padding-right:25px; padding-bottom:15px;">
                        <p style="font-size:17px; margin-bottom:0; padding:0;">'.$content.'</p>
                        <img src="imageclass/'.$upload_image.'" style="border-radius:10px; padding-top: 5px; display: block; margin: 0 auto; width:550px;">
                        <div style="padding-top: 10px;"><a href="docsclass/'.$upload_docs.'" style="color: #171717;"><img src="images/google-docs.svg" style="width: 28px; height: 28px; margin-right:5px;">'.$upload_docs.'</a></div>
                    </div>
                ';
            } else {
                if ($upload_image != '' && $content != '' && $upload_docs == '') {
                    echo '
                        <div class="col-sm-12" style="background-color: #ECECEC; height: auto; border-radius: 15px 15px 0 0; padding-top:10px; padding-left:5px; padding-bottom:10px; margin-top:15px;">
                            <div class="profile-status2" style="background-image: url(users/'.$user_image.'); margin-left:15px; margin-right:10px;"></div>
                            <p style="margin-left:3px; font-size:19px; margin-bottom:0; padding:0;"><a href="users.php?u_id='.$user_id.'" style="text-decoration:none; cursor:pointer; color: #171717;">'.$user_name.'</a></p>
                            <p style="font-size:12px; padding:0; margin-top:0; margin-bottom:0;"><small>'.$post_date.'</small></p>
                        </div>
                        <div class="col-sm-12" style="background-color: #FBFBFB; height: auto; border-radius: 0 0 15px 15px; padding-top:15px; padding-left:30px; padding-right:25px; padding-bottom:15px;">
                            <p style="font-size:17px; margin-bottom:0; padding:0;">'.$content.'</p>
                            <img src="imageclass/'.$upload_image.'" style="border-radius:10px; padding-top: 5px; display: block; margin: 0 auto; width:550px;">
                        </div>
                    ';
                } else if ($upload_docs != '' && $content != '' && $upload_image == '') {
                    echo '
                        <div class="col-sm-12" style="background-color: #ECECEC; height: auto; border-radius: 15px 15px 0 0; padding-top:10px; padding-left:5px; padding-bottom:10px; margin-top:15px;">
                            <div class="profile-status2" style="background-image: url(users/'.$user_image.'); margin-left:15px; margin-right:10px;"></div>
                            <p style="margin-left:3px; font-size:19px; margin-bottom:0; padding:0;"><a href="users.php?u_id='.$user_id.'" style="text-decoration:none; cursor:pointer; color: #171717;">'.$user_name.'</a></p>
                            <p style="font-size:12px; padding:0; margin-top:0; margin-bottom:0;"><small>'.$post_date.'</small></p>
                        </div>
                        <div class="col-sm-12" style="background-color: #FBFBFB; height: auto; border-radius: 0 0 15px 15px; padding-top:15px; padding-left:30px; padding-right:25px; padding-bottom:15px;">
                            <p style="font-size:17px; margin-bottom:0; padding:0;">'.$content.'</p>
                            <div style="padding-top: 10px;"><a href="docsclass/'.$upload_docs.'" style="color: #171717;"><img src="images/google-docs.svg" style="width: 28px; height: 28px; margin-right:5px;">'.$upload_docs.'</a></div>
                        </div>
                    ';
                } else if ($upload_docs != '' && $upload_image != ''  && $content == '') {
                    echo '
                        <div class="col-sm-12" style="background-color: #ECECEC; height: auto; border-radius: 15px 15px 0 0; padding-top:10px; padding-left:5px; padding-bottom:10px; margin-top:15px;">
                            <div class="profile-status2" style="background-image: url(users/'.$user_image.'); margin-left:15px; margin-right:10px;"></div>
                            <p style="margin-left:3px; font-size:19px; margin-bottom:0; padding:0;"><a href="users.php?u_id='.$user_id.'" style="text-decoration:none; cursor:pointer; color: #171717;">'.$user_name.'</a></p>
                            <p style="font-size:12px; padding:0; margin-top:0; margin-bottom:0;"><small>'.$post_date.'</small></p>
                        </div>
                        <div class="col-sm-12" style="background-color: #FBFBFB; height: auto; border-radius: 0 0 15px 15px; padding-top:15px; padding-left:30px; padding-right:25px; padding-bottom:15px;">
                            <img src="imageclass/'.$upload_image.'" style="border-radius:10px; padding-top: 5px; display: block; margin: 0 auto; width:550px;">
                            <div style="padding-top: 10px;"><a href="docsclass/'.$upload_docs.'" style="color: #171717;"><img src="images/google-docs.svg" style="width: 28px; height: 28px; margin-right:5px;">'.$upload_docs.'</a></div>
                        </div>
                    ';
                } else if ($upload_image != '' && $content == '' && $upload_docs == ''){
                    echo '
                        <div class="col-sm-12" style="background-color: #ECECEC; height: auto; border-radius: 15px 15px 0 0; padding-top:10px; padding-left:5px; padding-bottom:10px; margin-top:15px;">
                            <div class="profile-status2" style="background-image: url(users/'.$user_image.'); margin-left:15px; margin-right:10px;"></div>
                            <p style="margin-left:3px; font-size:19px; margin-bottom:0; padding:0;"><a href="users.php?u_id='.$user_id.'" style="text-decoration:none; cursor:pointer; color: #171717;">'.$user_name.'</a></p>
                            <p style="font-size:12px; padding:0; margin-top:0; margin-bottom:0;"><small>'.$post_date.'</small></p>
                        </div>
                        <div class="col-sm-12" style="background-color: #FBFBFB; height: auto; border-radius: 0 0 15px 15px; padding-top:5px; padding-left:30px; padding-right:25px; padding-bottom:15px;">
                            <img src="imageclass/'.$upload_image.'" style="border-radius:10px; padding-top: 5px; display: block; margin: 0 auto; width:550px;">
                        </div>
                    ';
                } else if ($content != '' && $upload_docs == '' && $upload_image == '') {
                    echo '
                        <div class="col-sm-12" style="background-color: #ECECEC; height: auto; border-radius: 15px 15px 0 0; padding-top:10px; padding-left:5px; padding-bottom:10px; margin-top:15px;">
                            <div class="profile-status2" style="background-image: url(users/'.$user_image.'); margin-left:15px; margin-right:10px;"></div>
                            <p style="margin-left:3px; font-size:19px; margin-bottom:0; padding:0;"><a href="users.php?u_id='.$user_id.'" style="text-decoration:none; cursor:pointer; color: #171717;">'.$user_name.'</a></p>
                            <p style="font-size:12px; padding:0; margin-top:0; margin-bottom:0;"><small>'.$post_date.'</small></p>
                        </div>
                        <div class="col-sm-12" style="background-color: #FBFBFB; height: auto; border-radius: 0 0 15px 15px; padding-top:15px; padding-left:30px; padding-right:25px; padding-bottom:15px;">
                            <p style="font-size:17px; margin-bottom:0; padding:0;">'.$content.'</p>
                        </div>
                    ';
                } else if ($upload_docs != '' && $content == '' && $upload_image == '') {
                    echo '
                        <div class="col-sm-12" style="background-color: #ECECEC; height: auto; border-radius: 15px 15px 0 0; padding-top:10px; padding-left:5px; padding-bottom:10px; margin-top:15px;">
                            <div class="profile-status2" style="background-image: url(users/'.$user_image.'); margin-left:15px; margin-right:10px;"></div>
                            <p style="margin-left:3px; font-size:19px; margin-bottom:0; padding:0;"><a href="users.php?u_id='.$user_id.'" style="text-decoration:none; cursor:pointer; color: #171717;">'.$user_name.'</a></p>
                            <p style="font-size:12px; padding:0; margin-top:0; margin-bottom:0;"><small>'.$post_date.'</small></p>
                        </div>
                        <div class="col-sm-12" style="background-color: #FBFBFB; height: auto; border-radius: 0 0 15px 15px; padding-top:5px; padding-left:30px; padding-right:25px; padding-bottom:15px;">
                            <div style="padding-top: 10px;"><a href="docsclass/'.$upload_docs.'" style="color: #171717;"><img src="images/google-docs.svg" style="width: 28px; height: 28px; margin-right:5px;">'.$upload_docs.'</a></div>
                        </div>
                    ';
                }
            }
        }
    }

    function search() {
        global $db_connect;

        if (isset($_GET['search'])) {
            if (isset($_GET['pencarian'])) {
                $search = htmlentities($_GET['pencarian']);
                if ($search != "") {
                    $user = "SELECT * FROM users WHERE f_name LIKE '%$search%' OR l_name LIKE '%$search%' OR u_name LIKE '%$search%'";
                    $classroom = "SELECT * FROM classroom WHERE nama_classroom LIKE '%$search%' OR keterangan LIKE '%$search%'";
                    $run_user = mysqli_query($db_connect, $user);
                    $run_classroom = mysqli_query($db_connect, $classroom);

                    while ($row = $run_user->fetch_assoc()) {
                        $user_id = $row['id_user'];
                        $fullname = $row['f_name'] . " " . $row['l_name'];
                        $username = $row['u_name'];
                        $user_image = $row['u_image'];
                        $user_konsentrasi = $row['u_konsentrasi'];

                        echo '
                        <div class="col-sm-8" style="margin-top:20px;">
                            <div class="profile-status2" style="background-image: url(users/'.$user_image.'); margin-right:20px;"></div>
                            <h3 style="margin-left:5px; margin-bottom:0; padding:0;"><a href="users.php?u_id='.$user_id.'" style="text-decoration:none; cursor:pointer; color: #171717;">'.$fullname.'</a></h3>
                            <h5 style="margin-left:5px; margin-bottom:0; padding-top:5px;">'.$username.'</h5>
                            <h5 style="margin-left:5px; margin-bottom:0; padding-top:5px;">'.$user_konsentrasi.'</h5>
                        </div>
                        ';
                    }

                    while ($row = $run_classroom->fetch_assoc()) {
                        $class_id = $row['id_classroom'];
                        $nama_classroom = $row['nama_classroom'];
                        $keterangan = $row['keterangan'];

                        echo '
                        <div class="col-sm-8" style="margin-top:20px;">
                            <img class="profile-status2" src="images/discussion.svg" style="margin-right:20px;">
                            <h3 style="margin-left:5px; margin-bottom:0; padding:0;"><a href="classroom.php?class_id='.$class_id.'" style="text-decoration:none; cursor:pointer; color: #171717;">'.$nama_classroom.'</a></h3>
                            <p style="margin-left:5px; margin-bottom:0; padding-top:5px;">'.$keterangan.'</p>
                        </div>
                        ';
                    }
                } else {
                    echo '<p style="margin-left:5px; margin-bottom:0; padding-top:13px;">Ketik kata kunci di kolom pencarian!</p>';
                }   
            }        
        }
    }
?>