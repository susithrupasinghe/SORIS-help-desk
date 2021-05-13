<?php

require '../../config/config.php';


if (isset($_GET['verification']) && isset($_GET['email'])) {

    $email = $_GET["email"];
    $token = base64_decode($_GET["verification"]);

    $con = openCon();

    $sql = "SELECT password FROM users WHERE email='$email'";

    $result = $con->query($sql);

    if ($result->num_rows > 0) {

        $row = mysqli_fetch_row($result);

        if ($token != $row[0]) {

            header("Location: ../../index.php");
        }
    } else {
        header("Location: ../../index.php");

    }
}

?>


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
    $page = "";
    include("../../res/templates/header.php");
    include("../../res/templates/navigation.php");
    ?>

    <div class="body-container">

        <form method="POST" name="changPassword">
            <div class="card" style="margin-left:20vw;margin-right:20vw;width:50%">
                <h2 style="font-family:Sitara;margin-left:160px;font-family:Sitara, sans-serif;">Add New Password</h2>

                <label for="password" style="font-family:Sitara, sans-serif;font-weight:bold;margin-left:30px;">Password</label>
                <input style="margin-left:80px;" class="txt-input" type="text" id="newPass" name="newPass" oninput="validpassword(this)" required></br>
                </br>

                <label for="repassword" style="font-family:Sitara, sans-serif;font-weight:bold;margin-left:30px;">Password re-type</label>
                <input style="margin-left:25px;" class="txt-input" type="text" id="RePass" name="RePass" required></br>
                </br> </br> </br>

                <input type="submit" value="Cancel" class="btt type2" name="btnsubmit" style="margin-left:150px;">
                <input type="submit" value="Change password" class="btt type1" name="btnsubmit" style="margin-left:10px;">
            </div>
        </form>

    </div>

    <script>
        function validpassword(parameter) {
            var newPassword = parameter.value;
            var lowerCase = /[a-z]/;
            var uppercase = /[A-Z]/;
            var number = /[0-9]/;

            if ((newPassword.match(lowerCase)) && (newPassword.match(uppercase)) && (newPassword.match(number))) {
                parameter.style.border = "3px solid #1d4354";
                return true;
            } else {
                parameter.style.border = "3px solid #ff0000";
                return false;
            }

            /*function validRePassword(param)
            {
                if(document.changPassword.newPass.value=="")
                {
                    alert("Password Filed is Empty!!");
                    return false;
                }
                else
                if(document.changPassword.RePass.value=="")
                {
                    alert("Password re-type Fieled is Empty!!");
                }
                else
                if(document.changPassword.newPass.value!=document.changPassword.RePass.value)
                {
                    alert("Password and Password re-type Field do not match");
                    return false;
                }
                else
                return true;
            }*/
        }
    </script>

    <?php
    if (isset($_POST['btnsubmit'])) {
        $new_pass = $_POST['newPass'];
        $re_pass = $_POST['RePass'];

        if ($new_pass == $re_pass) {
            $update_pass = mysqli_info("UPDATE user set password='$new_pass' WHERE id='1'");
            echo "<script>alert('');widow.location='dashboard.php'</script>";
        } else
            echo "<script>alert('Password and Password re-type Field do not match');window.location='newPassword.php'</script>";
    }
    ?>

    <?php include("../../res/templates/footer.php");  ?>
    <script src="../../js/script.js"></script>

</body>

</html>