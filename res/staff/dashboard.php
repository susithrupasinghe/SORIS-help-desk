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

    <link rel="icon" href="../../images/favicon.svg" sizes="any" type="image/svg+xml">
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

        $uMail=$_SESSION['userid'];

        $sql1 = "SELECT id FROM users WHERE email='$uMail'";
        $result1= $con->query($sql1);

        if($result1->num_rows > 0)
        {
            $row = mysqli_fetch_row($result1);
            $stffId = $row[0];

            //while($row = $result1->fetch_assoc())
           // {
                //$stffId = $row['id'];

            $sql2 = "SELECT COUNT(isActive) FROM inqiry WHERE isActive='1' AND currentStaffId = $sql1";
            $result2 = $con->query($sql2);
            //$row1 = $result2->fetch_assoc();
           
           // while($row = $result2->fetch_assoc())
           // {
                //$Active = $row['isActive']; 
            //echo $Active;
           // }
                
           // }
            

            /*echo <<< HTML
            <h3 style="font-family:Sitara;margin-left:10px;color:#1D4354;">Active inquiry count : </h3><h3 style="font-family:Sitara;margin-left:10px;color:#1D4354;">$Active</h3>
            HTML;*/

            echo <<< HTML
            <h2 style="font-family:Sitara;margin-left:10px;color:#08A73A;">Active Inquery</h2>
            <br>

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
            HTML;

            $sql3 = "SELECT id FROM users WHERE email='$uMail'";
            $result3 = $con->query($sql3);

            if ($result3->num_rows > 0)
            { 
                $uid = $row[0];
                $sql4 = "SELECT id,title FROM inquiry WHERE id='$uid'";
               // $row = mysqli_fetch_row($result3);

                $id = $row['id']; 

                echo <<< HTML
                <td>>f</td>
                HTML;
            }
        }
    
    
    ?>


    

            <?php

               //require '../../config/config.php';

                //$con=openCon();

                

                /*if (isset($_GET['email']))
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

                }*/
                
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