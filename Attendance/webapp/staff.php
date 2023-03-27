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
    $sqlstaff = "SELECT * FROM tbl_staff ORDER BY status, type, depart, name";
    $stmt = $conn->prepare($sqlstaff);
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

        <div class="w3-bar w3-left-align w3-white">
        <a href="addstaff.php" class="w3-bar-item w3-button w3-left "><i class="fa fa-user-plus" style="font-size:15px w3-theme-d2"></i><B>&nbsp; Add New Staff</B></a>
        </div>

        <div class = "w3-grid-template">
            <?php
                foreach ($rows as $staff) {
                    $icno = $staff["icno"];
                    $name = $staff["name"];
                    $depart = $staff["depart"];
                    $type = $staff["type"];
                    $status = $staff["status"];
                    echo "<div class = 'w3-center w3-padding'>";
                    echo "<div class = 'w3-card-4'>";
                    echo "<header class = 'w3-container w3-blue-grey'>";
                    echo "<h5><b>$name</b></h5>";
                    echo "</header>";
                    echo "<img class = 'w3-image w3-margin' src = 'image/staff/$icno.png'" . " onerror = this.onerror = null; this.src = 'images/user.png'" . " style = 'width:50%; height:150px;'>";
                    echo "<div class = 'w3-container w3-left-align w3-grey'><hr>";
                    echo "<p style = 'color:white;'><b>Department: </b>&nbsp$depart<br><br><b>Type: </b>&nbsp$type<br><br><b>Status: </b>&nbsp$status<br></p><hr>";
                    echo "<table class = 'w3-table'><tr>
                          <td class='w3-center'><a href = 'staffProfile.php?icno=$icno' class='w3-margin' title='View Staff'><i class = 'fa fa-vcard-o' style = 'font-size:64pax' style = 'text-decoration:none'></i></a></td>
                          <td class='w3-center'><a href = 'viewUpdateStaff.php?icno=$icno' class='w3-margin' title='Edit Staff'><i class = 'fa fa-edit' style = 'font-size:64pax' style = 'text-decoration:none'></i></a></td>
                          <td class='w3-center'><a href = 'updatestaffpass.php?icno=$icno' class='w3-margin' title='Charge Password'><i class = 'fa fa-key' style = 'font-size:64pax' style = 'text-decoration:none'></i></a></td>
                          </tr></table>"; 
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            ?>
        </div>

        <footer class="w3-container w3-center w3-blue-grey">
            <p>Copyright by OTC</p>
        </footer>
    </body>

</html>
