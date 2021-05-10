<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link href="http://fonts.cdnfonts.com/css/sitara" rel="stylesheet">

</head>

<body>
    <?php

    $page = "faq";
    require '../../config/config.php';
    include("../templates/header.php");
    include("../templates/navigation.php");

    ?>

    <div class="body-container">


        <h3 style="margin-left:10vw;"> FAQ </h3><br>
        <hr style="border-top: 3px solid #1D4354; color:#1D4354">


        <?php

        $conn = opencon();
        $sql = "SELECT u.firstName,u.lastName,c.id ,c.title,c.thumbnailText,c.authorid,c.tag FROM users u ,content c WHERE c.authorid = u.id AND c.tag = 'FAQ' ";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr>";
        }

        $i = 1;
        $c=7;
        while ($row = $result->fetch_assoc()) {
            if ($i==$c) {
                echo "</tr><tr>";
               $c=$c+6;
            }
            echo "<td>";
            echo <<< HTML
                <div class="card" style="width: 150px; margin: 15px;min-height: 250px;padding-right: 20px;">
                    <h3 class="txt-green" style="font-family: 'Sitara', sans-serif;">$row[title]"</h3>
                    <h5 style="font-family: 'Sitara', sans-serif;">$row[firstName].$row[lastName]</h5>
                    <p style="font-family: 'Sitara', sans-serif;">$row[thumbnailText]</p>
                    <a href="" style="margin-left:80px;"> Read more</a>
        
                </div>
                HTML;
            echo "</td>";
            $i++;
        }

        echo "</table>";

        ?>
        
    </div>
    <?php
    include("../templates/footer.php");
    ?>
    <script src="../../js/script.js"></script>


</body>

</html>