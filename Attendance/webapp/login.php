<?php
    if (isset($_POST["submit"])){
        include 'dbconnect.php';
        $email = $_POST["email"];
        $password = sha1($_POST["password"]);
        $stmt = $conn->prepare("SELECT * FROM register_user WHERE email = '$email' AND password = '$password'");
        $stmt->execute();
        $number_of_rows = $stmt->fetchColumn();

        if($number_of_rows > 0){
            echo "<script>alert('Login Success'); </script>";
            echo "<script> window.location.replace('index.html')</script>";
        }else {
            echo "<script>alert('Login Failure');</script>";
            echo "<script> window.location.replace('login.php')</script>";
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
        <title>Login</title>
    </head>

    <body>
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
                        <input class="w3-input w3-border w3-round" type="password" name="password" id="idpassword" required>
                    </p>
                    
                    <p>
                        <input class="w3-check" type="checkbox" id="idremember">
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
