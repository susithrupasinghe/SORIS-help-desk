<?php 
session_start();
if(isset($_SESSION["role"]) && isset($_SESSION["userid"]) ){

    if($_SESSION["role"] != "student"){


        header("Location: ../../index/");
        
        $_COOKIE["stdid"] = "IT2063379000";
                        
        echo $_COOKIE["stdid"];

    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>