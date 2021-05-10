<ul class="navigation">
    <?php

    // Menu items for only logged in users

    if (isset($_SESSION["userid"]) && isset($_SESSION["role"])) {

        if ($_SESSION["role"] == "administrator") {

            if ($page == "dashboard") {

                echo <<<HTML
                <li style="background-color:#ECF3EE;"><a href="/SORIS-help-desk/res/admin/dashboard.php" >Dashboard</a></li>
                HTML;
            } else {
                echo <<<HTML
                <li><a href="/SORIS-help-desk/res/admin/dashboard.php" >Dashboard</a></li>
                HTML;
            }

            if ($page == "contentmanagement") {

                echo <<<HTML
                <li style="background-color:#ECF3EE;"><a href="/SORIS-help-desk/res/content/contentDashboard.php" >Content Management</a></li>
                HTML;
            } else {
                echo <<<HTML
                <li><a href="/SORIS-help-desk/res/content/contentDashboard.php" >Content Management</a></li>
                HTML;
            }
        }
        else if($_SESSION["role"] == "staff"){

            if ($page == "dashboard") {

                echo <<<HTML
                <li style="background-color:#ECF3EE;"><a href="/SORIS-help-desk/res/staff/dashboard.php" >Dashboard</a></li>
                HTML;
            } else {
                echo <<<HTML
                <li><a href="/SORIS-help-desk/res/staff/dashboard.php" >Dashboard</a></li>
                HTML;
            }

            if ($page == "contentmanagement") {

                echo <<<HTML
                <li style="background-color:#ECF3EE;"><a href="/SORIS-help-desk/res/content/contentDashboard.php" >Content Management</a></li>
                HTML;
            } else {
                echo <<<HTML
                <li><a href="/SORIS-help-desk/res/content/contentDashboard.php" >Content Management</a></li>
                HTML;
            }


        }
        else{

            if ($page == "dashboard") {

                echo <<<HTML
                <li style="background-color:#ECF3EE;"><a href="/SORIS-help-desk/res/student/dashboard.php" >Dashboard</a></li>
                HTML;
            } else {
                echo <<<HTML
                <li><a href="/SORIS-help-desk/res/student/dashboard.php" >Dashboard</a></li>
                HTML;
            }

        }
    }

    ///////////////////////////////////////////////////
    ?>


    <li <?php echo ($page == "home") ? "style='background-color:#ECF3EE;'" : ''; ?>><a href="/SORIS-help-desk/index.php">Home</a></li>
    <li <?php echo ($page == "information") ? "style='background-color:#ECF3EE;'" : ''; ?>><a href="/SORIS-help-desk/res/content/information.php">Information</a></li>
    <li <?php echo ($page == "news") ? "style='background-color:#ECF3EE;'" : ''; ?>><a href="/SORIS-help-desk/res/content/news.php">NEWS</a></li>
    <li <?php echo ($page == "faq") ? "style='background-color:#ECF3EE;'" : ''; ?>><a href="/SORIS-help-desk/res/content/faq.php">FAQ</a></li>
    <li <?php echo ($page == "contactus") ? "style='background-color:#ECF3EE;'" : ''; ?>><a href="/SORIS-help-desk/res/content/contactUs.php">Contact Us</a></li>
</ul>