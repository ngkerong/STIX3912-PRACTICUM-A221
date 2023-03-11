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
        <div id="type" style="display: none;">
    </div>

        <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
            <a href="#" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>HOME</a>
            <a href="login.php?status=logout" class="w3-bar-item w3-button w3-hide-small w3-right" onclick="logout()"><i class="fa fa-sign-out" style="font-size:20px"></i></a>
            <a href="#" class="w3-bar-item w3-button w3-hide-small w3-right" title="Profile"><i class="fa fa-user" style="font-size:20px"></i></a>
            <a href="#" class="w3-bar-item w3-button w3-hide-small w3-right" title="Leave Form"><i class="fa fa-envelope" style="font-size:20px"></i></a>
            <a href="#" class="w3-bar-item w3-button w3-hide-small w3-right" title="Attendance"><i class="fa fa-id-badge" style="font-size:20px"></i></a>
            <a href="staff.php" class="w3-bar-item w3-button w3-hide-small w3-right" title="Staff Records" id = "idtype"><i class="fa fa-id-card" style="font-size:20px"></i></a>          
            <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="navFunction()">&#9776;</a>
        </div>

        <div id="idnavbar" class="w3-bar-block w3-blue-grey w3-hide w3-hide-large w3-hide-medium" >
            <a href="staff.php" class="w3-bar-item w3-button w3-margin-right" title="Staff Records"><i class="fa fa-id-card" style="font-size:15px"></i>&nbsp; Staff Record</a>
            <a href="#" class="w3-bar-item w3-button w3-margin-right" title="Attendance"><i class="fa fa-id-badge" style="font-size:15px"></i>&nbsp; Attendance</a>
            <a href="#" class="w3-bar-item w3-button w3-margin-right" title="Leave Form"><i class="fa fa-envelope" style="font-size:15px"></i>&nbsp; Leave Form</a>
            <a href="#" class="w3-bar-item w3-button w3-margin-right" title="Profile"><i class="fa fa-user" style="font-size:15px"></i>&nbsp; Profile</a>
            <a href="login.php?status=logout" class="w3-bar-item w3-button w3-margin-right" onclick="logout()"><i class="fa fa-sign-out" style="font-size:15px"></i>&nbsp; Logout</a>
        </div>
    </body>
</html>