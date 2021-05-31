<?php

require '../../config/config.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {



    if (isset($_GET['id'])) {

        $contentId = $_GET['id'];

        $con = openCon();

        $sql = "SELECT * FROM content WHERE id=' $contentId'";

        $result = $con->query($sql);

        if ($result->num_rows > 0) {

            $contentData = mysqli_fetch_row($result);
            $title = ucwords($contentData[1]);
            $time =  $contentData[5];
            $author = $contentData[3];
            $tag = $contentData[4];
            $text = base64_decode($contentData[6]);
            
        } else {
            header("Location: faq.php");
        }
    } else {

        header("Location: faq.php");
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="icon" href="../../images/favicon.svg" sizes="any" type="image/svg+xml">
    <link href="http://fonts.cdnfonts.com/css/sitara" rel="stylesheet">
    <style>
        td {
            padding-left: 100px;
            padding-bottom: 0px;
        }

    </style>
</head>

<body>


    <?php

    $page = "";

    include("../templates/header.php");
    include("../templates/navigation.php");

    echo <<< HTML

    <div class="body-container" style="padding-left: 150px;padding-right:150px;background:linear-gradient(rgba(255,255,255,.9), rgba(255,255,255,.9)), url('../../images/bg21.svg');background-repeat: no-repeat;background-size: 150%;background-position:center;">

    <table>
    <tr>
    <td colspan=3><h1 class="txt-green">$title</h1></td>
    </tr>
    <tr>
    <td><h4>Posted at : $time</h4></td>
    <td><h4>Author : $author</h4></td>
    <td><h4>Tags : $tag</h4></td>
    </tr>
    </table>
    <div style="height:50px;">
    </div>  
    <div style="background-color:#FFF;border: 3px solid #1D4354;border-radius:30px;padding:20px;">
    HTML;

    echo $text;

    ?>
    </div>  
    </div>

    <?php include("../templates/footer.php");  ?>
    <script src="../../js/script.js"></script>
</body>

</html>