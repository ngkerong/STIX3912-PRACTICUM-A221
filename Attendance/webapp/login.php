<?php
    if (isset($_POST["submit"])){
        include 'dbconnect.php';
        $email = $_POST["email"];
        $password = sha1($_POST["password"]);
        $stmt = $conn->prepare("SELECT * FROM tbl_staff WHERE cemail = '$email' AND password = '$password'");
        $stmt->execute();
        $number_of_rows = $stmt->fetch(PDO::FETCH_ASSOC);
        $updatelogin = "UPDATE tbl_staff SET lastlogin = now()";

        if($number_of_rows > 0 && $number_of_rows['status'] == "active"){
            session_start();
            $_SESSION["sessionid"] = session_id();
            $_SESSION["icno"] = $number_of_rows['icno'];
            $_SESSION["name"] = $number_of_rows['name'];
            $_SESSION["pemail"] = $number_of_rows['pemail'];
            $_SESSION["cemail"] = $number_of_rows['cemail'];
            $_SESSION["phone"] = $number_of_rows['phone'];
            $_SESSION["depart"] = $number_of_rows['depart'];
            $_SESSION["type"] = $number_of_rows['type'];
            $_SESSION["status"] = $number_of_rows['status'];
            $_SESSION["password"] = $number_of_rows['password'];
            $_SESSION["address"] = $number_of_rows['address'];
            $conn->exec($updatelogin);
            echo "<script>alert('Login Success'); </script>";
            echo "<script> window.location.replace('index.php')</script>";
        }else {
            echo "<script>alert('Login Failure');</script>";
        }
    }

    if (isset($_GET["status"])) {
        if (($_GET["status"] == "logout")) {
            session_start();
            session_unset();
            session_destroy();
            echo "<script> alert('Session Cleared')</script>";
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
        <title>Login</title>
    </head>

    <body onload = loadCookies();>
        <div class="w3-header w3-container w3-grey w3-padding-20 w3-center">
                <h1 style="font-size:calc(8px + 4vw);">Attendance</h1>
                <P style="font-size:calc(8px + 1vw);;">Everyday is AWESOME</P>
        </div>

        <div class="w3-container w3-padding-64 form-container">
            <div class="w3-card-4 w3-round">
                <div class="w3-container w3-blue-grey">
                    <h2>Login</h2>
                </div>

                <form name="loginForm" class="w3-container" action="login.php" method="post">
                    <p>
                        <label class="w3-text-black"><b>Useremail</b></label>
                        <input class="w3-input w3-border w3-round" type="email" name="email" id="idemail" required>
                    </p>

                    <p>
                        <label class="w3-text-black"><b>Password</b></label>
                        <input class="w3-input w3-border w3-round" type="password" name="password" id="idpass" required>
                    </p>
                    
                    <p>
                        <input class="w3-check" type="checkbox" id="idremember" onclick="rememberMe()" name = "remember">
                        <label>Remember me</label>
                    </p>

                    <p>
                        <button class="w3-btn w3-round w3-light-grey w3-block" name="submit">Login</button>
                    </p>   
                </form> 
            </div>    
        </div>
        <footer class="w3-container w3-center w3-blue-grey">
            <p>Copyright by OTC</p>
        </footer>
    </body>
</html>
