<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "healthtracker";
$con = mysqli_connect($dbhost, $dbuser, $dbpass)
    or die('Cannot connect to the server');

mysqli_select_db($con, $dbname)
    or die('DB selection problem');

error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: doctor.php");
    exit();
}


$user = $_SESSION['email'];
$fullname = $_POST['fullname'];



// Fetch all doctors' information
$query = "UPDATE doctor set fullname = '$fullname' where email = '$user' ";
$result = mysqli_query($con, $query);



if (!$result) {
    die('Error in the query: ' . mysqli_error($con));
}

$nbrows = mysqli_affected_rows($con);

if ($nbrows == 1) {
    header("Location: doctor.php");
    exit(); // Redirect to the doctor.php page on success 
} else {
    echo "No rows were updated.";
}

mysqli_close($con);

?>