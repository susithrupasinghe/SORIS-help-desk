<?php

require '../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['newmsg'])) {

        $text = $_POST['text'];
        // $attachment = $_POST['attachment'];
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

            print_r($_FILES['attachment']);

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

                // header("Refresh:0");
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
        <td rowspan="2"><img src="/SORIS-help-desk/images/student.png" alt="" style="max-width:65px;border-radius:50%;border:2px solid #1D4354;"></td>
        <td> <h3 class ="txt-green" style="display:inline;margin-top:-40px;padding-left:15px;">$name</h3></td>
        </tr>
        <tr>
        <td><h5 style="display:inline;margin-top:-40px;padding-left:15px;color:#1D4354;">$date</h5></td>
        </tr>
        </table>
        <div id="text" style="padding-left:100px;">
        <p style="font-weight:900;color:#1D4354;"> $text</p>

        HTML;

        echo $attachment;

        if ($attachment != "") {

            $attachment = "../uploads/".$attachment;

            echo <<< HTML

            <a href="$attachment" target="_blank" style="text-decoration: none"> 
            <img width=25 src="/SORIS-help-desk/images/attachment.svg"> <h5 style="display:inline;">Download attachment</h5>
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
        <td rowspan="2"><img src="/SORIS-help-desk/images/staff.png" alt="" style="max-width:65px;border-radius:50%;border:2px solid #1D4354;"></td>
        <td> <h3  class ="txt-green" style="display:inline;margin-top:-40px;padding-left:15px;">$name</h3></td>
        </tr>
        <tr>
        <td><h5 style="display:inline;margin-top:-40px;padding-left:15px;color:#1D4354;">$date</h5></td>
        </tr>
        </table>
        <div id="text" style="padding-left:100px;">
        <p style="font-weight:900;color:#1D4354;"> $text</p>

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
    <title>Document</title>

    <link rel="stylesheet" href="../../css/style.css">

    <link href="http://fonts.cdnfonts.com/css/sitara" rel="stylesheet">

    <style>
        #details td {
            text-align: center;
            padding-left: 40px;
            padding-right: 40px;
            padding-bottom: 16px;
            padding-top: 10px;
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

    <div class="body-container">

        <?php

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            if (isset($_GET['id'])) {

                $inquiryId = $_GET["id"];

                $con = openCon();
                $sql = "SELECT U.email from users U, inquiry I WHERE I.id = '$inquiryId' AND I.conversationStarter = U.id";

                $result = $con->query($sql);

                if ($result->num_rows > 0) {

                    $row = mysqli_fetch_row($result);

                    if ($row[0] == $_SESSION["userid"]) {

                        echo <<<HTML

                <h2 class="txt-green" style="margin-left:20vw;">Inquiry Details</h2>
                <div class="card" style="margin-left:20vw;">

                <table id="details">
                <tr>
                <td width=150><h4 style="display:inline;"> Inquiry ID : 	&nbsp;	&nbsp;	&nbsp;  $inquiryId</h4></td>
                <td><h4 style="display:inline;"> Last Modified Date : &nbsp;	&nbsp; $inquiryId</h4></td>
                </tr>
                <tr>
                <td></td>
                <td>
                <h4 style="display:inline;"> Opened Date :  &nbsp;	&nbsp; $inquiryId</h4>
                </td>
                </tr>
                <tr>
                <td></td>
                <td>
                <h4 style="display:inline;"> Status :  &nbsp;	&nbsp; $inquiryId</h4>
                </td></tr>
                </table>
                </div>
                

                HTML;

                        $sql = "SELECT U.firstName ,U.lastName, C.createdDate, C.text, U.role, C.attachment FROM conversations C, users U WHERE C.inquiryId='$inquiryId' AND C.userId = U.id";

                        $result = $con->query($sql);

                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {

                                message($row["firstName"] . " " . $row["lastName"], $row["createdDate"], $row["text"], '../uploads/' .$row["attachment"], $row["role"]);
                            }
                        }


                        echo <<<HTML
                    <form style="margin-left:120px;margin-top:100px;" method="post" enctype="multipart/form-data">
                    <textarea name="text" id="" cols="100" rows="10"></textarea><br><br><br>
         
                    
                    <input type="file" id="fileselect" name="attachment"/>

                    <input class="btt type1" type="submit" name="newmsg"style="margin-left:100px;font-size:17px;"> 
                    </form>
                  HTML;
                    } else {

                        echo "You dont have permisssion to View this converstation";
                    }
                }

                closeCon($con);
            }
        }


        ?>

    </div>

    <?php include("../templates/footer.php");  ?>
    <script src="js/script.js"></script>

</body>

</html>