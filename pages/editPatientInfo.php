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




if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $Pid = isset($_POST['Pid']) ? $_POST['Pid'] : '';
    $history = isset($_POST['history']) ? $_POST['history'] : '';
    $medicine = isset($_POST['medicine']) ? $_POST['medicine'] : '';
    $allergies = isset($_POST['allergies']) ? $_POST['allergies'] : '';
    $weight = isset($_POST['weight']) ? $_POST['weight'] : '';
    $doctor = isset($_POST['doctor']) ? $_POST['doctor'] : '';

    // Construct the SQL query based on the filled fields
    $sql = "UPDATE patient SET ";
    $updateFields = [];


    if (!empty($history)) {
        $updateFields[] = "history='$history'";
    }

    if (!empty($medicine)) {
        $updateFields[] = "medicine='$medicine'";
    }

    if (!empty($allergies)) {
        $updateFields[] = "allergies='$allergies'";
    }

    if (!empty($weight)) {
        $updateFields[] = "weight='$weight'";
    }

    if (!empty($doctor)) {
        $updateFields[] = "doctor='$doctor'";
    }


    $sql .= implode(", ", $updateFields);


    $sql .= " where Pid = '$Pid';";


    mysqli_query($con, $sql);


    if (mysqli_error($con)) {
        die('Error in the query: ' . mysqli_error($con));
    }
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