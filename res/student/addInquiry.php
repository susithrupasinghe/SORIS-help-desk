<!--Session Start-->
<?php
session_start();

if (isset($_SESSION["userid"]) && isset($_SESSION["role"])) {
} else
    header("Location: ../../index.php");
?>


<?php
include_once  '../../config/config.php';

//Upload attachment
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $conn = openCon();

    $target_dir = "../uploads/";
    $target_file = $target_dir . $_FILES["attachment"]["name"];
    $upload = 1;


    //Check file size
    if ($_FILES["attachment"]["size"] > 50000000) {
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
            //header("Location: dashboard.php");
        }
    }

    //Check submission        
    if (isset($_POST['btnsubmit'])) {

        $conn = openCon();

        $TitleName = $_POST['TitleName'];
        $Cdatetime = date("Y-m-d h:i:s");
        $Mdatetime = date("Y-m-d h:i:s");
        $active = 1;
        $sec = $_POST['section'];


        //insert into  conversationStarter
        $uMail = $_SESSION['userid'];

        $sql3 = "SELECT id FROM users WHERE email='$uMail'";
        $result3 = $conn->query($sql3);
        $uid = "";

        while ($row = $result3->fetch_assoc()) {

            $uid = $row['id'];
        }

        //insert into title,createdDate,lastModifiedDate,isActive,conversationStarter,currentStaffId
        $sql5 = "INSERT INTO inquiry(title,createdDate,lastModifiedDate,isActive,conversationStarter,currentStaffId) VALUES ('$TitleName','$Cdatetime','$Mdatetime','$active','$uid',' $sec')";
        $result5 = $conn->query($sql5);

        if ($result5 === true) {
            $last_id = $conn->insert_id;

            $sql6 = "SELECT conversationStarter FROM inquiry WHERE id='$last_id'";
            $result6 = $conn->query($sql6);

            if ($result6->num_rows > 0) {

                $text = $_POST['addContent'];

                $sql7 = "INSERT INTO conversations(inquiryId,text,userId) VALUES(' $last_id','$text',' $uid')";
                $result7 = $conn->query($sql7);



                //insert file
                $fname = $_FILES['attachment']['name'];

                if ($fname != "") {

                    $destination = '../uploads/' . $fname;

                    $file = $_FILES['attachment']['tmp_name'];

                    if (move_uploaded_file($file, $destination)) {

                        $attachment = $fname;
                        $sql8 = "INSERT INTO conversations(attachment) VALUES ('$attachment')";
                        $result8 = $conn->query($sql8);
                    }
                }
            }
        }
        //header("Location: dashboard.php");
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

    <link rel="icon" href="../../images/favicon.svg" sizes="any" type="image/svg+xml">
    <link href="http://fonts.cdnfonts.com/css/sitara" rel="stylesheet">

</head>


<body>

    <?php
    $page = "";
    include("../../res/templates/header.php");
    include("../../res/templates/navigation.php");
    ?>

    <div class="body-container">

        <form method="POST" enctype="multipart/form-data">

            <div class="card" style="margin-left:20vw;margin-right:25vw;width:55%;border:3px solid #08a73a">
                <h2 style="font-family:Sitara;margin-left:250px;font-family:Sitara, sans-serif;">Add Inquiry</h2>

                <label for="title" style="font-family:Sitara, sans-serif;font-weight:bold;margin-left:45px;margin-right:30pxs;">Title </label>
                <input style="margin-left:77px;min-width:375px" class="txt-input" type="text" name="TitleName"></br>
                </br></br>

                <label for="content" style="font-family:Sitara, sans-serif;font-weight:bold;;margin-left:45px;margin-right:10pxs">Content</label><br>
                <textarea class="txt-input" name="addContent" rows="10" cols="51" style="margin-left:160px;"></textarea>
                </br></br>

                <label for="section " style="font-family:Sitara, sans-serif;font-weight:bold;margin-left:45px;">Section</Section> </label>
                <select class="txt-input" name="section" style="margin-left:50px ;min-width: 405px;padding-left: 35px;padding-right: 35px;padding-top: 8px;padding-bottom: 8px;">

                    <?php {

                        $conn = openCon();
                        $result = $conn->query("SELECT firstName,lastName,faculty,id from users WHERE role='staff'");

                        $color1 = "#ffffff";
                        $color2 = "#e0e0e0";
                        $color = $color1;

                        while ($rows = $result->fetch_assoc()) {

                            $color == $color1 ? $color1 = $color2 : $color = $color1;

                            $section = $rows['firstName'];
                            $lName = $rows['lastName'];
                            $facul = $rows['faculty'];
                            $id = $rows['id'];
                            echo "<option value='$id' style='background:$color;'>$section / $lName /  $facul</option>";
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