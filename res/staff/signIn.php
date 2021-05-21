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
    <title>Staff/Admin SignIn</title>
    <link rel="stylesheet" href="../../css/style.css">

    <link href="http://fonts.cdnfonts.com/css/sitara" rel="stylesheet">

</head>

<body>

    <?php


    $page = "staff login";
    require '../../config/config.php';
    include("../templates/header.php");
    include("../templates/navigation.php");


    ?>
   


   
    <div class="body-container">

    <?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = $_POST["user"];

    $con = openCon();

    if ($user == "staff") {


        $sqlquery = "SELECT password FROM users WHERE email='" . $email . "' AND role='staff'";
        $result = $con->query($sqlquery);

        

        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();


            //echo $row["password"];
            if (password_verify($password, $row["password"])) {

                $_SESSION["userid"] = $email;
                $_SESSION["role"] = "staff";
                header("Location: dashboard.php");
            } else {
                echo <<< HTML
        <div class="alert">
        <span class="closebtn">&times;</span>
        <strong>Wrong Email !</strong> Entered password is incorrrect !. Please input correct password.
        </div>
        HTML;
            }
        } else { 
            echo <<< HTML
            <div class="alert">
            <span class="closebtn">&times;</span>
            <strong>Wrong Email !</strong> Not registred email or password !. Please enter correct one.
            </div>
            HTML;
        }
    } else if ($user == "administrator") {

        $sqlquery = "SELECT password FROM users WHERE email='" . $email . "' AND role='admin'";
        $result = $con->query($sqlquery);

      

        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();


            //echo $row["password"];
            if (password_verify($password, $row["password"])) {

                $_SESSION["userid"] = $email;
                $_SESSION["role"] = "administrator";
                header("Location: ../admin/dashboard.php");
            } else {
                echo <<< HTML
                <div class="alert">
                <span class="closebtn">&times;</span>
                <strong>Wrong Email !</strong> Entered password is incorrrect !. Please input correct password.
                </div>
                HTML;
            }
        } else {
        echo <<< HTML
        <div class="alert">
        <span class="closebtn">&times;</span>
        <strong>Wrong Email !</strong> Not registred email or password !. Please enter correct one.
        </div>
        HTML;
        }
    }


    closeCon($con);
}
?>

        <form method="POST">

            <div class="card" style="margin-left:auto;margin-right:auto;text-align:center;border:3px solid #08A73A;">

                <h1 style="text-align:center;"> Staff/Administrator signIn </h1>
                <br>
                Select User<select name="user"class="txt-input"style="min-width: 340px; margin-left: 12px;">
                    <option value="staff">Staff</option>
                    <option value="administrator">Administrator</option>
                </select>
                <br>
                Email <input class="txt-input" type="text" name="email" oninput="validateEmail(this)" style="margin-left:40px;">
                <br>
                Password <input class="txt-input" type="password" name="password" style="margin-left: 18px;">
                <br><br><br>

                <!-- <div style="margin-right: 50px;margin-left: 100px;" >
                
                </div> -->
                <a  href="../others/forgotPassword.php"  class="btt type3">Forget password</a>
                <input type="submit" value="Login" class="btt type1" name="Login" style="padding-left: 35px;padding-right: 35px;padding-top: 8px;padding-bottom: 8px;">

                <br><br><br>

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