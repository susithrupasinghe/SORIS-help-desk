<?php 

session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SORIS Help Desk</title>
    <link rel="stylesheet" href="css/style.css">

    <link href="http://fonts.cdnfonts.com/css/sitara" rel="stylesheet">

</head>
<!-- style="font-family: 'Sitara', sans-serif;"-->

<body>
    <?php
   // echo dirname(__FILE__);
    $page = "home";
    require 'config/config.php';
    include("res/templates/header.php");
    include("res/templates/navigation.php");

    ?>

    <div class="body-container">
        <!-- adding welcome message-->
        <div class="card" style="margin:auto;width:60%;margin-top:auto;padding-left:50px;padding-right:50px;border-radius:20px;">
            <h4 style="text-align:center;font-family:'Sitara',sans-serif;"> Welcome to Soris Help Desk </h4>
            <p style="text-align:center;font-family:'Sitara',sans-serif;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam in tempus urna, eu faucibus risus. Ut pharetra non ex eu fermentum.
                Vestibulum in luctus leo, eu vestibulum lorem. Quisque rhoncus </p>
        </div>
        <!--adding icons to news, information and make a inquiry-->

        <table style="margin: auto;">
            <tr>
                <td>
                <!--ADDING INFORMATION LINK BLOCK-->
                
                        <div class="card" style="height:100px;width:110px;text-align:center;border-radius:25px;">
                        <a href="res/content/information.php" style="text-decoration: none;color:#000000;">
                           <img src="images/info.svg" alt="" width="40%">
                           <p style="font-family: 'Sitara', sans-serif;">Information</p> 

                           </a>  
                        
                        </div>
                      
                </td>
                <td>
                <!-- ADDING NEWS LINK BLOCK-->
               
                    <div class="card" style="height:100px;width:110px;text-align:center;border-radius:25px;">
                    <a href="res/content/news.php" style="text-decoration: none;color:#000000;">
                        <img src="images/news.svg" alt="" width="40%">
                        <p style="font-family: 'Sitara', sans-serif;">NEWS</p>
                    </a>    
                           
                    </div>
                
                </td>
                <td>
                <!-- ADDING MAKE A INQUIRY LINK BLOCK-->
               
                <div class="card"style="height:100px;width:110px;text-align:center;border-radius:25px;">
                <a href="res/student/addInquiry.php" target="_blank" style="text-decoration: none;color:#000000;">
                        <img src="images/send.svg" alt="" width="40%">
                        <p style="font-family:'Sitara',sans-serif;"> Make a Inquiry</p>
                        </a>    
                </div>
                
                </td>
            </tr>
        </table>
        <hr style="border-top: 3px solid #1D4354; color:#1D4354">
        <!-- adding latest NEWS to homepage-->
        <h3 style="margin-left:10vw;"> NEWS </h3><br>

        <?php

        $conn = opencon();
        $sql = "SELECT u.firstName,u.lastName,c.id ,c.title,c.thumbnailText,c.authorid,c.tag FROM users u ,content c WHERE c.authorid = u.id AND c.tag = 'NEWS' LIMIT 5";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<table style='margin:auto;'><tr>";
            $i = 0;

            while ($row = $result->fetch_assoc()) {

                if ($i%5==0) {
   
                   if($i==0){
   
                   }
                   else{
                       echo "</tr><tr>";
                   }
                   $url = "content.php?id=".$row['id'];
               }
               echo <<< HTML
                   <td>
                   
                   <div class="card" style="width: 150px; margin: 15px;height: 300px; position: relative;">
                       <h4 class="txt-green" style="font-family: 'Sitara', sans-serif;text-align:center;">$row[title]"</h4>
                       <h5 style="font-family: 'Sitara', sans-serif;">$row[firstName].$row[lastName]</h5>
                       <p style="font-family: 'Sitara', sans-serif;font-size:small;">$row[thumbnailText]</p>
                       <div style="position: absolute;bottom: 15px;left: 37px;">
                       <a class="btt type1" href="$url" target="_blank"> Read more</a>
                       </div>
                      
                   </div>
                   </td>
                   HTML;
              
               $i++;
           }
   
           echo "</tr></table>";
        }

 

        ?>
        <hr style="border-top: 3px solid #1D4354; color:#1D4354">
        <!-- adding latest information to homepage-->
        <h3 style="margin-left:10vw;"> Information </h3><br>

        <?php

        $sql = "SELECT u.firstName,u.lastName,c.id ,c.title,c.thumbnailText,c.authorid,c.tag FROM users u ,content c WHERE c.authorid = u.id AND c.tag = 'Information' LIMIT 5";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<table style='margin:auto;'><tr>";
            $i = 0;

            while ($row = $result->fetch_assoc()) {

                if ($i%5==0) {
   
                   if($i==0){
   
                   }
                   else{
                       echo "</tr><tr>";
                   }
                   $url = "content.php?id=".$row['id'];
               }
               echo <<< HTML
                   <td>
                   
                   <div class="card" style="width: 150px; margin: 15px;height: 300px; position: relative;">
                       <h4 class="txt-green" style="font-family: 'Sitara', sans-serif;text-align:center;">$row[title]"</h4>
                       <h5 style="font-family: 'Sitara', sans-serif;">$row[firstName].$row[lastName]</h5>
                       <p style="font-family: 'Sitara', sans-serif;font-size:small;">$row[thumbnailText]</p>
                       <div style="position: absolute;bottom: 15px;left: 37px;">
                       <a class="btt type1" href="$url" target="_blank"> Read more</a>
                       </div>
                      
                   </div>
                   </td>
                   HTML;
              
               $i++;
           }
   
           echo "</tr></table>";
        }



        ?>







    </div>

    <?php include("res/templates/footer.php");  ?>
    <script src="js/script.js"></script>
</body>

</html>
