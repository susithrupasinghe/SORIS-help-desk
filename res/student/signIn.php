<?php 

session_start();

if (isset($_SESSION["userid"]) && isset($_SESSION["role"])) {


        header("Location: ../../index.php");

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student SignIn</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="icon" href="../../images/favicon.svg" sizes="any" type="image/svg+xml">
    <link href="http://fonts.cdnfonts.com/css/sitara" rel="stylesheet">

</head>

<body>

    <?php


    $page = "student login";
    require '../../config/config.php';
    include("../templates/header.php");
    include("../templates/navigation.php");
    ?>


    <div class="body-container" style="background:linear-gradient(rgba(255,255,255,.7), rgba(255,255,255,.7)), url('../../images/bg4.svg');background-repeat: no-repeat;background-size: 80%;">
        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $email = $_POST['email'];
            $password = $_POST['password'];


            $con = openCon();

            $sqlquery = "SELECT password FROM users WHERE email='" . $email . "' AND role='student'";
            $result = $con->query($sqlquery);

            if ($result->num_rows > 0) {

                $row = $result->fetch_assoc();


                //echo $row["password"];
                if (password_verify($password, $row["password"])) {

                    $_SESSION["userid"] = $email;
                    $_SESSION["role"] = "student";
                    header("Location: dashboard.php");
                } else {
                    echo <<< HTML
            <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <strong>Wrong Password !</strong> Entered password is incorrrect !. Please input correct password.
            </div>
            HTML;
                }
            } else {

                echo <<< HTML
            <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <strong>Wrong Email !</strong> Not registred email or password !. Please enter correct one.
            </div>
            HTML;
            }
        }

        ?>

        <form method="POST">

            <div class="card" style="margin-left:auto; margin-right:auto;border:3px solid #08A73A;">

                <h1 style="text-align:center; font-style:bold; font-family:'sitara',sans-serif;"> Student signIn </h1>
                <br>
                <div style=" font-family:'sitara',sans-serif; font-weight:bold; margin-left: 5%">Email <input class="txt-input" type="text" name="email" oninput="validateEmail(this)" style="margin-left:50px; min-width: 60%;" required>
                </div>

      

                <div style=" font-family:'sitara',sans-serif; font-weight:bold; margin-left: 5%"> Password <input class="txt-input" type="password" name="password" style="margin-left: 18px; min-width: 60%;"required>
                </div>
                <br><br>

        	    <a href="../others/forgotPassword.php"> <div  style="margin-right: 50px;margin-left: 100px;" class="btt type3" >Forget password</div></a>
               
                <input type="submit" value="Login" class="btt type1" name="Login" style="padding-left: 35px;padding-right: 35px;padding-top: 8px;padding-bottom: 8px;">

                <br><br><br>

                <a href="../student/signUp.php" style="color: #1D4354;margin-left:100px;" target="_blank"> New user? Click here to signUp </a>
                <br>
                <br>
            </div>

        </form>
    </div>

    <script>
        function validateEmail(email) {
            var design = /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/;
            var input = email.value;

            if (input.match(design)) {
                email.style.border = "3px solid #1D4354";
                return true;
            } else {
                email.style.border = "3px solid #ff0000";
                return false;
            }
        }
    </script>

    <?php include("../templates/footer.php");  ?>
    <script src="../../js/script.js"></script>
</body>

</html>