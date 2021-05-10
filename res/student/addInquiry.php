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

            <div class="card" style="margin-left:25vw;margin-right:25vw;font-family:Sitara, sans-serif;">
                <h2 style="font-family:Sitara;margin-left:170px;font-family:Sitara, sans-serif;">Add Inquiry</h2>

                <label for="title" style="font-family:Sitara, sans-serif;font-weight:bold;">Title </label>
                <input style="margin-left:40px;" class="txt-input" type="text"></br>
                </br>

                <label for="content" style="font-family:Sitara, sans-serif;font-weight:bold;">Content</label>
                <textarea class="txt-input" name="content" rows="10" cols="40" style="margin-left:75px;"></textarea>
                </br>

                <label for="section " style="font-family:Sitara, sans-serif;font-weight:bold;">Section</Section> </label>
                <select class="txt-input" name="section" style="margin-left:40px width=40px">
                    <?php {
                      
                            $con = openCon();

                            $sqlQuery = "SELECT role FROM user WHERE role=staff";
                            $result = $con->query($sqlQuery);

                            if ($result->num_row > 0) {
                                while ($row = $result->fetch_assoc()) {
                                }
                            
                        }
                    }
                    ?>
                </select>
                </br></br></br>
                </br></br>

                <input type="file" name="attachment" class="btt type2" value="Attachment" style="margin-left:110px;">
                <input type="submit" value="Submit" class="btt type1" name="btnsubmit" style="margin-left:10px;">

            </div>

            <?php
            if (isset($_POST["btnsubmit"])) {
               $title=$_POST["TitleName"];
               $content=$_POST["addContent"];
               $section=$_POST["selSection"];
               $atachment=$_POST["addAttach"];

               $sql="INSERT INTO inquiry(title)values('$title')";
               $sql="INSERT INTO conversation(attachment)value('$atachment')";

               if(mysqli_query($con,$sql))
               {
                    echo "<script>alert('Your inquiry was added');widow.location='addInquiry.php'</script>";
               }
               
            }
            ?>

            <?php

            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($_FILES["attachment"]["name"]);

            if (isset($_FILES["attachment"])) {
                if (move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file)) {
                    echo "";
                }
            }
            ?>

        </form>
    </div>

    <?php include("../../res/templates/footer.php");  ?>
    <script src="../../js/script.js"></script>

</body>

</html>