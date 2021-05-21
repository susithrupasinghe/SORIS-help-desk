<?php

$server_root = "/SORIS-help-desk/";


if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ".$server_root."index.php");
}


?>


<div>
    <div class="header">

        <div >
            <h1 class="logo txt-green" style="padding-left:17%; padding-top:8px; text-align:left;float:left;">SO</h1>
            <h1 class="logo txt-white" style="padding-top:8px; text-align:right; float:left;">RIS</h1>
            <div style="clear: both;"></div>
            <h1 class="logo txt-greenlight" style="padding-left:21%; margin-top:-25px;">Help Desk</h1>

            <?php

            $avatar  = $server_root . "images/avatar.png";
            $std_signUp =  $server_root . "res/student/signUp.php";
            $std_SignIn =  $server_root . "res/student/signIn.php";
            $staff_login = $server_root . "res/staff/signIn.php";
            

            if (isset($_SESSION["userid"]) && isset($_SESSION["role"])) {

                echo <<<HTML
                <div style="margin-top:-80px; margin-right:5vw;"> 
                <ul style='list-style-type: None;text-align: right;'>
                <li><h4 style='margin-right:30px;color:#f8f9f8;display: block;'>
                HTML;
                
                echo $_SESSION["userid"] . " : " . $_SESSION["role"];

                echo <<< HTML
                </h4><img src="$avatar" alt="NO image" style="display: block;max-width:55px;margin-top:-50px;margin-left:90vw;"></li>
                <h4></h4>
                </ul>
                <a style='display: block;text-decoration: none;margin-left:85vw;' id='logout' href='?logout'><h4 style='color:#f8f9f8;margin-right:30px;margin-top:-30px;'>Sign Out</h4></a>
                HTML;

                // echo <<<HTML
                // <img src="/SORIS-help-desk/images/avatar.png" alt="NO image" style="max-width:55px;margin-top:-50%;margin-left:90vw;">
                // </div>
                // HTML;
            } else {

                echo <<<HTML

    
                <div style="margin-top:-70px; ; padding-left:65%; ">
                <a href="$std_signUp"><button class="btt type2" style="margin-right: 25px;" >Student SignUp</button></a>
                <a href="$std_SignIn"><button class="btt type1" style="margin-right: 10px;">Student Login</button></a>
                <a href="$staff_login"><button class="btt type1">Staff Login</button></a>
                
                </div>

                HTML;
            }



            ?>




        </div>


    </div>



</div>