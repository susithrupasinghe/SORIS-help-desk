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

<body>
    <?php



    $page = "news";
    require 'config/config.php';
    include("res/templates/header.php");
    include("res/templates/navigation.php");

    $_SESSION["role"] = "administrator";
    $_SESSION["userid"] = "admin@gmail.com";

    ?>

    <div class="body-container">

    <div class="card" style="margin-left:25vw;margin-right:25vw;">
      Email :  <input style="margin-right: -400px;" class='txt-input' type="text"><br>
      Password : <input style="margin-right: -400px;" class='txt-input' type="text">

    </div>


        


        <?php

        require 'res/mail/mailer.php';
        //send_Verify_Email("shavidilunika10s@gmail.com","https://testetst.com");
        //send_Forgot_password("shavidilunika10s@gmail.com","https://testetst.com");
        ?>


    </div>

    <?php include("res/templates/footer.php");  ?>
    <script src="js/script.js"></script>
</body>

</html>