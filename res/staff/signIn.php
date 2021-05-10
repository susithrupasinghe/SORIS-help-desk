<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/style.css">

    <link href="http://fonts.cdnfonts.com/css/sitara" rel="stylesheet">

</head>

<body>

    <?php


    $page = "student login";
    require '../../config/config.php';
    include("../templates/header.php");
    include("../templates/navigation.php");


    ?>
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
                    header("Location: /SORIS-help-desk/res/staff/dashboard.php");
                } else {
                    echo "<script>alert('Your email or password is incorrect');</script>";
                }
            } else {
            }
        } else if ($user == "administrator") {

            $sqlquery = "SELECT password FROM users WHERE email='" . $email . "' AND role='admin'";
            $result = $con->query($sqlquery);

            print_r($result);

            if ($result->num_rows > 0) {

                $row = $result->fetch_assoc();


                //echo $row["password"];
                if (password_verify($password, $row["password"])) {

                    $_SESSION["userid"] = $email;
                    $_SESSION["role"] = "administrator";
                    header("Location: /SORIS-help-desk/res/admin/dashboard.php");
                } else {
                    echo "<script>alert('Your email or password is incorrect');</script>";
                }
            } else {
            }
        }


        closeCon($con);
    }




    ?>
    <div class="body-container">
        <form method="POST">

            <div class="card" style="margin-left:25vw; margin-right:25vw; padding-left:30px">

                <h1 style="text-align:center;"> Staff/Adminstrator signIn </h1>
                <br>
                Select User<select name="user" class="txt-input" style="margin-left: 18px;">
                    <option value="staff">Staff</option>
                    <option value="administrator">Adminstrator</option>
                </select>
                <br>
                Email <input class="txt-input" type="text" name="email" oninput="validateEmail(this)" style="margin-left:40px;">
                <br>
                Password <input class="txt-input" type="password" name="password" style="margin-left: 18px;">
                <br><br><br>


                <button style="margin-right: 50px;margin-left: 100px;" class="btt type3">Forget password</button>
                <input type="submit" value="Login" class="btt type1" name="Login">

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