<?php
    session_start();
    if (!isset($_SESSION['sessionid'])) {
        echo "<script>alert('Session not available. Please Login First'); </script>";
        echo "<script> window.location.replace('login.php')</script>";
    }

    if($_SESSION["type"] != "Admin"){
        echo "<script>alert('Session not available. Only admin enter.'); </script>";
        echo "<script> window.history.back()</script>";
    }

    include_once("dbconnect.php");
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $date = date('Y-m-d');
    $sqlattendance = "SELECT * FROM tbl_attendance ORDER BY date DESC, checkIn DESC";
    $stmt = $conn->prepare($sqlattendance);
    $stmt -> execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $rows = $stmt->fetchAll();
    

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
                }
            ?>
        </div>
        
        <div class="w3-header w3-container w3-grey w3-padding-32 w3-center">
            <h1 style="font-size:calc(8px + 4vw);">Attendance</h1>
            <P style="font-size:calc(8px + 1vw);;">Everyday is AWESOME</P>
        </div>

        <div class="w3-bar w3-left-align w3-blue-grey">
        <label style="font-size:15px w3-theme-d2">&nbsp&nbsp&nbsp<b>ATTENDANCE</b></label><br>
        </div>

        <div>
            <?php
                echo "<div class = 'w3-margin w3-container w3-card-4'>";
                echo "<font size='2'>";
                echo "<div style = 'overflow-x:auto;'>
                    <table id = 'record' class='w3-table w3-table-all w3-border w3-margin'>";
                echo "<col style = 'width:3%'>
                    <col style = 'width:3%'>
                    <col style = 'width:5%'>
                    <col style = 'width:10%'>
                    <col style = 'width:5%'>
                    <col style = 'width:5%'>
                    <col style = 'width:5%'>
                    <col style = 'width:5%'>";
                echo "<tr>
                        <th>No</th>
                        <th>Date</th>
                        <th>IcNo</th>
                        <th>Name</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                     </tr>";
                $num = 1;
                foreach ($rows as $attendance) {
                    $date = $attendance['date'];
                    $icno = $attendance['icno'];
                    $name = $attendance['name'];
                    $checkIn = date_format(date_create($attendance['checkIn']), "H:i:s");
                    $checkOut = date_format(date_create($attendance['checkOut']), "H:i:s");
                    $latt = $attendance['latt'];
                    $longtt = $attendance['longtt'];
                    echo "<tr>
                            <td>" . $num . "</td>
                            <td>" . $date . "</td>
                            <td>" . $icno . "</td>
                            <td>" . $name . "</td>
                            <td>" . $checkIn . "</td>
                            <td>" . $checkOut . "</td>
                            <td>" . $latt . "</td>
                            <td>" . $longtt . "</td>
                        </tr>";
                    $num++;
                }
                echo "</table></div></font></div>"
            ?>
        </div>

        <footer class="w3-container w3-center w3-blue-grey">
            <p>Copyright by OTC</p>
        </footer>
    </body>

</html>