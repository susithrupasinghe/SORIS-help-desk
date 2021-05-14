<!DOCTYPE html>
<html lang="en">
<<<<<<< HEAD
=======

>>>>>>> 9e0264874a3b59432c87b5dc32346d321fc18ebb
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>Verification</title>
    <link rel="stylesheet" href="../../css/style.css">

<link href="http://fonts.cdnfonts.com/css/sitara" rel="stylesheet">
</head>
<body>
<?php

     $page = "Verification";
    require '../../config/config.php';
    include("../templates/header.php");
    include("../templates/navigation.php");
?>
<div class="body-container">











</div>

<?php include("../templates/footer.php");  ?>
<script src="js/script.js"></script>

</body>
=======
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
            } else {
                //header("Location: ../../index.php");
            }
        }

        closeCon($con);


        ?>
        <div class="alert">
            <span class="closebtn">&times;</span>
            <strong>Danger!</strong> Indicates a dangerous or potentially negative action.
        </div>

        <div class="alert success">
            <span class="closebtn">&times;</span>
            <strong>Success!</strong> Indicates a successful or positive action.
        </div>

        <div class="alert info">
            <span class="closebtn">&times;</span>
            <strong>Info!</strong> Indicates a neutral informative change or action.
        </div>

        <div class="alert warning">
            <span class="closebtn">&times;</span>
            <strong>Warning!</strong> Indicates a warning that might need attention.
        </div>
    </div>


    <?php include("../templates/footer.php");  ?>
    <script src="../../js/script.js"></script>
</body>

>>>>>>> 9e0264874a3b59432c87b5dc32346d321fc18ebb
</html>