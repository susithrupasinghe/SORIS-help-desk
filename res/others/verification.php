<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../../css/style.css">

</head>

<body>

    <?php



    $page = "conversation";
    // require '../../config/config.php';
    include("../templates/header.php");
    include("../templates/navigation.php");



    ?>
    <div class="body-container">
        <div class="alert">
            <span class="closebtn">&times;</span>
            <strong>Danger!</strong> Indicates a dangerous or potentially negative action.
        </div>

        <div class="alert success">
            <span class="closebtn">&times;</span>
            <strong>Success!</strong> Indicates a successful or positive action.
        </div>

        <div class="alert info">
            <span class="closebtn">&times;</span>
            <strong>Info!</strong> Indicates a neutral informative change or action.
        </div>

        <div class="alert warning">
            <span class="closebtn">&times;</span>
            <strong>Warning!</strong> Indicates a warning that might need attention.
        </div>
    </div>


    <?php include("../templates/footer.php");  ?>
    <script src="../../js/script.js"></script>
</body>

</html>