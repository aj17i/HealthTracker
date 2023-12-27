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
    <link rel="stylesheet" href="./css/d1.css">
</head>

<body>
    <div class="container">
        <img src="./css/images/doctor_back.jpg" alt="Image" />
        <div class="text">
            <h1>Hello world</h1>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div>";
                echo "<h2>" . $row['fullname'] . "</h2>";
                echo "<p>Email: " . $row['email'] . "</p>";
                echo "<p>Occupation: " . $row['occupation'] . "</p>";
                echo "<p>Hospital: " . $row['hospital'] . "</p>";
                echo "</div>";
            }
            ?>
            <form action="logout.php">
                <button> Logout</button>
            </form>
            <a href="editdoctor.html">edit profile</a>
        </div>



        <img class="circle-image" src="./css/images/doctor1.webp" alt="Circular Image" />



        <div class="text">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus perspiciatis ipsam laborum maxime
            similique fugiat minima soluta mollitia expedita iure, neque officiis nihil hic placeat non! Ullam
            voluptatum ducimus distinctio.
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores molestias voluptate dicta cum in ut
            consequatur esse quam corrupti commodi, ea, sit fugit debitis adipisci. Culpa tempora itaque perspiciatis
            minima.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat sit quam, inventore eos soluta quia ea
            expedita facere debitis consectetur ab consequuntur quibusdam blanditiis quod suscipit eligendi delectus
            voluptate incidunt?
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus architecto incidunt ut, minus optio
            eveniet non tenetur nulla atque error animi alias odio temporibus vitae, tempora fugiat, in provident
            voluptate.
        </div>
    </div>
</body>

</html>