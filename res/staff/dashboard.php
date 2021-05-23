<?php
session_start();

if (isset($_SESSION["userid"]) && isset($_SESSION["role"])) {

    if ($_SESSION["role"] == "student") {

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
    <title>SORIS Help Desk</title>
    <link rel="stylesheet" href="../../css/style.css">

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

$page = "dashboard";
require '../../config/config.php';
include("../../res/templates/header.php");
include("../../res/templates/navigation.php");


?>

 <div class="body-container">

    <?php
        //require '../../config/config.php';
        $con=openCon();

            $uMail=$_SESSION['userid'];
        
            $sql1 = "SELECT id FROM users WHERE email='$uMail'";
            $result1= $con->query($sql1);

            while ($row = $result1->fetch_assoc())
            { 
                $uid = $row['id'];
            }

            $sqlA = "SELECT COUNT(isActive) AS 'Active' FROM inquiry WHERE currentStaffId = $uid  && isActive = '1'";
            $result1A= $con->query($sqlA);

            while ($row = $result1A->fetch_assoc())
            {
                $Active = $row['Active'];
            }
            
            echo <<< HTML
            <h3 style="font-family:Sitara;margin-left:10px;color:#1D4354;Active inquiry count : style=font-family:Sitara;margin-left:10px;color:#1D4354;">$Active</h3>
            HTML;

            //=================
            $sqlC = "SELECT COUNT(isActive) AS 'Active' FROM inquiry WHERE currentStaffId = $uid  && isActive = '0'";
            $result1C= $con->query($sqlC);

            while ($row = $result1C->fetch_assoc())
            {
                $close = $row['Active'];
            }
            
            echo <<< HTML
            <h3 style="font-family:Sitara;margin-left:10px;color:#1D4354;Close inquiry count : style=font-family:Sitara;margin-left:10px;color:#1D4354;">$close</h3>
            HTML;


            //active
           echo <<< HTML
            <h2 style="font-family:Sitara;margin-left:10px;color:#08A73A;">Active Inquery</h2>
            <br>

            <table class="table-style" style="max-width: 80%;margin:auto;">
            <tr>
                <th>Inquiry ID</th>
                <th>Title</th>
                <th>Faculty</th>
                <th>Student ID</th>
                <th>Section</th>
                <th>Last Modified Date</th>
                <th>Submited Date</th>
                <th>Details</th>
            </tr>
            HTML;

            $sql1 = "SELECT id,title,createdDate,lastModifiedDate,conversationStarter FROM inquiry WHERE currentStaffId='$uid' && isActive = '1'";
            $result1= $con->query($sql1);

            while ($rows = $result1->fetch_assoc()) 
            {
                $idA = $rows['id']; 
                $titleA = $rows['title'];
                $SubmitedDateA = $rows['createdDate'];
                $LastModifiedDateA = $rows['lastModifiedDate'];
                $StudentIDA = $rows['conversationStarter'];

                $sql2 = "SELECT faculty FROM users WHERE id = '$StudentIDA'";
                $result2= $con->query($sql2);

                while ($rows = $result2->fetch_assoc())
                {
                    $FacultyA = $rows['faculty'];
                }

                echo <<< HTML
                <tr>
                <td>$idA</td>
                <td>$titleA</td>
                <td>$$SubmitedDateA</td>
                <td>$LastModifiedDateA</td>
                <td>$StudentIDA</td>
                <td>$FacultyA</td>
                </tr>
                <br><br>
                HTML;
                
            }

            //cldjksol===================
            echo <<< HTML
            <!--<h2 style="font-family:Sitara;margin-left:10px;color:#08A73A;">Close Inquery</h2>-->
            <br>

            <table class="table-style" style="max-width: 80%;margin:auto;">
            <tr>
                <th>Inquiry ID</th>
                <th>Title</th>
                <th>Faculty</th>
                <th>Student ID</th>
                <th>Section</th>
                <th>Last Modified Date</th>
                <th>Submited Date</th>
                <th>Details</th>
            </tr>
            HTML;

            $sql3= "SELECT id,title,createdDate,lastModifiedDate,conversationStarter FROM inquiry WHERE currentStaffId='$uid' && isActive = '0'";
            $result3= $con->query($sql3);

            while ($rows = $result3->fetch_assoc()) 
            {
                $idC = $rows['id']; 
                $titleC = $rows['title'];
                $SubmitedDateC = $rows['createdDate'];
                $LastModifiedDateC = $rows['lastModifiedDate'];
                $StudentIDC = $rows['conversationStarter'];

                $sql4 = "SELECT faculty FROM users WHERE id = '$StudentIDC'";
                $result4 = $con->query($sql4);

                while ($rows = $result4->fetch_assoc())
                {
                    $FacultyC = $rows['faculty'];
                }

                echo <<< HTML
                <tr>
                <td>$idC</td>
                <td>$titleC</td>
                <td>$SubmitedDateC</td>
                <td>$LastModifiedDateC</td>
                <td>$StudentIDC</td>
                <td>$FacultyC</td>
                </tr>
                HTML;
                
            }

            
    
    
    ?>

</table>
 </div>

<?php include("../../res/templates/footer.php");  ?>
    <script src="../../js/script.js"></script>
    
</body>
</html>