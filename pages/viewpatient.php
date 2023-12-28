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
    <link rel="stylesheet" href="./css/view.css">
    <link rel="stylesheet" href="./css/main.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="text">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div>";
                echo "<h2>Patient: " . $row['Fullname'] . "</h2>";
                echo "<div class = ''>";
                echo "<p><span class = 'bold'>Birth Date: </span> <span class = 'display-box'>" . $row['birthd'] . " </span></p>";
                echo "<p><span class = 'bold'>Gender: </span> <span class = 'display-box'>" . $row['gender'] . "</span> </p>";
                echo "<p><span class = 'bold'>Address: </span> <span class = 'display-box'>" . $row['address'] . "</span> </p>";
                echo "<p><span class = 'bold'>Pid: </span> <span class = 'display-box'>" . $row['Pid'] . "</span> </p>";
                echo "<p><span class = 'bold'>Email: </span> <span class = 'display-box'>" . $row['email'] . "</span> </p>";
                echo "<p><span class = 'bold'>History: </span> <span class = 'display-box'>" . $row['history'] . "</span> </p>";
                echo "<p><span class = 'bold'>Allergies: </span> <span class = 'display-box'>" . $row['allergies'] . "</span> </p>";
                echo "<p><span class = 'bold'>Medicine: </span> <span class = 'display-box'>" . $row['medicine'] . "</span> </p>";
                echo "<p><span class = 'bold'>Age: </span> <span class = 'display-box'>" . $row['age'] . "</span> </p>";
                echo "<p><span class = 'bold'>Weight: </span> <span class = 'display-box'>" . $row['weight'] . "</span> </p>";
                echo "<p><span class = 'bold'>Phone number: </span> <span class = 'display-box'>" . $row['phone'] . "</span> </p>";
                echo "</div>";
                echo "</div>";
            }
            ?>
            <br><br>
            <a class="link" href="doctor.php">Back</a>
        </div>
    </div>
</body>

</html>