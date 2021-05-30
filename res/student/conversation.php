<?php
session_start();

if (isset($_SESSION["userid"]) && isset($_SESSION["role"])) {

    if ($_SESSION["role"] != "student") {

        header("Location: ../../index.php");
    }
} else {
    header("Location: ../../index.php");
}

require '../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if(isset($_POST["closeinq"])){
        $con = openCon();
        $inquiryId = $_GET["id"];
        // $sql = "DELETE t1,t2 from inquiry as t1 INNER JOIN conversations as t2 on t1.id = t2.inquiryId WHERE t1.id='$inquiryId'";
        $sql = "UPDATE inquiry SET isActive = '0' WHERE id='$inquiryId'";

        $result = $con->query($sql);

        if($result===TRUE){
            header("Location: dashboard.php");
        }
        else{
            header("Refresh:0");
        }




    }

    if (isset($_POST['newmsg'])) {

        $text = $_POST['text'];
        $attachment = "";
        $inquiryId = $_GET["id"];
        $uid = "";

        $con = openCon();
        $sql = "SELECT U.id from users U, inquiry I WHERE I.id = '$inquiryId' AND I.conversationStarter = U.id";

        $result = $con->query($sql);


        if ($result->num_rows > 0) {

            $row = mysqli_fetch_row($result);
            $uid = $row[0];
            $datetime = date("Y-m-d h:i:s");

            $filename = $_FILES['attachment']['name'];

            if($filename != ""){

                
                $destination = '../uploads/' . $filename;

                $file = $_FILES['attachment']['tmp_name'];



                if (move_uploaded_file($file, $destination)) {

                    $attachment = $filename;
                   
                } else {
                    echo "Failed to upload file.";
                }
            }

            $sql = "INSERT INTO conversations (inquiryId,userId,createdDate,attachment,text) VALUES('$inquiryId','$uid','$datetime','$attachment','$text')";
            $result = $con->query($sql);

            if($result === TRUE){

                $sql = "UPDATE inquiry SET lastModifiedDate='$datetime' WHERE id='$inquiryId'";
                $result = $con->query($sql);

                header("Refresh:0");
            }
            else{

                echo "Error .";

            }

        }


        

    }


}



function message($name, $date, $text, $attachment, $role)
{
    //$name,$date,$text,$attachment,$role

    if ($role == "student") {

        echo <<< HTML
        <div style="margin-left:100px;margin-right:100px;">
        <!-- <div class="card"> -->
        <table>
        <tr>
        <td rowspan="2"><img src="../../images/student.png" alt="" style="max-width:65px;border-radius:50%;border:2px solid #1D4354;"></td>
        <td> <h3 class ="txt-green" style="display:inline;margin-top:-40px;padding-left:15px;">$name</h3></td>
        </tr>
        <tr>
        <td><h5 style="display:inline;margin-top:-40px;padding-left:15px;color:#1D4354;">$date</h5></td>
        </tr>
        </table>
        <div id="text" style="padding-left:100px;">
        <p style="font-weight:900;color:#1D4354;"> $text</p>

        HTML;


        if ($attachment != "") {

            $attachment = "../uploads/".$attachment;

            echo <<< HTML

            <a href="$attachment" target="_blank" style="text-decoration: none"> 
            <img width=25 src="../../images/attachment.svg"> <h5 style="display:inline;">Download attachment</h5>
            </a>
            HTML;
        }

        echo <<<HTML

        <hr style="border-top: 3px solid #1D4354; color:#1D4354">

        </div>
        


        <!-- </div> -->
        </div>

    HTML;
    } else {
        echo <<< HTML
        <div style="margin-left:100px;margin-right:100px;">
        <!-- <div class="card" style="min-width:80%;"> -->
        <table>
        <tr>
        <td rowspan="2"><img src="../../images/staff.png" alt="" style="max-width:65px;border-radius:50%;border:2px solid #1D4354;"></td>
        <td> <h3  class ="txt-green" style="display:inline;margin-top:-40px;padding-left:15px;">$name</h3></td>
        </tr>
        <tr>
        <td><h5 style="display:inline;margin-top:-40px;padding-left:15px;color:#1D4354;">$date</h5></td>
        </tr>
        </table>
        <div id="text" style="padding-left:100px;">
        <p style="font-weight:900;color:#1D4354;"> $text</p>

        HTML;

        if ($attachment != "") {

            $attachment = "../uploads/".$attachment;

            echo <<< HTML

            <a href="$attachment" target="_blank" style="text-decoration: none"> 
            <img width=25 src="../../images/attachment.svg"> <h5 style="display:inline;">Download attachment</h5>
            </a>
            HTML;
        }

        echo <<< HTML

        <hr style="border-top: 3px solid #1D4354; color:#1D4354" >

        </div>
        
        </div>

    HTML;
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversation</title>

    <link rel="stylesheet" href="../../css/style.css">
    <link rel="icon" href="../../images/favicon.svg" sizes="any" type="image/svg+xml">
    <link href="http://fonts.cdnfonts.com/css/sitara" rel="stylesheet">

    <style>
        #details td {
            text-align: center;
            padding-left: 40px;
            padding-right: 40px;
            padding-bottom: 16px;
            padding-top: 10px;
            width: auto;
        }

        #text::first-letter {
            padding-left: 100px;
        }
    </style>
</head>

<body>

    <?php



    $page = "conversation";
   // require '../../config/config.php';
    include("../templates/header.php");
    include("../templates/navigation.php");



    ?>

    <div class="body-container" style="background:linear-gradient(rgba(255,255,255,.5), rgba(255,255,255,.5)), url('../../images/convs.png');background-repeat: repeat;">

        <?php

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            if (isset($_GET['id'])) {

                $inquiryId = $_GET["id"];

                $con = openCon();
                $sql = "SELECT U.email, I.createdDate, I.lastModifiedDate, I.isActive from users U, inquiry I WHERE I.id = '$inquiryId' AND I.conversationStarter = U.id";

                $result = $con->query($sql);

                if ($result->num_rows > 0) {

                    $row = mysqli_fetch_row($result);

                    if ($row[0] == $_SESSION["userid"]) {

                        $lastmodifiedDate = $row[2];
                        $createdDate = $row[1];
                        $status = "";

                        if($row[3] == "1"){
                            $status = "Open";
                        }
                        else{
                            $status = "Closed";
                        }

                        echo <<<HTML

                <h2 class="txt-green" style="margin-left:20vw;">Inquiry Details</h2>
                <div class="card" style="margin-left:20vw;width:auto;margin-right:20vw;">

                <table id="details" style="margin:auto;">
                <tr>
                <td ><h4 style="display:inline;"> Inquiry ID : 	&nbsp;	&nbsp;	&nbsp;  $inquiryId</h4></td>
                <td><h4 style="display:inline;"> Last Modified Date : &nbsp;	&nbsp; $lastmodifiedDate</h4></td>
                </tr>
                <tr>
                <td></td>
                <td>
                <h4 style="display:inline;"> Opened Date :  &nbsp;	&nbsp; $createdDate</h4>
                </td>
                </tr>
                <tr>
                <td></td>
                <td>
                <h4 style="display:inline;"> Status :  &nbsp;	&nbsp; $status</h4>
                </td></tr>
                </table>
                </div>
                

                HTML;

                        $sql = "SELECT U.firstName ,U.lastName, C.createdDate, C.text, U.role, C.attachment FROM conversations C, users U WHERE C.inquiryId='$inquiryId' AND C.userId = U.id";

                        $result = $con->query($sql);

                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {

                                message($row["firstName"] . " " . $row["lastName"], $row["createdDate"], $row["text"], $row["attachment"], $row["role"]);
                            }
                        }

                        if($status=="Open"){
                            echo <<<HTML
                    <form style="margin-left:120px;margin-top:100px;" method="post" enctype="multipart/form-data">
                    <textarea name="text" placeholder="Type here your message" id="" cols="100" rows="10"></textarea><br><br><br>
         
                    
                    <input type="file" id="fileselect" name="attachment"/>

                    <input class="btt type1" type="submit" name="newmsg"style="margin-left:100px;font-size:17px;"> 
                    </form>

                    HTML;


                        }
                        

                        
                    if($status=="Open"){

                        echo <<< HTML

                        <form method="POST">
                            <input  class="btt" name="closeinq" style="float:right;border: 5px solid #FCFCFC;color: #FCFCFC;padding:15px;background-color: #f44336;" type="submit" value="Close Inquiry">
                        </form>
                      HTML;

                    }
                    } else {

                        echo "You dont have permisssion to View this converstation";
                    }
                }
                else{

                    echo <<<HTML
                    <img style="display: block;margin-left: auto;margin-right: auto;width: 40%;" src="../../images/inquiry_not_found.svg">
                    HTML;
                    header("Refresh:5; url=dashboard.php");

                }

                closeCon($con);
              
            }
        }


        ?>

    </div>

    <?php include("../templates/footer.php");  ?>
    <script src="../../js/script.js"></script>

</body>

</html>