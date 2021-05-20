
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SORIC Administrator Dashboard</title>

    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/signup.css">


    <link href="http://fonts.cdnfonts.com/css/sitara" rel="stylesheet">
</head>
<body>
    
    <?php
     $page = "admin dashboard";
     require '../../config/config.php';
     include("../templates/header.php");
     include("../templates/navigation.php");
    ?>

    <div class="body-container">


        <h3 class= "txt-green" style="margin-left:40px;">Statictics </h3><br>

        <table class= "table-style" style= "width:70%; margin-left:auto; margin-right:auto;">
            <tr>
                <th>Section Name</th>
                <th>Active Inquiries</th>
                <th>Close Inquiries</th>
            </tr>
          
        </table>

    </div>
</body>
</html>