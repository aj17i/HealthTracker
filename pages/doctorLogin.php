<?php
require_once 'Login.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user = mysqli_real_escape_string($con, $_POST['email']);
    $pass = mysqli_real_escape_string($con, $_POST['password']);

    $query = "SELECT * FROM doctor WHERE email='$user' AND password='$pass'";
    $result = mysqli_query($con, $query);

    if (!$result) {
        die('Error in the query: ' . mysqli_error($con));
    }

    $nbrows = mysqli_num_rows($result);

    if ($nbrows == 1) {
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $user;
        header("Location: doctor.php");
        exit();

    } else {
        header("Location: doctorLogin.html");
        exit();
    }
}

// Close the database connection
mysqli_close($con);
?>