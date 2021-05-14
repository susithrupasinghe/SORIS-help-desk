<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SORIS Help Desk</title>
    <link rel="stylesheet" href="../../css/style.css">

    <link href="http://fonts.cdnfonts.com/css/sitara" rel="stylesheet">
</head>
<body>

<?php

$page = "dashboard";
require '../../config/config.php';
include("../../res/templates/header.php");
include("../../res/templates/navigation.php");


?>

 <div class="body-container">

    <h2 style="font-family:Sitara;margin-left:10px;font-family:Sitara, sans-serif;color:#08A73A;">Active Inquery</h2>
    <?php
        $conn = openCon();

        $sql="SELECT id FROM inquiry WHERE isActive='1'";
        $result = $conn->query($sql);
        $i=0;

        if($result->num_rows > 0)
        {
            while($result!=true)
            {
                $i=$i+1;
                break;
            }
            
           
        }
        echo "Active inquiry count :$i";

    ?>

 </div>

<?php include("../../res/templates/footer.php");  ?>
    <script src="../../js/script.js"></script>
    
</body>
</html>