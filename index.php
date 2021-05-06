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
    <?php include("res/templates/header.php");  ?>
    <?php include("res/templates/navigation.php");  ?>

    <div class="body-container">

    <div class="card">

    Email : <input type="text" class="txt-input focus"><br>
    Password : <input type="text" class="txt-input focus"><br>

    Select Here : <select name="" id="" class="txt-input focus">
        <option value="">FOC</option>
        <option value="">FOE</option>
    </select> <br>

    Remember me <input type="checkbox" class="checkbox-input" name="" id="">

    <button class="btt type1">Login</button>
    <button class="btt type3">Reset</button>
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