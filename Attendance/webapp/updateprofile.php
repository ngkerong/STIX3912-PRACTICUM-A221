<?php
    session_start();
    if (!isset($_SESSION['sessionid'])) {
        echo "<script>alert('Session not available. Please Login First'); </script>";
        echo "<script> window.location.replace('login.php')</script>";
    }

    if (isset($_SESSION["icno"])) {
        include_once("dbconnect.php");
        $icno = $_SESSION["icno"];
        $sqlstaff = "SELECT * FROM tbl_staff WHERE icno = '$icno'";
        $stmt = $conn->prepare($sqlstaff);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rows = $stmt->fetchAll();
        foreach ($rows as $staff) {
            $name = $staff['name'];
            $icno = $staff['icno'];
            $pemail = $staff['pemail'];
            $cemail = $staff['cemail'];
            $phone = $staff['phone'];
            $address = $staff['address'];
        }
    }

    if (isset($_POST['submit'])) {
        include_once("dbconnect.php");
        $name = $_POST["name"];
        $icno = $_POST["icno"];
        $pemail = $_POST["pemail"];
        $cemail = $_POST["cemail"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        $sqlupdatestaff = "UPDATE tbl_staff SET name = '$name' , pemail = '$pemail' , cemail = '$cemail' , phone = '$phone', address = '$address' WHERE icno = '$icno'";
        $sqlattendance = "UPDATE tbl_attendance SET name = '$name' WHERE icno = '$icno'";

        try {
            $conn->exec($sqlupdatestaff);
            $conn->exec($sqlattendance);
            if($icno == $_SESSION["icno"]){
                $_SESSION["name"] = $name = $_POST["name"];
            }
            if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {
                uploadImage($icno);
            }
            echo "<script>alert('Update Success')</script>";
            echo "<script>window.location.replace('profile.php')</script>";
        } catch (PDOException $e) {
            echo "<script>alert('Update Failed')</script>";
        }
    }


function uploadImage($icno) {
    $target_dir = "image/staff/";
    $target_file = $target_dir . $icno . ".png";
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
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
            <P style="font-size:calc(8px + 1vw);;">Everyday is AWESOME</P>
        </div>
            
        <div class="w3-container w3-padding-64 form-container-reg">
            <div class = "w3-card">
                <div class = "w3-container w3-blue-grey">
                    <p><b>Edit Profile</b></p>
                </div>

                <form class = "w3-container w3-padding" name="updateForm" action = "updateprofile.php" method = "post" onsubmit = "return confirmDialog3()" enctype = "multipart/form-data">
                    <p>
                        <div class = "w3-container w3-border w3-center w3-padding">
                            <img class = "w3-image w3-margin" src = "image/staff/<?php echo $icno; ?>.png" style = "width:50%; max-width:300px" onerror = this.onerror = null; this.src = "images/user.png"><br>
                            <input type = "file" onchange = "previewFile()" name = "fileToUpload" id = "fileToUpload"><br>
                        </div>
                    </p>

                    <p>
                        <label class="w3-text-black"><b>IC Number</b></label><br>
                        <input class="w3-input w3-border w3-round" name = "icno" id = "idicno" type = "text" value = "<?php echo $icno; ?>" readonly = "readonly" required>
                    </p>

                    <p>
                        <label class="w3-text-black"><b>Name</b></label><br>
                        <input class="w3-input w3-border w3-round" name = "name" id = "idname" type = "text" value = "<?php echo $name; ?>" required>
                    </p>

                    <p>
                        <label class="w3-text-black"><b>Personal Email</b></label><br>
                        <input class="w3-input w3-border w3-round" name = "pemail" id = "idpemail" type = "email" value = "<?php echo $pemail; ?>" required>
                    </p>

                    <p>
                        <label class="w3-text-black"><b>Company Email</b></label><br>
                        <input class="w3-input w3-border w3-round" name = "cemail" id = "idcemail" type = "email" pattern=".+@otc.com" value = "<?php echo $cemail; ?>" required>
                    </p>
                    
                    <p>
                        <label class="w3-text-black"><b>Phone</b></label><br>
                        <input class="w3-input w3-border w3-round" name = "phone" id = "idphone" type = "phone" value = "<?php echo $phone; ?>" required>
                    </p>

                    <p>
                        <label class="w3-text-black"><b>Address</b></label>
                        <textarea class="w3-input w3-border" id = "idaddress" name = "address" rows = "4" cols = "50" width = "100%" placeholder = "Enter the address" required><?php echo $address; ?></textarea>
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