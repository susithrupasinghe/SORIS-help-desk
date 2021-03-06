<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information</title>

    <link rel="stylesheet" href="../../css/style.css">
    <link rel="icon" href="../../images/favicon.svg" sizes="any" type="image/svg+xml">
    <link href="http://fonts.cdnfonts.com/css/sitara" rel="stylesheet">
</head>

<body>

    <?php
    $page = "information";
    require '../../config/config.php';
    include("../templates/header.php");
    include("../templates/navigation.php");
    ?>

    <div class="body-container" style="background:linear-gradient(rgba(255,255,255,.8), rgba(255,255,255,.8)), url('../../images/bg8.svg');background-repeat: no-repeat;background-size: 80%;background-position:center;">

        <h3 style="margin:0px;margin-left:10vw;">Information </h3><br>
        <hr style="border-top: 3px solid #1D4354; color:#1D4354">

        <?php
        $conn = opencon();
        $sqlQuery = "SELECT u.firstName,u.lastName,c.id ,c.title,c.thumbnailText,c.authorid,c.tag FROM users u ,content c WHERE c.authorid = u.id AND c.tag = 'Information' ";
        $result = $conn->query($sqlQuery);

        if ($result->num_rows > 0) {
            echo "<table style='margin:auto;'>";
            echo "<tr>";
        }
        $i = 0;

        while ($row = $result->fetch_assoc()) {
            $postLink = "content.php?id=" . $row["id"];

            if ($i % 5 == 0) {

                if ($i == 0) {
                } else {
                    echo "</tr><tr>";
                }
            }
            echo "<td >";
            echo <<< HTML
                <div class= "card" style="width: 150px; margin: 15px;height: 300px; position: relative;border:3px solid #08A73A;">
                    <h3 class= "txt-green" style= "font-family: 'Sitara', sans-serif; text-align:center;">$row[title] </h3>
                    <h5 style= "font-family: 'Sitara', sans-serif;">$row[firstName].$row[lastName] </h5>
                    <p style= "font-family: 'Sitara', sans-serif; font-size:small;">$row[thumbnailText] </p>
                    <div style="position: absolute;bottom: 15px;left: 37px;">
                    <a class="btt type1" href= "$postLink" target="_blank"> Read more </a>
                    <div>        
                </div>
                HTML;
            echo "</td>";
            $i++;
        }
        echo "</tr></table>";
        closeCon($conn);
        ?>
    </div>

    <?php include("../templates/footer.php"); ?>
    <script src="../../js/script.js"></script>

</body>

</html>