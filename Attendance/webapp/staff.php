<?php
    session_start();
    if (!isset($_SESSION['sessionid'])) {
        echo "<script>alert('Session not available. Please Login First'); </script>";
        echo "<script> window.location.replace('login.php')</script>";
    }

    if($_SESSION["type"] != "admin"){
        echo "<script>alert('Session not available. Only admin enter.'); </script>";
        echo "<script> window.history.back()</script>";
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="function/script.js"></script>
        <title>Attendance</title>
    </head>

    <body>

        <div>
            <?php
                if ($_SESSION["type"] == "admin"){
                    include 'nav.php';
                }
            ?>
        </div>
        
        <div class="w3-header w3-container w3-grey w3-padding-32 w3-center">
            <h1 style="font-size:calc(8px + 4vw);">Attendance</h1>
            <P style="font-size:calc(8px + 1vw);;">Everyday is AWESOME</P>
        </div>

        <div class="w3-bar w3-left-align w3-white">
        <a href="addstaff.php" class="w3-bar-item w3-button w3-left "><i class="fa fa-user-plus" style="font-size:15px w3-theme-d2"></i><B>&nbsp; Add New Staff</B></a>
        </div>
        
        <footer class="w3-container w3-center w3-blue-grey">
            <p>Copyright by OTC</p>
        </footer>
    </body>

</html>