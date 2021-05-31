<?php
session_start();

if (isset($_SESSION["userid"]) && isset($_SESSION["role"])) {

    if ($_SESSION["role"] == "staff") {

        //header("Location: ../../index.php");
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
    <title>Staff Dashboard</title>
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

        .table-style td a {
            text-decoration: none;
            color: #08A73A;
            font-weight: bold;
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

    <div class="body-container" style="background:linear-gradient(rgba(255,255,255,.8), rgba(255,255,255,.8)), url('../../images/bg14.svg');background-repeat: no-repeat;background-size: 120%;background-position:center;">

        <?php
        $con = openCon();

        $uMail = $_SESSION['userid'];

        $sql = "SELECT id FROM users WHERE email='$uMail'";
        $result = $con->query($sql);

        while ($row = $result->fetch_assoc()) {
            $uid = $row['id'];
        }


        //Count active inquires
        $sql = "SELECT COUNT(isActive) AS 'Active' FROM inquiry WHERE currentStaffId = $uid  && isActive = '1'";
        $result = $con->query($sql);

        while ($row = $result->fetch_assoc()) {
            $Active = $row['Active'];
        }

        echo <<< HTML
                <h3 style="font-family:Sitara, sans-serif;margin-left:70.5%;color:#1D4354;">Active inquiry count : $Active</h3>
                HTML;


        //Count closed inquires
        $sql = "SELECT COUNT(isActive) AS 'Close' FROM inquiry WHERE currentStaffId = $uid  && isActive = '0'";
        $result = $con->query($sql);

        while ($row = $result->fetch_assoc()) {
            $close = $row['Close'];
        }

        echo <<< HTML
                <h3 style="font-family:Sitara, sans-serif;margin-left:70.5%;color:#1D4354;">Closed inquiry count : $close</h3>
                HTML;


        //active
        echo <<< HTML
                <h2 style="font-family:Sitara, sans-serif;margin-left:10%;color:#08A73A;">Active Inquiry</h2>
            
                <table class="table-style" style="max-width: 80%;margin:auto;background-color:#FFF;">
                <tr>
                    <th>Inquiry ID</th>
                    <th>Title</th>
                    <th>Faculty</th>
                    <th>Student ID</th>
                    <th>Last Modified Date</th>
                    <th>Submited Date</th>
                    <th>More Details</th>
                </tr>
                HTML;

                
        //Select active inquiries
        $sql = "SELECT id,title,createdDate,lastModifiedDate,conversationStarter FROM inquiry WHERE currentStaffId='$uid' && isActive = '1'";
        $result = $con->query($sql);

        if ($result == TRUE) {
            while ($rows = $result->fetch_assoc()) {
                $idA = $rows['id'];
                $titleA = $rows['title'];
                $SubmitedDateA = $rows['createdDate'];
                $LastModifiedDateA = $rows['lastModifiedDate'];
                $StudentIDA = $rows['conversationStarter'];
                $linkA = "conversation.php?id=$idA ";

                $sql2 = "SELECT faculty FROM users WHERE id = '$StudentIDA'";
                $result2 = $con->query($sql2);

                while ($rows = $result2->fetch_assoc()) {
                    $FacultyA = $rows['faculty'];
                }

                echo <<< HTML
                        <tr>  
                        <td>$idA</td>
                        <td>$titleA</td>
                        <td>$FacultyA</td>
                        <td>$StudentIDA</td>
                        <td>$SubmitedDateA</td>
                        <td>$LastModifiedDateA</td>
                        <td> <a href="$linkA" target = "_blank">View More</a></td>
                        </tr>
                    HTML;
            }
            echo <<< HTML
                    </table>
                    <br><br><br>
                    HTML;
        }


        //Archived Inquery
        echo <<< HTML
            <h2 style="font-family:Sitara, sans-serif;margin-left:10%;color:#08A73A;">Closed Inquiry</h2>

            <table class="table-style" style="max-width: 80%;margin:auto;background-color:#FFF;">
            <tr>
                <th>Inquiry ID</th>
                <th>Title</th>
                <th>Faculty</th>
                <th>Student ID</th>
                <th>Last Modified Date</th>
                <th>Submited Date</th>
                <th>More Details</th>
            </tr>
            HTML;


        //Select Archived Inquery
        $sql = "SELECT id,title,createdDate,lastModifiedDate,conversationStarter FROM inquiry WHERE currentStaffId='$uid' && isActive = '0'";
        $result = $con->query($sql);

        if ($result == TRUE) {
            while ($rows = $result->fetch_assoc()) {
                $idC = $rows['id'];
                $titleC = $rows['title'];
                $SubmitedDateC = $rows['createdDate'];
                $LastModifiedDateC = $rows['lastModifiedDate'];
                $StudentIDC = $rows['conversationStarter'];
                $linkC = "conversation.php?id=$idC";

                $sql4 = "SELECT faculty FROM users WHERE id = '$StudentIDC'";
                $result4 = $con->query($sql4);

                while ($rows = $result4->fetch_assoc()) {
                    $FacultyC = $rows['faculty'];
                }

                echo <<< HTML
                <tr>
                <td>$idC</td>
                <td>$titleC</td>
                <td>$FacultyC</td>
                <td>$StudentIDC</td>
                <td>$SubmitedDateC</td>
                <td>$LastModifiedDateC</td>
                <td> <a href="$linkC" target = "_blank">View more</a></td>
                </tr>
                HTML;
            }
            echo <<< HTML
                </table>
                <br><br>
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