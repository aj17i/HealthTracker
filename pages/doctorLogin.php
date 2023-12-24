<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/doctor.css">

</head>

<body>

    <div class="page">
        <div class="container">
            <div class="left">
                <div class="login">Hello Doctor!</div>
                <div class="eula">By logging in you agree to the ridiculously long terms that you didn't bother to read
                </div>
            </div>
            <div class="right">
                <svg viewBox="0 0 320 300">
                    <defs>
                        <linearGradient inkscape:collect="always" id="linearGradient" x1="13" y1="193.49992" x2="307"
                            y2="193.49992" gradientUnits="userSpaceOnUse">
                            <stop style="stop-color:#ff00ff;" offset="0" id="stop876" />
                            <stop style="stop-color:#0044ff;" offset="1" id="stop878" />
                        </linearGradient>
                    </defs>
                    <path
                        d="m 40,120.00016 239.99984,-3.2e-4 c 0,0 24.99263,0.79932 25.00016,35.00016 0.008,34.20084 -25.00016,35 -25.00016,35 h -239.99984 c 0,-0.0205 -25,4.01348 -25,38.5 0,34.48652 25,38.5 25,38.5 h 215 c 0,0 20,-0.99604 20,-25 0,-24.00396 -20,-25 -20,-25 h -190 c 0,0 -20,1.71033 -20,25 0,24.00396 20,25 20,25 h 168.57143" />
                </svg>
                <div class="form">
                    <label for="email">Email</label>
                    <input type="email" id="email">
                    <label for="password">Password</label>
                    <input type="password" id="password">
                    <button type="submit" class="button">Submit</button>
                </div>
            </div>
        </div>
    </div>

</body>


</html>

<?php
require_once 'Login.php';
if (
    isset($_POST['email']) && $_POST['email'] != ""
    && isset($_POST['password']) && $_POST['passwords'] != ""
) {
    $user = $_POST['email'];
    $pass = $_POST['password'];

    $query = "Select * From user where username='$user' and password='$pass'";

    $res = mysqli_query($con, $query);

    $nbrows = mysqli_num_rows($res);
    if ($nbrows == 0) {
        header("Location:login.html");
    } else if ($nbrows == 1) {
        session_start();
        $_SESSION['loggedin'] = 1;
        $_SESSION['user'] = $user;
        header("Location:main.php");
    }
}
?>