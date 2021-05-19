
<?php
 include_once  '../../config/config.php';

 $error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (isset($_POST['btnsubmit'])) {


                    $target_dir = "../uploads/";
                    $target_file = $target_dir .$_FILES["attachment"]["name"];
                    $upload = 1;

                    //Check file size
                    if ($_FILES["attachment"]["size"] > 500000) {
                        $error="Sorry,your file is too large.";
                        $upload = 0;
                    }

                    if ($upload == 0) {
                    } else {
                        if (move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file)) {
                            header("Location: dashboard.php");
                        } else {
                            $error="Sorry, there was an error uploading your file.";
                        }
                    }
                

                $conn = openCon();
               
                $TitleName = $_POST['TitleName'];
                $Cdatetime = date("Y-m-d h:i:s");
                $Mdatetime = date("Y-m-d h:i:s");
                $active=1;
        
               /* $filename = $_FILES['attachment']['name'];
        
                if($filename != ""){
        
                $destination = '../uploads/' . $filename;
        
                $file = $_FILES['attachment']['tmp_name'];
        
                if (move_uploaded_file($file, $destination)) {
        
                    $attachment = $filename;
                           
                } else {
                    echo "Failed to upload file.";
                    }
                }
                
                $sql = "INSERT INTO conversations(attachment)VALUES('$attachment')";
                $result = $conn->query($sql);*/

                $sql = "INSERT INTO inquiry(title,createdDate,lastModifiedDate,isActive) VALUES ('$TitleName','$Cdatetime','$Mdatetime','$active')";
                $result = $conn->query($sql);

                //insert into Content to the conversations table
                $sqli = "SELECT id from inquiry";

                $sql2="SELECT id from conversations WHERE id=".$sqli;
                $result = $conn->query($sql2);

                if ($result->num_rows > 0) {
                   
                    $content=$_POST['addContent'];
                    $sql3="INSERT INTO conversations(text)VALUE('$content')";

                }

                //insert into file
               /* $sqli = "SELECT id from inquiry";

                $sql2="SELECT id from conversations WHERE id=".$sqli;
                $result = $conn->query($sql2);

                if ($result->num_rows > 0) {
                    $row = mysqli_fetch_row($result);
                    $filename = $_FILES['attachment']['name'];

                }*/

                //insert into staffid
                $sql4="SELECT stdid from users WHERE role='staff'";
                $res =  $conn->query($sql4);

                while($res->num_rows > 0) {
                    $row = mysqli_fetch_row($res);
                   // $section = $_POST['section'];
                    $sql="INSERT INTO inquiry (currentStaffId) VALUE ('$sql4 ')";
                    break;
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

            <div class="card" style="margin-left:25vw;margin-right:25vw;width:40%;">
                <h2 style="font-family:Sitara;margin-left:170px;font-family:Sitara, sans-serif;">Add Inquiry</h2>

                <label for="title" style="font-family:Sitara, sans-serif;font-weight:bold;">Title </label>
                <input style="margin-left:40px;" class="txt-input" type="text" name="TitleName"></br>
                </br>

                <label for="content" style="font-family:Sitara, sans-serif;font-weight:bold;">Content</label>
                <textarea class="txt-input" name="addContent" rows="10" cols="40" style="margin-left:75px;"></textarea>
                </br>

                <label for="section " style="font-family:Sitara, sans-serif;font-weight:bold;">Section</Section> </label>
                <select class="txt-input" name="section" style="margin-left:5% ;width:75%">
                    
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
                </br></br></br>


                <input type="file" name="attachment" id="fileselect" style="margin-left:50px;">
                <input type="submit" value="Submit" class="btt type1" name="btnsubmit" style="margin-left:5px;margin-bottom:20px"></br>

            </div> 

        </form>
    </div>

    <?php 
    echo "<script>alert".$error."</script>";
    include("../../res/templates/footer.php");  ?>
    <script src="../../js/script.js"></script>

</body>

</html>