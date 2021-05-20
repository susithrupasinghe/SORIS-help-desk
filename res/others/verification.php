<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../../css/style.css">

</head>

<body>

    <?php



    $page = "verification";
    require '../../config/config.php';
    include("../templates/header.php");
    include("../templates/navigation.php");



    ?>
    <div class="body-container">

        <?php

           ///  Link format //////////////////

        // http://localhost/SORIS-help-desk/res/others/verification.php?verification=< verification token >&&email=< email >
        
        // How to Create verification Token
        // Retive password hash from database according to given email
        // Then encode it as Base64 string, Like this,
        // $verification_token = base64_encode($password_hash)
        // Now you can create URL like above i mentioned
        
        //$verification_token = base64_encode($password_hash)
                //send_Verify_Email("shavidilunika10s@gmail.com","https://testetst.com");
                //send_Forgot_password("shavidilunika10s@gmail.com","https://testetst.com");

        $con = openCon();
        if (isset($_GET['verification']) && isset($_GET['email'])) {

            $email = $_GET["email"];
            $token = base64_decode($_GET["verification"]);



            $sql = "SELECT password FROM users WHERE email='$email'";

            $result = $con->query($sql);

            if ($result->num_rows > 0) {

                $row = mysqli_fetch_row($result);

                if ($token != $row[0]) {

                    //header("Location: ../../index.php");
                }

                else{
                    echo <<< HTML
                    <img src="../../images/Verification_success.svg"style="margin-left:200px; " width="750px" alt="Verification image">
                    HTML;
                }
            }else {
                //header("Location: ../../index.php");
            }

    
        }

        closeCon($con);
             
        ?>
     
    
       
       
     </div>   

    <?php include("../templates/footer.php");  ?>
    <script src="../../js/script.js"></script>
</body>

</html>