<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['btnsubmit'])) {

                echo  $_FILES["addAttach"]["name"];

                
                    $target_dir = "../uploads/";
                    $target_file = $target_dir .$_FILES["addAttach"]["name"];
                    $upload = 1;

                    

                    //Check file size
                    if ($_FILES["addAttach"]["size"] > 500000) {
                        echo "<script>alert('Sorry,your file is too large.');widow.location='addInquiry.php'</script>";
                        $upload = 0;
                    }

                    if ($upload == 0) {
                    } else {
                        if (move_uploaded_file($_FILES["addAttach"]["tmp_name"], $target_file)) {
                            echo "<script>alert('Ok.');widow.location='addInquiry.php'</script>";
                        } else {
                            echo "<script>alert('Sorry, there was an error uploading your file.');widow.location='addInquiry.php'</script>";
                        }
                    }
                

                $conn = openCon();
                include_once  '../../config/config.php';

                $TitleName = $_POST['TitleName'];
                $Iid = $row[0];
                $Cdatetime = date("Y-m-d h:i:s");
                $Mdatetime = date("Y-m-d h:i:s");


                $sql = "INSERT INTO users(id,title,createdDate,lastModifiedDate,isActive,conversationStarter,currentStaffId) VALUES ('$TitleName',$Iid,$Cdatetime,)";
                $result = mysqli_query($conn, $sql);

                header("Location:addInquiry.php");
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
    require '../../config/config.php';
    include("../../res/templates/header.php");
    include("../../res/templates/navigation.php");


    ?>

    <div class="body-container">

        <form method="POST">

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
                    <option value="none"></option>

                    <?php {

                        $conn = openCon();
                        $result = $conn->query("SELECT firstName from users WHERE role='staff'");

                        $color1 = "#ffffff";
                        $color2 = "#EFEEEC";
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


                <input type="file" name="addAttach" id="fileselect" style="margin-left:50px;">
                <input type="submit" value="Submit" class="btt type1" name="btnsubmit" style="margin-left:5px;margin-bottom:20px"></br>

            </div>

            




        </form>
    </div>

    <?php include("../../res/templates/footer.php");  ?>
    <script src="../../js/script.js"></script>

</body>

</html>