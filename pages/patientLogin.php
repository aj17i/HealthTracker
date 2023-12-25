<?php
require_once 'Login.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from the form
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $pass = mysqli_real_escape_string($con, $_POST['password']);

    // Query to check if the user exists
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

// Close the database connection
mysqli_close($con);
?>
