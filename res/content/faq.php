<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="icon" href="../../images/favicon.svg" sizes="any" type="image/svg+xml">
    <link href="http://fonts.cdnfonts.com/css/sitara" rel="stylesheet">

</head>

<body>
    <?php

    $page = "faq";
    require '../../config/config.php';
    include("../templates/header.php");
    include("../templates/navigation.php");

    ?>

    <div class="body-container" style="background:linear-gradient(rgba(255,255,255,.7), rgba(255,255,255,.7)), url('../../images/bg10.svg');background-repeat: no-repeat;background-size: 85%;background-position:center;">


        <h3 style="margin:0px;margin-left:10vw;font-family:'Sitara',sans-serif;"> FAQ </h3><br>
        <hr style="border-top: 3px solid #1D4354; color:#1D4354">


        <?php

        $conn = opencon();
        $sql = "SELECT u.firstName,u.lastName,c.id ,c.title,c.thumbnailText,c.authorid,c.tag FROM users u ,content c WHERE c.authorid = u.id AND c.tag = 'FAQ' ";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {

            echo "<table style='margin:auto;'><tr>";
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                if ($i % 5 == 0) {

                    if ($i == 0) {
                    } else {
                        echo "</tr><tr>";
                    }
                }
                $url = "content.php?id=" . $row['id'];
                echo <<< HTML
                   <td>
                   
                   <div class="card" style="width: 150px; margin: 15px;height: 300px; position: relative;border:3px solid #08A73A;">
                       <h4 class="txt-green" style="font-family: 'Sitara', sans-serif;text-align:center;">$row[title]"</h4>
                       <h5 style="font-family: 'Sitara', sans-serif;">$row[firstName].$row[lastName]</h5>
                       <p style="font-family: 'Sitara', sans-serif;font-size:small;">$row[thumbnailText]</p>
                       <div style="position: absolute;bottom: 15px;left: 37px;">
                       <a class="btt type1" href="$url" target="_blank" style="font-family:'Sitara',sans-serif;"> Read more</a>
                       </div>
                      
                   </div>
                   </td>
                   HTML;

                $i++;
            }

            echo "</tr></table>";
        }

        closeCon($conn);

        ?>

    </div>
    <?php
    include("../templates/footer.php");
    ?>
    <script src="../../js/script.js"></script>


</body>

</html>