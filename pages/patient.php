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


$email = $_SESSION['email'];


$query = "SELECT * FROM patient WHERE email='$email'";
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
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/p1.css">
</head>

<body>
    <div class="container">
        <img src="./css/images/back8.jpg" alt="Image" />
        <div class="text">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div>";
                echo "<h2>" . $row['Fullname'] . "</h2>";
                echo "<div class = 'detailes'><h3 style = 'font-weight = bold;'>Details:</h3>";
                echo "<p>Pid: " . $row['Pid'] . "</p>";
                echo "<p>Email: " . $row['email'] . "</p>";
                echo "<p>History: " . $row['history'] . "</p>";
                echo "<p>Medicine: " . $row['medicine'] . "</p>";
                echo "<p>Allergies: " . $row['allergies'] . "</p>";
                echo "<p>Gender: " . $row['gender'] . "</p>";
                echo "<p>Birth Date: " . $row['birthd'] . "</p>";
                echo "<p>Phone number: " . $row['phone'] . "</p>";
                echo "<p>Age: " . $row['age'] . "</p></div>";
                echo "</div>";
            }
            ?>
        </div>
        <img class="circle-image" src="./css/images/patient.jpeg" alt="Circular Image" />
        <div class="text">
            <a href="editpatient.html" class="link">edit profile</a>
            <br><br>
            <form action="logout.php">
                <button class="btn"> Logout</button>
            </form>

        </div>
    </div>
</body>

</html>