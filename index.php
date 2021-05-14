<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SORIS Help Desk</title>
    <link rel="stylesheet" href="css/style.css">

    <link href="http://fonts.cdnfonts.com/css/sitara" rel="stylesheet">

</head>
<!-- style="font-family: 'Sitara', sans-serif;"-->

<body>
    <?php

    $page = "home";
    require 'config/config.php';
    include("res/templates/header.php");
    include("res/templates/navigation.php");

   $_SESSION["role"] = "administrator";
    $_SESSION["userid"] = "IT20633790@gmail.com";

    ?>

    <div class="body-container">
        <!-- adding welcome message-->
        <div class="card" style="width:60%;margin-left:200px;padding:50px">
            <h1 style="text-align:center;font-family: 'Sitara', sans-serif;"> Welcome to Soris Help Desk </h1>
            <p style="font-family: 'Sitara', sans-serif;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam in tempus urna, eu faucibus risus. Ut pharetra non ex eu fermentum.
                Vestibulum in luctus leo, eu vestibulum lorem. Quisque rhoncus </p>
        </div>
        <!--adding icons to news, information and make a inquiry-->

        <table>
            <tr>
                <td>
                    <div class="card">
                        <svg width="84" height="84" viewBox="0 0 84 84" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M59.2435 59.3833C58.7263 59.0478 58.0973 58.9307 57.4939 59.0575C56.8906 59.1843 56.362 59.5447 56.0235 60.06C52.7335 65.1 46.6902 71.2833 41.3002 73.36C35.9102 75.4367 31.6868 74.69 30.0068 73.36C29.2835 72.73 27.3935 71.0267 29.0035 65.2167C30.0768 61.3433 36.7502 43.0967 38.3368 38.6633L33.2502 39.3167C31.6402 43.6567 25.5735 59.9433 24.4768 64.0033C22.8902 69.8133 23.6835 74.0367 27.0202 76.9767C29.3516 78.6124 32.1542 79.44 35.0002 79.3333C37.7617 79.2935 40.4916 78.7396 43.0502 77.7C49.5602 75.1567 56.3968 68.0867 59.9902 62.6033C60.1531 62.343 60.263 62.0531 60.3137 61.7502C60.3643 61.4474 60.3547 61.1375 60.2853 60.8383C60.216 60.5392 60.0882 60.2567 59.9094 60.007C59.7307 59.7573 59.5044 59.5454 59.2435 59.3833Z" fill="#08A73A" />
                            <path d="M45.0332 25.6668C47.1099 25.6668 49.14 25.0509 50.8667 23.8972C52.5934 22.7434 53.9392 21.1036 54.7339 19.1849C55.5287 17.2663 55.7366 15.1551 55.3315 13.1183C54.9263 11.0815 53.9263 9.21058 52.4578 7.74213C50.9894 6.27368 49.1185 5.27365 47.0817 4.86851C45.0449 4.46336 42.9337 4.6713 41.015 5.46602C39.0964 6.26074 37.4565 7.60655 36.3028 9.33327C35.149 11.06 34.5332 13.09 34.5332 15.1668C34.5332 17.9515 35.6394 20.6222 37.6086 22.5914C39.5777 24.5605 42.2484 25.6668 45.0332 25.6668ZM45.0332 9.33342C46.1869 9.33342 47.3147 9.67554 48.274 10.3165C49.2333 10.9575 49.981 11.8685 50.4225 12.9344C50.864 14.0003 50.9795 15.1732 50.7545 16.3048C50.5294 17.4363 49.9738 18.4757 49.158 19.2915C48.3422 20.1073 47.3028 20.6629 46.1712 20.888C45.0397 21.1131 43.8668 20.9976 42.8009 20.5561C41.735 20.1145 40.8239 19.3669 40.183 18.4076C39.542 17.4483 39.1999 16.3205 39.1999 15.1668C39.1999 13.6197 39.8144 12.1359 40.9084 11.042C42.0024 9.948 43.4861 9.33342 45.0332 9.33342Z" fill="#08A73A" />
                            <path d="M27.5568 34.9999C27.6968 34.9999 42.1868 33.0866 45.5935 32.6666C47.1101 32.4333 48.2535 32.6666 48.6268 33.0166C49.0001 33.3666 49.1168 34.8833 48.4635 36.9366C47.0401 41.2766 39.8535 62.6033 37.7535 68.9266C38.7799 68.716 39.7868 68.4194 40.7635 68.0399C41.6976 67.6536 42.5956 67.1851 43.4468 66.6399C46.3168 58.3333 51.6835 42.2333 52.8968 38.5466C54.1101 34.8599 53.8068 32.0599 52.1968 30.1466C51.2783 29.2154 50.1287 28.5452 48.8658 28.2049C47.6029 27.8646 46.2722 27.8663 45.0101 28.2099C41.6735 28.5599 27.5801 30.4033 26.9735 30.5433C26.3546 30.6237 25.7931 30.9467 25.4124 31.4412C25.0317 31.9356 24.863 32.5611 24.9435 33.1799C25.0239 33.7988 25.3469 34.3603 25.8414 34.741C26.3358 35.1217 26.9613 35.2904 27.5801 35.2099L27.5568 34.9999Z" fill="#08A73A" />
                        </svg>

                        <a href="#information" style="font-family: 'Sitara', sans-serif;">Information</a>
                    </div>
                </td>
                <td>
                    <div class="card">
                        <svg width="74" height="62" viewBox="0 0 74 62" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M63.8752 61.7142H10.1252C7.5755 61.7144 5.12238 60.7389 3.26907 58.9878C1.41576 57.2367 0.302777 54.8428 0.158424 52.2972L0.143066 51.7321V7.19636C0.142851 5.44526 0.807402 3.75937 2.00242 2.4794C3.19743 1.19944 4.83378 0.420855 6.58078 0.301002L7.05378 0.285645H54.6609C56.412 0.285429 58.0979 0.94998 59.3779 2.14499C60.6578 3.34 61.4364 4.97636 61.5563 6.72336L61.5716 7.19636V9.49993H66.9466C68.6977 9.49971 70.3836 10.1643 71.6636 11.3593C72.9436 12.5543 73.7221 14.1906 73.842 15.9376L73.8574 16.4106V51.7321C73.8575 54.2818 72.882 56.7349 71.1309 58.5882C69.3799 60.4415 66.986 61.5545 64.4404 61.6989L63.8752 61.7142H10.1252H63.8752ZM10.1252 57.1071H63.8752C65.2246 57.107 66.5247 56.5993 67.517 55.6849C68.5094 54.7704 69.1215 53.5162 69.2318 52.1713L69.2502 51.7321V16.4106C69.2502 15.854 69.0486 15.3162 68.6827 14.8966C68.3168 14.4771 67.8114 14.2043 67.2599 14.1286L66.9466 14.1071H61.5716V47.1249C61.5716 47.6816 61.37 48.2194 61.0041 48.6389C60.6383 49.0585 60.1328 49.3313 59.5813 49.407L59.2681 49.4285C58.7114 49.4285 58.1736 49.2269 57.7541 48.861C57.3345 48.4951 57.0617 47.9897 56.986 47.4382L56.9645 47.1249V7.19636C56.9645 6.6397 56.7629 6.10188 56.397 5.68236C56.0311 5.26284 55.5257 4.98999 54.9742 4.91429L54.6609 4.89279H7.05378C6.49712 4.89281 5.9593 5.0944 5.53978 5.46029C5.12026 5.82617 4.84741 6.33159 4.77171 6.88307L4.75021 7.19636V51.7321C4.75026 53.081 5.25752 54.3806 6.1713 55.3729C7.08507 56.3652 8.33856 56.9776 9.68292 57.0886L10.1252 57.1071H63.8752H10.1252ZM25.4701 27.9408C27.5894 27.9408 29.3094 29.6608 29.3094 31.7801V42.5178C29.3094 44.6371 27.5894 46.3571 25.4701 46.3571H14.7324C12.6131 46.3571 10.8931 44.6371 10.8931 42.5178V31.7801C10.8931 29.6608 12.6131 27.9408 14.7324 27.9408H25.4701ZM37.7681 41.7499H48.5058C49.0894 41.7501 49.6512 41.9718 50.0777 42.3703C50.5042 42.7687 50.7635 43.3142 50.8033 43.8965C50.8431 44.4788 50.6603 45.0545 50.292 45.5072C49.9237 45.96 49.3973 46.256 48.8191 46.3356L48.5058 46.3571H37.7681C37.1844 46.3569 36.6226 46.1352 36.1961 45.7367C35.7697 45.3383 35.5103 44.7928 35.4706 44.2105C35.4308 43.6282 35.6135 43.0525 35.9818 42.5998C36.3501 42.147 36.8766 41.851 37.4548 41.7714L37.7681 41.7499H48.5058H37.7681ZM24.7053 32.5479H15.5002V41.7499H24.7053V32.5479ZM37.7681 27.9408H48.5058C49.0894 27.941 49.6512 28.1627 50.0777 28.5611C50.5042 28.9596 50.7635 29.5051 50.8033 30.0873C50.8431 30.6696 50.6603 31.2453 50.292 31.6981C49.9237 32.1508 49.3973 32.4469 48.8191 32.5264L48.5058 32.5479H37.7681C37.1803 32.5539 36.6124 32.3349 36.1808 31.9359C35.7492 31.5368 35.4865 30.9878 35.4464 30.4014C35.4064 29.8149 35.5921 29.2353 35.9654 28.7813C36.3388 28.3273 36.8716 28.0332 37.4548 27.9592L37.7681 27.9408H48.5058H37.7681ZM13.1844 14.0979H48.5058C49.0894 14.098 49.6512 14.3198 50.0777 14.7182C50.5042 15.1167 50.7635 15.6621 50.8033 16.2444C50.8431 16.8267 50.6603 17.4024 50.292 17.8551C49.9237 18.3079 49.3973 18.6039 48.8191 18.6835L48.5058 18.705H13.1844C12.601 18.7041 12.0397 18.4818 11.6138 18.0831C11.1879 17.6844 10.9292 17.139 10.8898 16.5569C10.8504 15.9749 11.0333 15.3995 11.4017 14.9471C11.77 14.4947 12.2962 14.1989 12.8741 14.1194L13.1844 14.0979H48.5058H13.1844Z" fill="#08A73A" />
                        </svg>

                        <a href="#NEWS" style="font-family: 'Sitara', sans-serif;">NEWS</a>
                    </div>
                </td>
                <td>
                    <div class="card">
                        <svg width="68" height="68" viewBox="0 0 68 68" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M66.9342 1.06568C66.5546 0.687885 66.0751 0.426314 65.5519 0.311722C65.0288 0.19713 64.4838 0.23428 63.9811 0.418804L2.10607 22.9188C1.57245 23.1212 1.11303 23.4812 0.788838 23.9509C0.464644 24.4206 0.291016 24.9778 0.291016 25.5485C0.291016 26.1192 0.464644 26.6764 0.788838 27.1461C1.11303 27.6158 1.57245 27.9758 2.10607 28.1782L26.2654 37.8251L44.0967 19.9376L48.0623 23.9032L30.1467 41.8188L39.8217 65.9782C40.0301 66.5015 40.3909 66.9502 40.8572 67.2661C41.3236 67.582 41.874 67.7506 42.4373 67.7501C43.0057 67.7384 43.5572 67.5548 44.0191 67.2234C44.481 66.892 44.8317 66.4285 45.0248 65.8938L67.5248 4.0188C67.7164 3.52121 67.7627 2.97939 67.6581 2.45653C67.5535 1.93366 67.3025 1.4513 66.9342 1.06568Z" fill="#08A73A" />
                        </svg>

                        <a href="#new inquiry" style="font-family: 'Sitara', sans-serif;"> Make a Inquiry</a>
                    </div>
                </td>
            </tr>
        </table>
        <hr style="border-top: 3px solid #1D4354; color:#1D4354">
        <!-- adding latest NEWS to homepage-->
        <h3 style="margin-left:10vw;"> NEWS </h3><br>

        <?php

        $conn = opencon();
        $sql = "SELECT u.firstName,u.lastName,c.id ,c.title,c.thumbnailText,c.authorid,c.tag FROM users u ,content c WHERE c.authorid = u.id AND c.tag = 'NEWS' ";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr>";
        }

        $i = 1;
        while ($row = $result->fetch_assoc()) {
            
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
            if($i>7)
            {
                break;
            }
        }

        echo "</table>";

        ?>
        <hr style="border-top: 3px solid #1D4354; color:#1D4354">
        <!-- adding latest information to homepage-->
        <h3 style="margin-left:10vw;"> Information </h3><br>

        <?php

        $sql = "SELECT u.firstName,u.lastName,c.id ,c.title,c.thumbnailText,c.authorid,c.tag FROM users u ,content c WHERE c.authorid = u.id AND c.tag = 'Information' ";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr>";
        }

        $i = 1;
        while ($row = $result->fetch_assoc()) {
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
                if ($i>6)
                {
                   break;
                }
        }

        echo "</table>";

        ?>







    </div>

    <?php include("res/templates/footer.php");  ?>
    <script src="js/script.js"></script>
</body>

</html>
