<?php 

function openCon(){

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "soris";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  return false;
}
else{
    return $conn;
}

}


function closeCon($con){

    $con->close();

}
