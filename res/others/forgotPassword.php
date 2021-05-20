<!--Session Start-->
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
    <title>Forgot Password</title>

    <link rel="stylesheet" href="../../css/style.css">

    <link href="http://fonts.cdnfonts.com/css/sitara" rel="stylesheet">
</head>

<body>

    <?php
    $page = "";
    require '../../config/config.php';
    include("../../res/templates/header.php");
    include("../../res/templates/navigation.php");
    ?>

    <div class="body-container">

        <!--Front end-->
        <form method="POST" >
            <div class="card" style="margin:auto;text-align:center;">
                <h2 style="font-family:Sitara, sans-serif;">Forgot Password</h2>
                
                <div >
                <label for="email " style="font-family:Sitara,sans-serif;font-weight:bold;">Email </label>
                <input style="margin-left:35px;" class="txt-input" type="text" id="email" name="email" oninput="validemail(this)" required></br>
                </div>
               
                </br> </br>

                <input type="submit" value="Send verification email" class="btt type1" name="btnsubmit" >
            </div>
        </form>

        <!--Check e-mail pattern-->
        <script>
            function validemail(mail) {
                var email = /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/;
                var inputemail = mail.value;

                if (inputemail.match(email)) {
                    mail.style.border = "3px solid #1d4354";
                    return true;
                } else {
                    mail.style.border = "3px solid #ff0000";
                    return false;
                }
            }
        </script>

        <!--Send e-mail verification-->
        <?php
        require '../../res/mail/mailer.php';
        $conn = openCon();
        if (isset($_POST['btnsubmit'])) {

            $inputMail = $_POST['email'];

            $sql = "SELECT password FROM users WHERE email='$inputMail'";
            $result = $conn->query($sql);
            $row = mysqli_fetch_assoc($result);

            if ($result->num_rows > 0) {

                $password_hash = $row['password'];
                $verification_token = base64_encode($password_hash);
                $link = "http://localhost/SORIS-help-desk/res/others/newPassword.php?verification=$verification_token&email=$inputMail";
                $verify_mail = send_Forgot_password($inputMail, $link);

                ///  Link format //////////////////

                // http://localhost/SORIS-help-desk/res/others/newPassword.php?verification=< verification token >&&email=< email >

                // How to Create verification Token
                // Retive password hash from database according to given email
                // Then encode it as Base64 string, Like this,
                // $verification_token = base64_encode($password_hash)
                // Now you can create URL like above i mentioned

                //$verification_token = base64_encode($password_hash)
                //send_Verify_Email("shavidilunika10s@gmail.com","https://testetst.com");
                //send_Forgot_password("shavidilunika10s@gmail.com","https://testetst.com");

                echo <<< HTML
                        <div class='alert success' style= 'width:40%; margin-left:400px; position:absolute; top: 20%;'>
                        <span class='closebtn'>&times;</span>
                        <strong style= 'text-align:center;font-size: 30x;'>Please visit your E-mail! Click on verify link</strong> 
                        </div>
                        HTML;
            } else {
                echo <<< HTML
                <div class='alert' style= 'width:40%; margin-left:400px; position:absolute; top: 20%;'>
                <span class='closebtn'>&times; </span>
                <strong style= 'text-align:center;font-size: 30x;'>You are not registered!</strong>
                </div>
                HTML;
            }
        }
        ?>

        </div>

        <!--Footer-->
        <?php include("../../res/templates/footer.php");  ?>
        <script src="../../js/script.js"></script>

</body>

</html>