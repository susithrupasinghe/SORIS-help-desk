<?php
    session_start();
    if(isset($_SESSION['userid']) && isset($_SESSION['role']))
    {    
            header("Location: ../../index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SORIS SignUp</title>

    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/signup.css">
    <link rel="icon" href="../../images/favicon.svg" sizes="any" type="image/svg+xml">
    <link href="http://fonts.cdnfonts.com/css/sitara" rel="stylesheet">
</head>

<body>
    <?php
    $page = "student signup";
    require '../../config/config.php';
    require '../mail/mailer.php';
    include("../templates/header.php");
    include("../templates/navigation.php");
    ?>

    <div class="body-container">

        <form method="post">
            <div class="card" id="card" style="min-width:50%;margin-left:auto;margin-right:auto;border:3px solid #08A73A;">
                <h1 style="text-align:center; font-style:bold; font-family:'sitara',sans-serif;"> Student SignUp </h1>
                <br>

                <label for="SID" style=" font-family:'sitara',sans-serif; font-weight:bold;margin-left:60px;">Student ID </label>
                <input class="txt-input" type="text" style="margin-left:65px;" name="sid" id="SID" required>
                <br>

                <label for="fName" style=" font-family:'sitara',sans-serif; font-weight:bold; margin-left:60px;">First Name </label>
                <input class="txt-input" type="text" style="margin-left:62px;" name="fname" id="fName" required>
                <br>

                <label for="lName" style=" font-family:'sitara',sans-serif; font-weight:bold;margin-left:60px;">Last Name </label>
                <input class="txt-input" type="text" style="margin-left:63px;" name="lname" id="lName" required>
                <br>

                <label for="mail" style=" font-family:'sitara',sans-serif; font-weight:bold;margin-left:60px;">Email </label>
                <input class="txt-input" type="text" oninput="validateEmail(this)" style="margin-left:103px;" name="email" id="mail" required>
                <br>

                <label for="faculty" style=" font-family:'sitara',sans-serif; font-weight:bold;margin-left:60px;">Faculty </label>
                <select class="txt-input" size="1" style="margin-left:90px; width:347px;" name="faculty" id="faculty" required>

                    <?php
                    $con = openCon();

                    $sql_query = "SELECT DISTINCT faculty FROM users WHERE role= 'admin' OR role= 'staff'";
                    $result = $con->query($sql_query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $faculty = $row['faculty'];
                            echo "<option> $faculty </option>";
                        }
                    }                  
                    ?>
                </select>
                <br>

                <label for="password" style=" font-family:'sitara',sans-serif; font-weight:bold;margin-left:60px;"> Password </label>
                <input class="txt-input" type="password" style="margin-left:72px;" id="psw1" oninput="verifyPassword(this)" id="password" name="psw" required>
                <br>

                <label for="reEnterPassword" style=" font-family:'sitara',sans-serif; font-weight:bold;margin-left:60px;">Password re-type </label>
                <input class="txt-input" type="password" style="margin-left:15px;" id="psw2" oninput="verifyPassword(this)" id="reEnterPassword" name="rpsw" required>
                <br><br><br>
                
                <input type="submit" value="SignUp Now" name="submit" class="btt type1" style="align-items:center; margin-left: 40%;" href="signIn.php">
                <br><br>
                
                <a href="signIn.php" style="text-align:center;  margin-left: 30%;"> Already user? Click here to SignIn </a>

                <?php
                $conn = openCon();
                $Error = "You are already redistered! Visit SignIn page.";

                if (isset($_POST['submit'])) {

                    $sid = $_POST['sid'];
                    $fName = $_POST['fname'];
                    $lName = $_POST['lname'];
                    $eMail = $_POST['email'];
                    $faculty = $_POST['faculty'];
                    $nPassword = $_POST['psw'];
                    $rePassword = $_POST['psw2'];
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
                                 values( '0', '$eMail', '$fName', '$lName', '$faculty','$hashPass', 'Student','$sid')";
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
                            echo <<<HTML
                                    <div class='alert' style= 'width:40%; margin-left:10px; position:absolute; top: 20%;'>
                                    <span class='closebtn'>&times;</span>
                                    <strong style= 'text-align:center;font-size: 30x;'>Please register again!</strong> 
                                    </div> 
                                 HTML;
                        }
                    }
                }
                closeCon($conn);
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


            if ((reTypePassword === enterPassword) && (len1 == len2)) {
                rePassword.style.border = "3px solid #1d4354";
            } else {
                rePassword.style.border = "3px solid #ff0000";
            }
        }
    </script>

    <?php include("../templates/footer.php");  ?>
    <script src="../../js/script.js"></script>

</body>

</html>