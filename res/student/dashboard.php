<?php
session_start();

if (isset($_SESSION["userid"]) && isset($_SESSION["role"])) {

    if ($_SESSION["role"] != "student") {

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
    <title>Student Dashboard</title>
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

    <div class="body-container" style="background:linear-gradient(rgba(255,255,255,.9), rgba(255,255,255,.9)), url('../../images/bg14.svg');background-repeat: no-repeat;background-size: 60%;background-position:center;">

        <?php
        $con = openCon();

        $uMail = $_SESSION['userid'];

        $sql = "SELECT id FROM users WHERE email='$uMail'";
        $result = $con->query($sql);

        while ($row = $result->fetch_assoc()) {
            $uid = $row['id'];
        }


        //Count active inquires
        $sqlA = "SELECT COUNT(isActive) AS 'Active' FROM inquiry WHERE conversationStarter = $uid  && isActive = '1'";
        $result1A = $con->query($sqlA);

        while ($row = $result1A->fetch_assoc()) {
            $Active = $row['Active'];
        }




        //Count closed inquires
        $sqlC = "SELECT COUNT(isActive) AS 'Close' FROM inquiry WHERE  conversationStarter= $uid  && isActive = '0'";
        $resultC = $con->query($sqlC);

        while ($row = $resultC->fetch_assoc()) {
            $close = $row['Close'];
        }


        //add create inquiry button,active inquiry,closed inquiry
        echo <<< HTML
        <div style="text-align:right;margin-right:10%;">
        <h3 style="font-family:Sitara;color:#1D4354;">Active inquiry count : $Active</h3>
        <h3 style="font-family:Sitara;color:#1D4354;">Closed inquiry count : $close</h3>
         <a href="addinquiry.php" target="blank"> 
             <div style="font-family:Sitara;margin-right:0px;" class="btt type1" >Create Inquiry</div>
            </a>
        </div>
        HTML;




        //active
        echo <<< HTML
                <h2 style="font-family:Sitara;margin-left:10%;color:#08A73A;">Active Inquiry</h2>
            
                <table class="table-style" style="max-width: 80%;margin:auto;">
                <tr>
                    <th>Inquiry ID</th>
                    <th>Title</th>
                    <th>Section</th>
                    <th>Staff ID</th>
                    <th>Last Modified Date</th>
                    <th>Submited Date</th>
                    <th>More Details</th>
                </tr>
                HTML;



        $sql = "SELECT i.id,i.title,i.createdDate,i.lastModifiedDate,i.currentStaffId,u.firstName,u.lastName FROM inquiry i,users u WHERE conversationStarter='$uid' && isActive = '1' && i.currentStaffId = u.id";

        $result = $con->query($sql);

        if ($result == TRUE) {
            while ($rows = $result->fetch_assoc()) {

                $id = $rows['id'];
                $title = $rows['title'];
                $SubmitedDate = $rows['createdDate'];
                $LastModifiedDate = $rows['lastModifiedDate'];
                $StaffID = $rows['currentStaffId'];
                $link = "conversation.php?id=$id ";
                $Faculty = $rows['firstName'] . " " . $rows['lastName'];



                echo <<< HTML
                        <tr>  
                        <td>$id</td>
                        <td>$title</td>
                        <td>$Faculty</td>
                        <td>$StaffID</td>
                        <td>$SubmitedDate</td>
                        <td>$LastModifiedDate</td>
                        <td> <a href="$link" target = "_blank">See more</a></td>
                        </tr>
                    HTML;
            }
            echo <<< HTML
                    </table>
                    <br><br><br>
                    HTML;
        }

        //archived
        echo <<< HTML
            <h2 style="font-family:Sitara;margin-left:10%;color:#08A73A;">Archived Inquiry</h2>
        
            <table class="table-style" style="max-width: 80%;margin:auto;">
            <tr>
                <th>Inquiry ID</th>
                <th>Title</th>
                <th>Section</th>
                <th>Staff ID</th>
                <th>Last Modified Date</th>
                <th>Submited Date</th>
                <th>More Details</th>
            </tr>
            HTML;



        $sql = "SELECT i.id,i.title,i.createdDate,i.lastModifiedDate,i.currentStaffId,u.firstName,u.lastName FROM inquiry i,users u WHERE conversationStarter='$uid' && isActive = '0' && i.currentStaffId = u.id";

        $result = $con->query($sql);

        if ($result == TRUE) {
            while ($rows = $result->fetch_assoc()) {

                $id = $rows['id'];
                $title = $rows['title'];
                $SubmitedDate = $rows['createdDate'];
                $LastModifiedDate = $rows['lastModifiedDate'];
                $StaffID = $rows['currentStaffId'];
                $link = "conversation.php?id=$id ";
                $Faculty = $rows['firstName'] . " " . $rows['lastName'];



                echo <<< HTML
                    <tr>  
                    <td>$id</td>
                    <td>$title</td>
                    <td>$Faculty</td>
                    <td>$StaffID</td>
                    <td>$SubmitedDate</td>
                    <td>$LastModifiedDate</td>
                    <td> <a href="$link" target = "_blank">See more</a></td>
                    </tr>
                HTML;
            }
            echo <<< HTML
                </table>
                <br><br><br>
                HTML;
        }



        closeCon($con);
        ?>

        </table>
    </div>

    <?php include("../../res/templates/footer.php");  ?>
    <script src="../../js/script.js"></script>

</body>

</html>