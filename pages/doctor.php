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
    header("Location: doctorLogin.html");
    exit();
}


$user = $_SESSION['email'];




// Fetch all doctors' information
$query = "SELECT * FROM doctor WHERE email='$user'";
$result = mysqli_query($con, $query);


$query3 = "SELECT * FROM doctor WHERE email='$user'";
$result3 = mysqli_query($con, $query);


$row = mysqli_fetch_assoc($result3);
$Did = $row['Did'];

$query2 = "SELECT * FROM patient where Did = $Did";
$result2 = mysqli_query($con, $query2);


if (!$result) {
    die('Error in the query: ' . mysqli_error($con));
}
if (!$result2) {
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
    <link rel="stylesheet" href="./css/d1.css">
</head>

<body>
    <div class="container">
        <img src="./css/images/back3.jpg" alt="Image" />
        <div class="text">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div>";
                echo "<h1>" . "Dr. " . $row['fullname'] . "</h1>";
                echo "<div class = 'detailes'><h3 style = 'font-weight = bold;'>Details:</h3>";
                echo "<p><span class = 'bold'>Email: </span>" . $row['email'] . "</p>";
                echo "<p><span class = 'bold'>Occupation: </span>" . $row['occupation'] . "</p>";
                echo "<p><span class = 'bold'>Hospital: </span>" . $row['hospital'] . "</p>";
                echo "<p><span class = 'bold'>Description: </span>" . $row['description'] . "</p></div>";
                echo "</div>";
            }
            ?>
        </div>



        <img class="circle-image" src="./css/images/doctor1.webp" alt="Circular Image" />

        <div class = "text">
            <h2>Patients</h2>
        </div>

        <?php
        echo "<div class='card-container'>";

        while ($row2 = mysqli_fetch_assoc($result2)) {
            echo " <div class='card'>";
            echo "<div class='card-inner'>";
            echo "<div class='card-front'>";
            echo " <img src='./css/images/icons8-patient-100.png' alt=''>";
            echo "<h3>ID: " . $row2['Pid'] . "</h3>";
            echo " </div>";
            echo "   <div class='card-back'>";
            echo "<img src='./css/images/icons8-patient-100.png' alt=''>";
            echo "<br>";
            echo "<br>";
            echo "<br>";
            echo "<a class='link' href='viewpatient.php?Pid=" . $row2['Pid'] . "'>View Details</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }

        echo "</div>";
        ?>

        <div class="text">
            <a href="editdoctor.html" class="link">edit profile</a>
            <br><br>
            <form action="logout.php">
                <button class="btn"> Logout</button>
            </form>
        </div>

    </div>


</body>

</html>