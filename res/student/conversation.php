<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../../css/style.css">

    <link href="http://fonts.cdnfonts.com/css/sitara" rel="stylesheet">

    <style>
    
    td {text-align: center; padding-left: 70px; padding-right: 70px; padding-bottom: 16px;padding-top:10px;}
    </style>
</head>
<body>

<?php



$page = "conversation";
require '../../config/config.php';
include("../templates/header.php");
include("../templates/navigation.php");



?>

<div class="body-container">

<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
   
    if(isset($_GET['id'])){

        $inquiryId = $_GET["id"];

        $con = openCon();
        $sql = "SELECT U.email from users U, inquiry I WHERE I.id = '$inquiryId' AND I.conversationStarter = U.id";

        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            
            $row = mysqli_fetch_row($result);

            if($row[0] == $_SESSION["userid"]){

                echo <<<HTML

                <h2 class="txt-green" style="margin-left:20vw;">Inquiry Details</h2>
                <div class="card" style="margin-left:20vw;">

                <table>
                <tr>
                <td><h5 style="display:inline;"> Inquiry ID : </h5><h5 style="display:inline;">  $inquiryId</h5></td>
                <td><h5 style="display:inline;"> Last Modified Date : </h5><h5 style="display:inline;">  $inquiryId</h5></td>
                </tr>
                <tr>
                <td></td>
                <td>
                <h5 style="display:inline;"> Opened Date : </h5><h5 style="display:inline;">  $inquiryId</h5>
                </td>
                </tr>
                <tr>
                <td></td>
                <td>
                <h5 style="display:inline;"> Status :  </h5><h5 style="display:inline;">  $inquiryId</h5>
                </td></tr>
                </table>
                    
                    
               
                    

                </div>



                HTML;



                echo "User Identiied";

                $sql = "SELECT * FROM conversations WHERE inquiryId='$inquiryId'";


            }
            else{

                echo "You dont have permisssion to View this converstation";
            }

        }
    }

}


?>

</div>
    
<?php include("../templates/footer.php");  ?>
    <script src="js/script.js"></script>
</body>
</html>