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


$email = $_SESSION['email'];
$Pid = $_GET['Pid'];




// Fetch all doctors' information
$query = "SELECT * FROM patient WHERE Pid='$Pid'";
$result = mysqli_query($con, $query);



if (!$result) {
    die('Error in the query: ' . mysqli_error($con));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div>";
        echo "<h2>Patient: " . $row['Fullname'] . "</h2>";
        echo "<p>Pid: " . $row['Pid'] . "</p>";
        echo "<p>Email: " . $row['email'] . "</p>";
        echo "<p>History: " . $row['history'] . "</p>";
        echo "<p>Age: " . $row['age'] . "</p>";
        echo "</div>";
    }
    ?>

    <a href="doctor.php">Back</a>
</body>

</html>