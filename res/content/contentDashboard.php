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
    <title>Document</title>
    <link rel="stylesheet" href="../../css/style.css">

    <link href="http://fonts.cdnfonts.com/css/sitara" rel="stylesheet">
    <style>
        .table-style th {
            text-align: center;
        }

        .table-style td {
            text-align: center;
        }
    </style>
</head>

<body>
    <?php
    $page = "contentDashboard";

    include("../templates/header.php");
    include("../templates/navigation.php");
    ?>
    <div class="body-container">

        <a href="composeContent.php" target="_blank">
            <div class="btt type3" style="float: right;">Post New Content</div>
        </a>
        <h2 class="txt-green" style="margin-left:20%;margin-right:auto;">Content List</h2>


        <table class="table-style" style="max-width: 80%;margin:auto;">
            <tr>
                <th>Title</th>
                <th>Thumbnail Subtitle</th>
                <th>Tag</th>
                <th>Action</th>
            </tr>
            <?php

            require '../../config/config.php';

            $con = openCon();
            $sql = "SELECT id,title,thumbnailText,tag FROM content";

            $result = $con->query($sql);

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $subtitle = $row['thumbnailText'];
                    $tag = $row['tag'];
                    $link = "contentDashboard.php?delete=$id";

                    echo <<< HTML
                        <tr>
                        <td> $title</td>
                        <td> $subtitle</td>
                        <td>  $tag</td>
                        <td> <a href="$link">Delete</a></td>
                        </tr>
                        HTML;
                }
            }

            closeCon($con);


            ?>
        </table>
    </div>

    <?php include("../templates/footer.php");  ?>
    <script src="../../js/script.js"></script>

</body>

</html>