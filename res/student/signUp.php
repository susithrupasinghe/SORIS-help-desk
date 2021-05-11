<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SORIS SignUp</title>

    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/signup.css">


    <link href="http://fonts.cdnfonts.com/css/sitara" rel="stylesheet">

</head>

<body>
    <?php
    $page = "student signup";
    require '../../config/config.php';
    include("../templates/header.php");
    include("../templates/navigation.php");
    ?>



    <div class="body-container">

        <form method="post" style="margin-left:25%;">
            <div class="card" id="card" style="width:63%;">
                <h1 style="text-align:center; font-style:bold; font-family:'sitara',sans-serif;"> Student SignUp </h1>
                <br>

                <label for="SID" style=" font-family:'sitara',sans-serif; font-weight:bold;margin-left:60px;">Student ID </label>
                <input class="txt-input" type="text" style="margin-left:65px;" name="sid" required>
                <br> <br>

                <label for="fName" style=" font-family:'sitara',sans-serif; font-weight:bold; margin-left:60px;">First Name </label>
                <input class="txt-input" type="text" style="margin-left:62px;" name="fname" required>
                <br> <br>

                <label for="lName" style=" font-family:'sitara',sans-serif; font-weight:bold;margin-left:60px;">Last Name </label>
                <input class="txt-input" type="text" style="margin-left:63px;" name="lname" required>
                <br> <br>

                <label for="mail" style=" font-family:'sitara',sans-serif; font-weight:bold;margin-left:60px;">Email </label>
                <input class="txt-input" type="text" oninput="validateEmail(this)" style="margin-left:103px;" name="email" required>
                <br> <br>

                <label for="faculty" style=" font-family:'sitara',sans-serif; font-weight:bold;margin-left:60px;">Faculty </label>
                <select class="txt-input" size="1" style="margin-left:90px; width:347px;" name="faculty" required>
                    <option value="none"> </option>
                    <option value="FOM"> Faculty Of Medicine </option>
                    <option value="FOE"> Faculty Of Engineering </option>
                    <option value="FOC"> Faculty Of Computing </option>
                    <option value="FOM"> Faculty Of Management </option>
                    <option value="FOl"> Faculty Of Language </option>
                    <option value="FOA"> Faculty Of Art </option>
                </select>
                <br> <br>

                <label for="password" style=" font-family:'sitara',sans-serif; font-weight:bold;margin-left:60px;"> Password </label>
                <input class="txt-input" type="password" style="margin-left:72px;" id="psw1" oninput="verifyPassword(this)" name="psw" required>
                <br> <br>

                <label for="reEnterPassword" style=" font-family:'sitara',sans-serif; font-weight:bold;margin-left:60px;">Password re-type </label>
                <input class="txt-input" type="password" style="margin-left:15px;" id="psw2" oninput="verifyPassword(this)" name="rpsw" required>
                <br> <br>


                <input type="submit" value="SignUp Now" name="submit" class="btt type1" style="align-items:center; margin-left: 40%;" href="signIn.php">
                <br> <br>

                <a href="signIn.php" style="text-align:center;  margin-left: 30%;"> Already user? Click here to SignIn </a>

                <?php


                $conn = openCon();
                $Error = 'You are already redistered! Visit SignIn page.';
                if (isset($_POST['submit'])) {
                    
                    $sid = $_POST['sid'];
                    $fName = $_POST['fname'];
                    $lName = $_POST['lname'];
                    $eMail = $_POST['email'];
                    $faculty = $_POST['faculty'];
                    $nPassword = $_POST['psw'];

                    $hashPass = password_hash($nPassword, PASSWORD_DEFAULT);

                    $sqlquery = "SELECT email FROM users WHERE email= '$eMail'";

                    $resultQuery = $conn->query($sqlquery);

                    if ($resultQuery->num_rows != 0) {
                       echo "<script>
                                 alert('$Error') 
                            </script>";

                       
                    } else {
                        $query = "INSERT INTO users(id,isverified, email, firstName, lastName, faculty, password, role, stdid)
                                 values('', '0', '$eMail', '$fName', '$lName', '$faculty','$hashPass', 'Student','$sid')";

                        $result = $conn->query($query);

                        if ($result === TRUE) {
                            echo "<p style= 'font-family:sans-serif; font-weight:bold; text-align:center; color:#1D4354;'> Please visit your E-mail! 
                                    <br> Click on verify link </p>";
                        } else if ($result === FALSE) {
                            echo "<p style= 'font-family:sans-serif; font-weight:bold;text-align:center;'> Please register again!";
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






    <?php include("../templates/footer.php");  ?>
    <script src="../../js/script.js"></script>

</body>

</html>