<div>
    <div class="header">

        <div>
            <h1 class="logo txt-green" style="padding-left:17vw; padding-top:15px; text-align:left;float:left;">SO</h1>
            <h1 class="logo txt-white" style="padding-top:15px; text-align:right; float:left;">RIS</h1>
            <div style="clear: both;"></div>
            <h1 class="logo txt-greenlight" style="padding-left:21vw; margin-top:-4vh;">Help Desk</h1>

            <?php

            session_start();

            if (isset($_SESSION["userid"])) {
            } else {
                echo <<<HTML

                <div style="float:right; margin-top:-8vh; margin-right:5vw;">
                <button class="btt type2" style="margin-right: 25px;" >Student SignUp</button>
                <button class="btt type1" style="margin-right: 10px;">Student Login</button>
                <button class="btt type1">Staff Login</button>
                
                </div>
                HTML;
            }
            ?>



        </div>


    </div>




</div>