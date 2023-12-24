<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: doctorLogin.html");
    exit();
}
require_once 'Login.php';

$user = $_SESSION['email'];




// Fetch all doctors' information
$query = "SELECT * FROM doctor WHERE email='$user'";
$result = mysqli_query($con, $query);



if (!$result) {
    die('Error in the query: ' . mysqli_error($con));
}

?>
