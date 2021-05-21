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
<!--
    <div class="body-container">


        <h3 class="txt-green" style="margin-left:40px;">Statictics </h3><br>

        <table class="table-style" style="width:70%; margin-left:auto; margin-right:auto;">
            <tr>
                <th>Section Name</th>
                <th>Active Inquiries</th>
                <th>Close Inquiries</th>
            </tr>
          
        </table>

    </div>-->


    <div class="body-container">

<form method="post">
    <div class="card" id="card" style="min-width:50%;margin-left:auto;margin-right:auto;">
        <h1 style="text-align:center; font-style:bold; font-family:'sitara',sans-serif;">Add Section </h1>
        <br>

        <label for="staffID" style=" font-family:'sitara',sans-serif; font-weight:bold;margin-left:60px;">Staff ID </label>
        <input class="txt-input" type="text" style="margin-left:95px;" name="staffID" id="staffID" required>
        <br>

        <label for="sectionName" style=" font-family:'sitara',sans-serif; font-weight:bold;margin-left:60px;">Section Name </label>
        <input class="txt-input" type="text" style="margin-left:45px;" name="sectionName" id="sectionName" required>
        <br>

        <label for="sectionUserName" style=" font-family:'sitara',sans-serif; font-weight:bold;margin-left:60px;">Name </label>
        <input class="txt-input" type="text" style="margin-left:107px;" name="sectionUserName" id="sectionUserName" required>
        <br>

        <label for="mail" style=" font-family:'sitara',sans-serif; font-weight:bold;margin-left:60px;">Email </label>
        <input class="txt-input" type="text" oninput="validateEmail(this)" style="margin-left:110px;" name="email" id="mail" required>
        <br>

        <label for="faculty" style=" font-family:'sitara',sans-serif; font-weight:bold;margin-left:60px;">Faculty </label>
        <input class="txt-input" type="text" style="margin-left:97px;" name="faculty" id="faculty" required>
        <br>

        <label for="password" style=" font-family:'sitara',sans-serif; font-weight:bold;margin-left:60px;"> Password </label>
        <input class="txt-input" type="password" style="margin-left:79px;" id="psw1" oninput="verifyPassword(this)" id="password" name="psw" required>
        <br>

        <label for="reEnterPassword" style=" font-family:'sitara',sans-serif; font-weight:bold;margin-left:60px;">Password re-type </label>
        <input class="txt-input" type="password" style="margin-left:22px;" id="psw2" oninput="verifyPassword(this)" id="reEnterPassword" name="rpsw" required>
        <br>

        <br><br>
        <input type="submit" value="Add Section" name="submit" class="btt type1" style="align-items:center; margin-left: 40%;" href="signIn.php">
        
        

        <?php


        $conn = openCon();
        
        if (isset($_POST['submit'])) {

            $staffId = $_POST['staffID'];
            $sectionName = $_POST['sectionName'];
            $userName = $_POST['sectionUserName'];
            $eMail = $_POST['email'];
            $faculty = $_POST['faculty'];
            $nPassword = $_POST['psw'];

            $hashPass = password_hash($nPassword, PASSWORD_DEFAULT);

            $sqlquery = "SELECT email FROM users WHERE email= '$eMail'";

            $resultQuery = $conn->query($sqlquery);

            if ($resultQuery->num_rows != 0) {
                echo <<<HTML
                        <div class='alert' style= 'width:40%; margin-left:10px; position:absolute; top: 20%;'>
                        <span class='closebtn'>&times;</span>
                        <strong style= 'text-align:center;font-size: 30x;'>$Error</strong> 
                        </div> "
                        HTML;
            } else {
                $query = "INSERT INTO users(isverified, email, firstName, lastName, faculty, password, role, stdid)
                         values( '0', '$eMail', '$sectionName', '$userName', '$faculty','$hashPass', 'Staff','$staffId')";

                $result = $conn->query($query);

                if ($result === TRUE) {

                      $verification_token = base64_encode($hashPass);
                      $link = "http://localhost/SORIS-help-desk/res/others/verification.php?verification=$verification_token&email=$eMail&forgot=0";
                      $verify_mail= send_Verify_Email($eMail,$link);
                    ///  Link format //////////////////

                    // http://localhost/SORIS-help-desk/res/others/verification.php?verification=< verification token >&email=< email >

                    // How to Create verification Token
                    // Retive password hash from database according to given email
                    // Then encode it as Base64 string, Like this,
                    // $verification_token = base64_encode($password_hash)
                    // Now you can create URL like above i mentioned

                    //$verification_token = base64_encode($password_hash)
                    //send_Verify_Email("shavidilunika10s@gmail.com","https://testetst.com");
                    //send_Forgot_password("shavidilunika10s@gmail.com","https://testetst.com");

                    echo <<< HTML
                            <div class='alert success' style= 'width:40%; margin-left:10px; position:absolute; top: 20%;'>
                            <span class='closebtn'>&times;</span>
                            <strong style= 'text-align:center;font-size: 30x;'>Please visit your E-mail! Click on verify link</strong> 
                            </div> 
                          HTML;

                } else if ($result === FALSE) {
                    echo <<< HTML
                            <div class='alert' style= 'width:40%; margin-left:10px; position:absolute; top: 20%;'>
                            <span class='closebtn'>&times;</span>
                            <strong style= 'text-align:center;font-size: 30x;'>Please register again!</strong> 
                            </div> 
                         HTML;
                }
            }
        }

        ?>
    </div>
</form>

</div>



<script>
function validateEmail(param) {
    var pattern = /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/;
    var input = param.value;

    if (input.match(pattern)) {
        param.style.border = "3px solid #1d4354"
        return true;
    } else {
        param.style.border = "3px solid #ff0000";
        return false;
    }
}

function verifyPassword(newPassword) {
    var input = newPassword.value;
    var upperCase = /[A-Z]/;
    var lowerCase = /[a-z]/;
    var number = /[0-9]/;
    var symbol = /[@#$%^&*]/;
    var len = input.length;

    if ((input.match(upperCase)) && (input.match(lowerCase)) && (input.match(number)) && (len >= 4) && (len <= 10) && (input.match(symbol))) {
        newPassword.style.border = "3px solid #1d4354";
    } else {
        newPassword.style.border = "3px solid #ff0000";
        return false;
    }
}

function confirmPassword(rePassword) {
    var enterPassword = document.getElementById(psw1);
    var reTypePassword = document.getElementById(psw2);

    if (reTypePassword === enterPassword) {
        rePassword.style.border = "3px solid #1d4354";
    } else {
        rePassword.style.border = "3px solid #ff0000";
    }
}
</script>






    <?php
    include("../templates/footer.php");
    ?>

    <script src="../../js/script.js"></script>

</body>

</html>