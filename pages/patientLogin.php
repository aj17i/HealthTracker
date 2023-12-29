<?php
require_once 'Login.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $pass = mysqli_real_escape_string($con, $_POST['password']);

    $query = "SELECT * FROM patient WHERE email='$email' AND password='$pass'";
    $result = mysqli_query($con, $query);

    if (!$result) {
        die('Error in the query: ' . mysqli_error($con));
    }

    $nbrows = mysqli_num_rows($result);

    if ($nbrows == 1) {
        $_SESSION['logged'] = true;
        $_SESSION['email'] = $email;
        header("Location: patient.php");
        exit();

    } else {
        header("Location: patientLogin.html");
        exit();
    }
}


mysqli_close($con);
?>