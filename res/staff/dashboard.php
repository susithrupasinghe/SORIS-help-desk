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
    <title>SORIS Help Desk</title>
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

$page = "dashboard";
require '../../config/config.php';
include("../../res/templates/header.php");
include("../../res/templates/navigation.php");


?>

 <div class="body-container">

    <?php
    //require '../../config/config.php';

    $con=openCon();

    //$sq = "SELECT COUNT(id) FROM inqiry WHERE isActive='1'";
    echo"<h3> gg</h3>";
    //$row = mysqli_fetch_row($result);
    if (isset($_GET['email']))
    {
        $email = $_GET["email"];
        
        $sq = "SELECT COUNT(id) FROM inquiry WHERE isActive='1' && email='$email'";
        $result = $con->query($sq);
        if ($result->num_rows > 0)
        {
            
            $count = $sq;
            echo <<< HTML
            <h3 style="font-family:Sitara;margin-left:10px;color:#1D4354;">Active inquiry count : </h3><h3 style="font-family:Sitara;margin-left:10px;color:#1D4354;">$count</h3>
            HTML;
        }
    }
    
    
    ?>

    <h2 style="font-family:Sitara;margin-left:10px;color:#08A73A;">Active Inquery</h2>
    </br>

    <table class="table-style" style="max-width: 80%;margin:auto;">
            <tr>
                <th>Inquiry ID</th>
                <th>Title</th>
                <th>Faculty</th>
                <th>Student ID</th>
                <th>Section</th>
                <th>Last Modified Date</th>
                <th>Submited Date</th>
                <th>Details</th>
            </tr>

            <?php
               //require '../../config/config.php';

                $con=openCon();

                if (isset($_GET['email']))
                {
                    $email = $_GET["email"];

                    $sql1 = "SELECT id,title,createdDate,lastModifiedDate FROM inquiry WHERE isActive='1' && email='$email'";
                    $result = $con->query($sql1);

                   if($result->num_rows>0)
                   {
                       while($row = $result->fetch_assoc())
                       {
                           
                       }
                   }

                }
                
            ?>
    <?php
      /*  $conn = openCon();

        $sql="SELECT id FROM inquiry WHERE isActive='1'";
        $result = $conn->query($sql);
        $i=0;

        if($result->num_rows > 0)
        {
            while($result!=true)
            {
                $i=$i+1;
                break;
            }
            
           
        }
        echo "Active inquiry count :$i";*/

    ?>
</table>
 </div>

<?php include("../../res/templates/footer.php");  ?>
    <script src="../../js/script.js"></script>
    
</body>
</html>