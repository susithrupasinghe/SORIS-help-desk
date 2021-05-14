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
    require '../../config/config.php';
    include("../../res/templates/header.php");
    include("../../res/templates/navigation.php");
    ?>

    <div class="body-container">

        <form method="POST">
            <div class="card" style="margin-left:25vw;margin-right:25vw;">
                <h2 style="font-family:Sitara;margin-left:140px;font-family:Sitara, sans-serif;">Forgot Password</h2>

                <label for="email " style="font-family:Sitara, sans-serif;font-weight:bold;">Email </label>
                <input style="margin-left:35px;" class="txt-input" type="text" id="email" name="email" oninput="validemail(this)" required></br>
                </br> </br>

                <input type="submit" value="Send verification email" class="btt type1" name="btnsubmit" style="margin-left:145px;">
            </div>
        </form>

    </div>

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


<?php
    if(isset($_POST['btnsubmit']))
    {
        $inputMail=$_POST['email'];

        $conn=openCon();

        $sql="SELECT email FROM users WHERE email='$inputMail'";
        $result=$conn->query($sql);
       // $row=mysqli_fetch_assoc($result);

        if($result->num_rows>0)
        {
            // $row = mysqli_fetch_row($result);
            while($row=$result->fetch_assoc())
            {
                echo "Invalid";
            }
            // $row[0];
        require '../../res/mail/mailer.php';


        ///  Link format //////////////////

        // http://localhost/SORIS-help-desk/res/others/newPassword.php?verification=< verification token >&&email=< email >
        
        // How to Create verification Token
        // Retive password hash from database according to given email
        // Then encode it as Base64 string, Like this,
        // $verification_token = base64_encode($password_hash)
        // Now you can create URL like above i mentioned
        
                send_Verify_Email("shavidilunika10s@gmail.com","https://testetst.com");
                send_Forgot_password("shavidilunika10s@gmail.com","https://testetst.com");
        }
    }

       
    ?>


  

    <?php include("../../res/templates/footer.php");  ?>
    <script src="../../js/script.js"></script>

</body>

</html>