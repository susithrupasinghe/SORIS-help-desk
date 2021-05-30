<?php
session_start();

if (isset($_SESSION["userid"]) && isset($_SESSION["role"])) {

    if ($_SESSION["role"] == "student") {

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
    <title>Compose Content</title>
    <link rel="stylesheet" href="../../css/style.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <link rel="icon" href="../../images/favicon.svg" sizes="any" type="image/svg+xml">
    <link href="http://fonts.cdnfonts.com/css/sitara" rel="stylesheet">
    <script>
        function Attch_html_wrapper() {

            var htmlcontent = $('#wordwrap').summernote('code');
            htmlcontent = htmlcontent.replace("\"", "'");
            var hiddenele = document.getElementById("htmlContent");

            hiddenele.setAttribute("value", htmlcontent);

            return true;

        }
    </script>
</head>

<body>
    <?php
    $page = "ComposeContent";

    include("../templates/header.php");
    include("../templates/navigation.php");
    ?>

    <div class="body-container">

        <?php
        require '../../config/config.php';

        if (isset($_POST['submit'])) {

            $conn = openCon();


            $email = $_SESSION['userid'];
            $sql = "SELECT id FROM users WHERE email='$email'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();


            $userId = $row["id"];
            $titlee = $_POST['title'];
            $subtitle = $_POST['subtitle'];
            $tag = $_POST['tag'];
            $Createddatetime = date("Y-m-d h:i:s");
            $htmlcontent = $_POST['htmlContent'];


            $sql = "INSERT INTO content (title, thumbnailText, authorId, tag, createdDate, htmltext) VALUES ('$titlee','$subtitle','$userId','$tag','$Createddatetime','$htmlcontent')";
            $result = $conn->query($sql);
            if ($result === TRUE) {

                header("Location: contentDashboard.php");
            } else {
                echo <<< HTML
                        <div class='alert' style= 'width:40%; margin-left:400px; position:absolute; top: 20%;'>
                        <span class='closebtn' onclick="this.parentElement.style.display='none';">&times;</span>
                        <strong style= 'text-align:center;font-size: 30x;'>Sorry,Content not posted succusfully.</strong>
                        </div>
                    HTML;
            }
        }

        ?>

        <div style="margin-top: 50px;">

            <form action="" style="text-align: left;" method="POST" name="mainform" enctype="multipart/form-data" onsubmit="Attch_html_wrapper()">

                <div style="margin-left: 10%;">
                    <label for="title" style=" font-family:'sitara',sans-serif; font-weight:bold;margin-right:60px;">Title </label>
                    <input type="text" id="title" class="txt-input" name="title" style="min-width: 60%;margin-left:80px;" required>
                    <br>

                    <label for="thumbnailtext" style=" font-family:'sitara',sans-serif; font-weight:bold;margin-right:60px;">Thumbnail Text </label>
                    <input type="text" id="thumbnailtext" class="txt-input" name="subtitle" style="min-width: 60%;" required>
                    <br>

                    <label for="tag" style=" font-family:'sitara',sans-serif; font-weight:bold;margin-right:60px;">Tag </label>
                    <select class="txt-input" name="tag" id="" style="margin-left: 90px;" required>
                        <option value="NEWS">NEWS</option>
                        <option value="FAQ">FAQ</option>
                        <option value="Information">Information</option>
                    </select>
                </div>



                <div style="padding: 100px;">
                    <div id="wordwrap" name="wordwrap" value=""></div>
                </div>
                <br>


                <input type="hidden" id="htmlContent" name="htmlContent" value="">
                <div style="text-align:center;">
                <input type="submit" class="btt type1" name="submit" value="submit" style="min-width: 150px;font-size:large;">

                </div>
                
            </form>
        </div>




    </div>

    <?php include("../templates/footer.php");  ?>
    <script>
        $('#wordwrap').summernote({
            placeholder: 'Type your post content here',
            tabsize: 2,
            height: 500,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>

    <script src="../../js/script.js"></script>

</body>

</html>