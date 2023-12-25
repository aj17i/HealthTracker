<?php
require_once 'Login.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from the form
    $Pid = mysqli_real_escape_string($con, $_POST['Pid']);
    $pass = mysqli_real_escape_string($con, $_POST['password']);

    // Query to check if the user exists
    $query = "SELECT * FROM patient WHERE Pid='$Pid' AND password='$pass'";
    $result = mysqli_query($con, $query);

    if (!$result) {
        die('Error in the query: ' . mysqli_error($con));
    }

    $nbrows = mysqli_num_rows($result);

    if ($nbrows == 1) {
        $_SESSION['logged'] = true;
        $_SESSION['Pid'] = $Pid;
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
