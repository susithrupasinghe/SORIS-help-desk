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

    <form  method="POST">

        <div class="card" style="margin-left:25vw;margin-right:25vw;">
            <h2 style="font-family:Sitara;margin-left:170px;">Add Inquiry</h2>
            <b>Title </b><input style="margin-left:40px;" class="txt-input" type="text"></br>
            </br>
            <b>Content </b><textarea class="txt-input" name="content" rows="10" cols="40" style="margin-left:75px;"></textarea>
            </br>
            <b>Section </b><select class="txt-input" name="section"></select>
            </br></br></br>
            </br></br>

            <input type="button" name="attachment" class="btt type2" value="Attachment" style="margin-left:110px;">
            <input type="button" value="Submit" class="btt type1" name="btnsubmit" style="margin-left:10px;">

        </div>

       <?php
       $target_dir="uploats/";
       $target_file=$target_dir.basename($_FILES["fileFieldName"]["name"]);

       if(isset($_FILES[""]))
       {
           if(move_uploaded_file($_FILES[""]["tmp_name"],$target_file))
           {
               echo"";
           }
       }
       ?>


        <!--   <?php
                // if (isset($_POST["btnsubmit"])) {
                // echo "";
                // }
                ?>-->

    </form>
                </div>

    <?php include("../../res/templates/footer.php");  ?>
    <script src="../../js/script.js"></script>

</body>

</html>