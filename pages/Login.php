<!DOCTYPE html>
<html>

<head>
    <title>Frontend Page</title>
    <link href="https://fonts.googleapis.com/css?family=Noto+Serif&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/main.css">

</head>

<body>
    <div>
        <h1 class="header">Hello to AJ's Health tracker</h1>

        <a href="patientLogin.html" class="button"><img src="./css/images/icons8-patient-100.png" alt="" class="icon1">
            Patient</a>

        <a href="doctorLogin.html" class="button"><img src="./css/images/icons8-doctor-80.png" alt=""
                class="icon">Doctor</a>

        <div class="login-message">

            <span>If you don't have an account, </span>
            <a href="signup.php" class="signup-link">Sign up</a>
            <span> (Only for patients!)</span>

        </div>
    </div>
</body>

</html>

<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "healthtracker";
$con = mysqli_connect($dbhost, $dbuser, $dbpass)
    or die('Cannot connect to the server');
mysqli_select_db($con, $dbname)
    or die('DB selection problem');
?>