<!--Session Start-->
<?php
session_start();
?>

<!--email-->
<?php
require '../../config/config.php';

$con = openCon();

if (isset($_GET['verification']) && isset($_GET['email'])) {

    $email = $_GET["email"];
    $token = base64_decode($_GET["verification"]);

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

closeCon($con);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SORIS Help Desk/New Password</title>

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

        <!--Ckeck change password and update data-->
        <?php
        $con = openCon();
        if (isset($_POST['btnsubmit'])) {

            $email = $_GET['email'];
            $new_pass = $_POST['newPass'];
            $re_pass = $_POST['RePass'];

            if ($new_pass == $re_pass) {

                $hashPass = password_hash($nPassword, PASSWORD_DEFAULT);
                $sql = "UPDATE users SET password = '$hashPass' WHERE email='$email'";
                $result = $con->query($sql);

                if ($result) {

                    header("Location: ../../index.php");
                } else {
                    echo <<< HTML
                            <div class='alert' style= 'width:40%; margin-left:400px; position:absolute; top: 20%;'>
                            <span class='closebtn'>&times;</span>
                            <strong>Error!</strong> Password not changed !!!
                            </div>
                            HTML;
                }
            } else {
                echo <<< HTML
                    <div class='alert' style= 'width:40%; margin-left:400px; position:absolute; top: 20%;'>
                    <span class='closebtn'>&times;</span>
                    <strong style= 'text-align:center;font-size: 30x;'>Password and Password re-type Field do not match</strong>
                    </div>
                    HTML;
            }
        }
        closeCon($con);
        ?>

        <!--Front end-->
        <form method="POST" name="changPassword">
            <div class="card" style="margin-left:20vw;margin-right:20vw;width:50%">
                <h2 style="font-family:Sitara;margin-left:165px;font-family:Sitara, sans-serif;">Add New Password</h2>

                <label for="password" style="font-family:Sitara, sans-serif;font-weight:bold;margin-left:30px;">Password</label>
                <input style="margin-left:80px;" class="txt-input" type="text" id="newPass" name="newPass" oninput="validpassword(this)" required></br>
                </br>

                <label for="repassword" style="font-family:Sitara, sans-serif;font-weight:bold;margin-left:30px;">Password re-type</label>
                <input style="margin-left:25px;" class="txt-input" type="text" id="RePass" name="RePass" required></br>
                </br> </br> </br>

                <input type="submit" value="Cancel" class="btt type3" name="btnsubmit" style="margin-left:150px;">
                <input type="submit" value="Change password" class="btt type1" name="btnsubmit" style="margin-left:10px;">
                </br></br></br>
            </div>
        </form>

    </div>

    <!--Ckeck password strong-->
    <script>
        function validpassword(parameter) {
            var newPassword = parameter.value;
            var lowerCase = /[a-z]/;
            var uppercase = /[A-Z]/;
            var number = /[0-9]/;
            var symbol = /[@#$%^&*]/;
            var length = newPassword.length;

            if ((newPassword.match(lowerCase)) && (newPassword.match(uppercase)) && (newPassword.match(number)) && (length >= 4) && (length <= 10) && (newPassword.match(symbol))) {
                parameter.style.border = "3px solid #1d4354";
                return true;
            } else {
                parameter.style.border = "3px solid #ff0000";
                return false;
            }
        }
    </script>

    <!--Footer-->
    <?php include("../../res/templates/footer.php");  ?>
    <script src="../../js/script.js"></script>

</body>

</html>