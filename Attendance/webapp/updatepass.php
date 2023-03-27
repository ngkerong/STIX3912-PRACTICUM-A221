<?php
    session_start();
    if (!isset($_SESSION['sessionid'])) {
        echo "<script>alert('Session not available. Please Login First'); </script>";
        echo "<script> window.location.replace('login.php')</script>";
    }

    if (isset($_POST['submit'])) {
        if($_POST['pass1'] == $_POST['pass2']){
            include_once("dbconnect.php");
            $icno = $_SESSION["icno"];
            $password = sha1($_POST["pass2"]);
            $sqlupdatestaff = "UPDATE tbl_staff SET password = '$password' WHERE icno = '$icno'";
            $conn->exec($sqlupdatestaff);
            echo "<script>alert('Update Success')</script>";
            echo "<script>window.location.replace('login.php?status=logout')</script>";
        } else {
            echo "<script>alert('Update Failed')</script>";
        }
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
        <link rel="stylesheet" href="style/style.css">
        <script src="function/script.js"></script>
        <title>Attendance</title>
    </head>

    <body>

        <div>
            <?php
                if ($_SESSION["type"] == "Admin"){
                    include 'nav.php';
                }else{
                    include 'staffnav.php';
                }
            ?>
        </div>

        <div class="w3-header w3-container w3-grey w3-padding-32 w3-center">
            <h1 style="font-size:calc(8px + 4vw);">Attendance</h1>
            <P style="font-size:calc(8px + 1vw);">Everyday is AWESOME</P>
        </div>
            
        <div class="w3-container w3-padding-64 form-container-reg">
            <div class = "w3-card">
                <div class = "w3-container w3-blue-grey">
                    <p><b>Update Password</b></p>
                </div>

                <form class = "w3-container w3-padding" name="updatePassForm" action = "updatepass.php" method = "post" onsubmit = "return confirmDialog4()" enctype = "multipart/form-data">
                    
                    <p>
                        <label class="w3-text-black"><b>Enter New Password</b></label><br>
                        <input class="w3-input w3-border w3-round" name = "pass1" id = "idpass1" type = "text" required>
                    </p>

                    <p>
                        <label class="w3-text-black"><b>Re-enter New Password</b></label><br>
                        <input class="w3-input w3-border w3-round" name = "pass2" id = "idpass2" type = "text" required>
                    </p>


                    <p>
                        <div class = "row">
                            <input class="w3-btn w3-round w3-light-grey w3-block" type = "submit" name = "submit" value = "Submit">
                        </div>
                    </p>
                </form>

            </div>
        </div>
        
        <footer class="w3-container w3-center w3-blue-grey">
            <p>Copyright by OTC</p>
        </footer>
    </body>

</html>