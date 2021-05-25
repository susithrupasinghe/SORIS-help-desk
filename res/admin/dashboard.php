<?php
session_start();
if (isset($_SESSION['userid']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] != 'administrator') {
        header("Location: ../../index.php");
    }
} else {
    header("Location: ../../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SORIC adminDashboard</title>

    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/signup.css">

    <link rel="icon" href="../../images/favicon.svg" sizes="any" type="image/svg+xml">
    <link href="http://fonts.cdnfonts.com/css/sitara" rel="stylesheet">
    <style>
        .table-style th {
            text-align: center;
        }

        .table-style td {
            text-align: center;
        }
    </style>
</head>

<body>

    <?php
    $page = "adminDashboard";
    require '../../config/config.php';
    require '../mail/mailer.php';
    include("../templates/header.php");
    include("../templates/navigation.php");
    ?>

    <div class="body-container">

        <h3 class="txt-green" style="margin-left:80px;font-size:25px;">Statictics </h3><br>

        <table class="table-style" style="width:70%; margin-left:auto; margin-right:auto;">
            <tr>
                <th>Section Name</th>
                <th>Active Inquiries</th>
                <th>Close Inquiries</th>
            </tr>

            <?php
            $conn = openCon();
            $sqlquery = "SELECT DISTINCT id , firstName , lastName  FROM users WHERE role='staff';";
            $result = $conn->query($sqlquery);
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $stID = $row['id'];

                $sqlQuery1 = "SELECT count(isActive) As 'Active' from inquiry where isActive = '1' AND currentStaffId = '$stID';";
                $result1 = $conn->query($sqlQuery1);
                $row1 = $result1->fetch_assoc();

                $sqlQuery2 = "SELECT count(isActive) As 'Close' from inquiry where isActive = '0' AND currentStaffId = '$stID';";
                $result2 = $conn->query($sqlQuery2);
                $row2 = $result2->fetch_assoc();

                $name = $row['firstName'] . "-" . $row['lastName'];
                $active = $row1['Active'];
                $close = $row2['Close'];
                echo <<< HTML
                        <tr>
                            <td>$name</td>
                            <td>$active</td>
                            <td>$close</td>
                        </tr>

                        HTML;
                $i++;
            }
            closeCon($conn);
            ?>
        </table>

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
                <input type="submit" value="Add Section" name="submit" class="btt type1" style="align-items:center; margin-left:35%; padding:10px 70px;" href="signIn.php">

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
                            $verify_mail = send_Verify_Email($eMail, $link);

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
                return true;
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
                return true;
            } else {
                rePassword.style.border = "3px solid #ff0000";
                return false;
            }
        }
    </script>

    <?php include("../templates/footer.php"); ?>
    <script src="../../js/script.js"></script>

</body>

</html>