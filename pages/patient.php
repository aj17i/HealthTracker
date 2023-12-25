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
if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {
    header("Location: patientLogin.html");
    exit();
}


$Pid = $_SESSION['Pid'];




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
    <h1>Hello patient</h1>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div>";
        echo "<h2>" . $row['fname'] . " " . $row['lname'] . "</h2>";
        echo "<p>Email: " . $row['email'] . "</p>";
        echo "<p>History: " . $row['history'] . "</p>";
        echo "<p>Pid: " . $row['Pid'] . "</p>";
        echo "<p>Age: " . $row['age'] . "</p>";
        echo "</div>";
    }
    ?>
    <form action="logout.php">
    <button> Logout</button>
    </form>
    

</body>
</html>