<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/style.css">

<link href="http://fonts.cdnfonts.com/css/sitara" rel="stylesheet">

</head>
<body>

<?php


$page = "student login";
require '../../config/config.php';
include("../templates/header.php");
include("../templates/navigation.php");
?>
  <div class="body-container">
  <form  method="POST">

<div class="card" style ="margin-left:25vw; margin-right:25vw; padding-left:30px" >

<h1 style = "text-align:center;"> Staff/Adminstrator signIn </h1>
<br>

Email <input class="txt-input" type ="text" oninput="validateEmail(this)" style="margin-left:40px;">
<br>
Password <input   class="txt-input" type="password" style="margin-left: 18px;">
<br><br><br>


<button style="margin-right: 100px"  class="btt type3" >Forget password</button>
<input  type="button" value="Login" class ="btt type1" name="Login">

<br><br><br>

</div>

</form>
  </div>

<script>

    function validateEmail(email)
{
    var  design= /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/;
    var input = email.value;

    if(input.match(design))
    {
        email.style.border = "3px solid #1D4354";
        return true;
    }
    else
    {
        email.style.border = "3px solid #ff0000";
        return false;
    }
}
    </script>

<?php include("../templates/footer.php");  ?>
    <script src="../../js/script.js"></script>
</body>
</html>