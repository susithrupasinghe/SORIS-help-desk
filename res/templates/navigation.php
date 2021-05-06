
    <ul class="navigation">
       <?php 

       // Menu items for only logged in users
       
       if (isset($_SESSION["userid"]) && isset($_SESSION["role"])){

        if($page=="dashboard"){

            echo <<<HTML
            <li style="background-color:#ECF3EE;"><a href="#home" >Dashboard</a></li>
            HTML; 
        }
        else{
            echo <<<HTML
            <li><a href="#home" >Dashboard</a></li>
            HTML; 

        }

    }

    ///////////////////////////////////////////////////
        ?>


        <li <?php echo ($page=="home") ? "style='background-color:#ECF3EE;'" : ''; ?> ><a href="#news">Home</a></li>
        <li <?php echo ($page=="information") ? "style='background-color:#ECF3EE;'" : ''; ?> ><a href="#contact">Information</a></li>
        <li <?php echo ($page=="news") ? "style='background-color:#ECF3EE;'" : ''; ?> ><a href="#about">NEWS</a></li>
        <li <?php echo ($page=="about") ? "style='background-color:#ECF3EE;'" : ''; ?> ><a href="#about">FAQ</a></li>
        <li <?php echo ($page=="contactus") ? "style='background-color:#ECF3EE;'" : ''; ?> ><a href="#about">Contact Us</a></li>
    </ul>





