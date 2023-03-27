<?php
    session_start();
    if (!isset($_SESSION['sessionid'])) {
        echo "<script>alert('Session not available. Please Login First'); </script>";
        echo "<script> window.location.replace('login.php')</script>";
    }

    include_once("dbconnect.php");
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $icno = $_SESSION["icno"];
    $date = date('Y-m-d');
    $sqlattendance = "SELECT * FROM tbl_attendance WHERE icno = '$icno' AND date = '$date'";
    $stmt = $conn->prepare($sqlattendance);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $rows = $stmt->fetchAll();

    foreach ($rows as $attendance) {
        $checkIn = date_format(date_create($attendance['checkIn']), "H:i:s");
        $checkOut = date_format(date_create($attendance['checkOut']), "H:i:s");
    }

    if (isset($_POST["checkIn"])) {
        include_once("dbconnect.php");
        $name = $_SESSION["name"];
        $icno = $_SESSION["icno"];
        $latt = $_POST["latt"];
        $longtt = $_POST["longtt"];
        $sqlattendance = "INSERT INTO `tbl_attendance`(`name`, `icno`, `date`, `checkIn`, `latt`, `longtt`, `status`) VALUES('$name', '$icno', now(), now(), '$latt', '$longtt', 'active')";

        try {
            $conn->exec($sqlattendance);
            echo "<script>alert('Check In Success')</script>";
            echo "<script>window.location.replace('index.php')</script>";
        } catch (PDOException $e) {
            echo "<script>alert('Check In Failed')</script>";
        }
    }

    if (isset($_POST['checkOut'])) {
        include_once("dbconnect.php");
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $icno = $_SESSION["icno"];
        $date = date('Y-m-d');
        $sqlattendance = "UPDATE tbl_attendance SET checkOut = now() WHERE icno = '$icno' AND date = '$date'";

        try {
            $conn->exec($sqlattendance);
            echo "<script>alert('Check Out Success')</script>";
            echo "<script>window.location.replace('index.php')</script>";
        } catch (PDOException $e) {
            echo "<script>alert('Check Out Failed')</script>";
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
        <script>

            function start(){
                startTime();
                getLocation();
            }

            function startTime() {
                const today = new Date();
                let h = today.getHours();
                let m = today.getMinutes();
                let s = today.getSeconds();
                m = checkTime(m);
                s = checkTime(s);
                document.getElementById('txt').innerHTML =  h + ":" + m + ":" + s;
                setTimeout(startTime, 1000);
            }

            function checkTime(i) {
                if (i < 10) {i = "0" + i};  
                return i;
            }

            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else { 
                    document.getElementById("demo1").innerHTML = "Geolocation is not supported by this browser.";
                    document.getElementById("demo2").innerHTML = "Geolocation is not supported by this browser.";
                }
            }

            function showPosition(position) {
                document.getElementById("demo1").value = position.coords.latitude; 
                document.getElementById("demo2").value = position.coords.longitude;
            }

        </script>
        <title>Attendance</title>
    </head>

    <body onload= "start()">

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
            <P style="font-size:calc(8px + 1vw);;">Everyday is AWESOME</P>
        </div>

        ​<div class="w3-padding clock" id="txt"></div>

        <div class="w3-container w3-padding-64 form-container" >
            <div class="w3-card-4 w3-round">
                <div class="w3-container w3-blue-grey">
                    <h2><b>Daily Attendance</b></h2>
                </div>

                <form name="checkForm" class="w3-container" action="index.php" method="post" enctype = "multipart/form-data">

                    <p hidden>
                        <label type="icno" name="icno" id="idicno" value = "<?php echo $_SESSION["icno"]; ?>"></label>
                        <input id="demo1" type = "latt" name = "latt" value = "latt"></input>
                        <input id="demo2" type = "longtt" name = "longtt" value = "longtt"></input>
                    </p>

                    <p style="font-size:20px">
                        <label class="w3-text-black" type="name" name="name" id="idname" value = "<?php echo $_SESSION["name"]; ?>">Hello? <b><?php echo $_SESSION["name"]; ?></b></label>
                    </p>

                    
                    <p style="font-size:20px">
                       <?php 
                            if (!isset($checkIn) && !isset($checkOut)) {
                                echo "Please check in before the working hour.";
                            }else if(isset($checkIn) && $checkOut == "00:00:00"){
                                echo "Thank you for checking in today. Please check out after the office hour";
                            }else if(isset($checkIn) && $checkOut != "00:00:00"){
                                echo "Thank you for checking out today. Enjoy yout rest";
                            }

                        ?>
                    </p>

                    <p>
                        <?php
                            if (!isset($checkIn) && !isset($checkOut)) {
                                echo "<button class='w3-btn w3-round w3-light-grey w3-block' name='checkIn'>Check In</button>";
                            }else if (isset($checkIn) && $checkOut == "00:00:00"){
                                echo "<button class='w3-btn w3-round w3-light-grey w3-block' name='checkOut'>Check Out</button>";
                            }else if(isset($checkIn) && $checkOut != "00:00:00"){
                                echo "Done";
                            }
                        ?>
                    </p>   
                </form> 
            </div>    
        </div>

        
        <footer class="w3-container w3-center w3-blue-grey">
            <p>Copyright by OTC</p>
        </footer>
    </body>

</html>
