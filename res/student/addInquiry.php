<!--Session Start-->
<?php
session_start();

//if (isset($_SESSION["userid"]) && isset($_SESSION["role"])) {
//header("Location: ../../index.php");
//}
?>

<?php
include_once  '../../config/config.php';

//Upload attachment
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = openCon();
    if (isset($_POST['btnsubmit'])) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . $_FILES["attachment"]["name"];
        $upload = 1;

        //Check file size
        if ($_FILES["attachment"]["size"] > 500000) {
            echo <<< HTML
                    <div class='alert' style= 'width:40%; margin-left:400px; position:absolute; top: 20%;'>
                    <span class='closebtn'>&times;</span>
                    <strong style= 'text-align:center;font-size: 30x;'>Sorry,your file is too large.</strong>
                    </div>
                HTML;
            $upload = 0;
        }

        if ($upload == 0) {
        } else {
            if (move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file)) {
                header("Location: dashboard.php");
            } else {
                /*echo <<< HTML
            <div class='alert' style= 'width:40%; margin-left:400px; position:absolute; top: 20%;'>
            <span class='closebtn'>&times;</span>
            <strong style= 'text-align:center;font-size: 30x;'>Sorry, there was an error uploading your file.</strong>
            </div>
            HTML;*/
            }
        }


        $conn = openCon();

        $TitleName = $_POST['TitleName'];
        $Cdatetime = date("Y-m-d h:i:s");
        $Mdatetime = date("Y-m-d h:i:s");
        $active = 1;

        //insert into staffid
        $sql4 = "SELECT id from users WHERE role='staff'";
        $res =  $conn->query($sql4);

        if ($res->num_rows > 0) {
            $row = mysqli_fetch_row($res);
            $staffid =  $row[0];
           // $section = $_POST['section'];
            $sql = "INSERT INTO inquiry (currentStaffId) VALUES ('$staffid')";
            echo "vvvvvvvvvvvv";
        }

        $sql = "INSERT INTO inquiry(title,createdDate,lastModifiedDate,isActive) VALUES ('$TitleName','$Cdatetime','$Mdatetime','$active')";
        $result1 = $conn->query($sql);

        if ($result1 === true) {
            $last_id = $conn->insert_id;

            $sql1 = "SELECT conversationStarter FROM inquiry WHERE id='$last_id'";
            $result2 = $conn->query($sql1);

            if ($result2->num_rows > 0) {
                //$row = mysqli_fetch_row($result2);
                $text = $_POST['addContent'];

                $sql2 = "INSERT INTO conversations(inquiryId,text) VALUES(' $last_id','$text')";
                $result = $conn->query($sql2);

                //insert file
                $fname = $_FILES['attachment']['name'];

                if ($fname != "") {


                    $destination = '../uploads/' . $fname;

                    $file = $_FILES['attachment']['tmp_name'];

                    if (move_uploaded_file($file, $destination)) {

                        $attachment = $fname;
                        $sql3 = "INSERT INTO conversations(attachment) VALUES ('$attachment')";
                        $result = $conn->query($sql3);
                    } else {
                        echo "Failed to upload file.";
                    }
                }
            }
        }

        //insert into  conversationStarter
        $email = $_GET["email"];

        $sql2 = "SELECT id FROM users WHERE email='$email'";
        $res = $conn->query($sql);

        if ($res->num_rows > 0) {
            $row = mysqli_fetch_row($res);

            $conversationStarter = $sql2;
            $sql3 = "INSERT INTO inquiry(conversationStarter) VALUES (' $conversationStarter')";
        }
    }
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

    <link href="http://fonts.cdnfonts.com/css/sitara" rel="stylesheet">

</head>



<body>

    <?php

    $page = "dashboard";
    include("../../res/templates/header.php");
    include("../../res/templates/navigation.php");


    ?>

    <div class="body-container">

        <form method="POST" enctype="multipart/form-data">

            <div class="card" style="margin-left:20vw;margin-right:25vw;width:55%;">
                <h2 style="font-family:Sitara;margin-left:250px;font-family:Sitara, sans-serif;">Add Inquiry</h2>

                <label for="title" style="font-family:Sitara, sans-serif;font-weight:bold;margin-left:45px;margin-right:30pxs;">Title </label>
                <input style="margin-left:77px;min-width:375px" class="txt-input" type="text" name="TitleName"></br>
                </br></br>

                <label for="content" style="font-family:Sitara, sans-serif;font-weight:bold;;margin-left:45px;margin-right:10pxs">Content</label>
                <textarea class="txt-input" name="addContent" rows="10" cols="51" style="margin-left:50px;"></textarea>
                </br></br>

                <label for="section " style="font-family:Sitara, sans-serif;font-weight:bold;margin-left:45px;">Section</Section> </label>
                <select class="txt-input" name="section" style="margin-left:50px ;min-width: 405px;">

                    <?php {

                        $conn = openCon();
                        $result = $conn->query("SELECT firstName from users WHERE role='staff'");

                        $color1 = "#ffffff";
                        $color2 = "#e0e0e0";
                        $color = $color1;

                        while ($rows = $result->fetch_assoc()) {

                            $color == $color1 ? $color1 = $color2 : $color = $color1;

                            $section = $rows['firstName'];
                            echo "<option value='$section' style='background:$color;'>$section</option>";
                        }
                    }
                    ?>
                </select>
                </br></br></br></br></br>


                <input type="file" name="attachment" id="fileselect" style="margin-left:150px;">
                <input type="submit" value="Submit" class="btt type1" name="btnsubmit" style="margin-left:3px;margin-bottom:20px"></br>

            </div>

        </form>
    </div>

    <?php
    include("../../res/templates/footer.php");  ?>
    <script src="../../js/script.js"></script>

</body>

</html>