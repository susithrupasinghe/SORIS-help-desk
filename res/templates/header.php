<?php


if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: /SORIS-help-desk/index.php");
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


            if (isset($_SESSION["userid"]) && isset($_SESSION["role"])) {

                echo <<<HTML
                <div style="margin-top:-80px; margin-right:5vw;"> 
                HTML;


                echo "<ul style='list-style-type: None;text-align: right;'>";
                echo "<li><h4 style='margin-right:30px;color:#f8f9f8;display: block;'>";
                echo $_SESSION["userid"] . " : " . $_SESSION["role"];
                echo "</h4><img src='/SORIS-help-desk/images/avatar.png' alt='NO image' style='display: block;max-width:55px;margin-top:-50px;margin-left:90vw;'></li>";
                echo "<h4></h4>";
                echo "</ul>";
                echo "<a style='display: block;text-decoration: none;margin-left:85vw;' id='logout' href='?logout'><h4 style='color:#f8f9f8;margin-right:30px;margin-top:-30px;'>Sign Out</h4></a>";


                // echo <<<HTML
                // <img src="/SORIS-help-desk/images/avatar.png" alt="NO image" style="max-width:55px;margin-top:-50%;margin-left:90vw;">
                // </div>
                // HTML;
            } else {

            //    $_SESSION["userid"] = "susith16@gmail.com";
            //    $_SESSION["role"] = "Student";


                echo <<<HTML

    
                <div style="margin-top:-70px; ; padding-left:65%; ">
                <a href="/SORIS-help-desk/res/student/signUp.php"><button class="btt type2" style="margin-right: 25px;" >Student SignUp</button></a>
                <a href="/SORIS-help-desk/res/student/signIn.php"><button class="btt type1" style="margin-right: 10px;">Student Login</button></a>
                <a href="/SORIS-help-desk/res/staff/signIn.php"><button class="btt type1">Staff Login</button></a>
                
                </div>

                HTML;
            }



            ?>




        </div>


    </div>



</div>