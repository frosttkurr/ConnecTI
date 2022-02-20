<div class="row">
    <div class="col-sm-12">
        <div class="card-header bg-light" style="height: 70px">
            <div class="col-sm-4" style="float: left;">
                <a href="home.php">
                    <img id="logo-ti" src="images/logoti.png" alt="" width="55px" style="float: left; margin-right: 15px;">
                </a>
                <form autocomplete="off" class="form-inline" action="search.php?=" method="GET">
                    <div class="input-group mt-1" style="width:350px">
                        <input id="search" type="text" class="form-control" placeholder="Pencarian" name="pencarian" style="border-color: #785233; border-radius: 0.5cm; margin-right: 5px;">
                        <button type="submit" class="btn" name="search" style="background-color:none; border-color:#785233; color:#785233; border-radius: 0.5cm; width=100px">Search</button>
                    </div>
                </form> 
            </div>
            <div class="col-sm-4" style="float: left;">
                <center>
                    <a href="home.php">
                        <img src="images/home.svg" alt="" width="45px" style="margin-right: 8%">
                    </a>
                    <a href="list-classroom.php">
                        <img src="images/discussion.svg" alt="" width="38px">
                    </a>
                </center>
            </div>
            <div class="col-sm-4" style="float: left; padding-top:4px;">
                <a href="profile.php?<?php echo "user=$user_id" ?>" style="text-decoration:none; color: #171717; margin-left: 250px; margin-right: 2%; float:left">
                    <?php 
                        $path_profile = "users/";
                        echo '<p style="float:left; padding-top:7px;"><b>'.$fullname.'</b>&#8287;&#8287;&#8287;</p>';
                        echo '<div class="box-profile" style="background-image: url('.$path_profile.$user_image.');"></div>';
                    ?>     
                </a>
                <div style="float:right;">
                    <a style="" href="includes/logout.php">
                        <img src="images/log-out.svg" alt="" style="padding-top:4px;" width="30px">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>