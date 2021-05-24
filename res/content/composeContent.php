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

<?php

if (isset($_POST['htmlcontent'])) {

    header("Refresh:0");
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
        
        <div style="margin-top: 50px;">

        <form action="" style="text-align: center;" method="POST" name="mainform" enctype="multipart/form-data" onsubmit="Attch_html_wrapper()">
            <label for="title" style=" font-family:'sitara',sans-serif; font-weight:bold;margin-right:60px;">Title </label>
            <input type="text" id="title" class="txt-input" name="title" style="min-width: 60%;margin-left:80px;">
            <br>

            <label for="thumbnailtext" style=" font-family:'sitara',sans-serif; font-weight:bold;margin-right:60px;">Thumbnail Text </label>
            <input type="text" id="thumbnailtext" class="txt-input" name="subtitle" style="min-width: 60%;">
            <br>

            <div style="padding: 100px;">
                <div id="wordwrap" name="wordwrap" value=""></div>
            </div>

            <input type="hidden" id="htmlContent" name="htmlContent" value="">
            <input type="submit" class="btt type1" name="submit" value="submit" style="min-width: 150px;font-size:large;">

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