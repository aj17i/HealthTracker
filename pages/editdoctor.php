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

    $fullname = isset($_POST['fullname']) ? $_POST['fullname'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $hospital = isset($_POST['hospital']) ? $_POST['hospital'] : '';
    $occupation = isset($_POST['occupation']) ? $_POST['occupation'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';


    $sql = "UPDATE doctor SET ";
    $updateFields = [];

    if (!empty($fullname)) {
        $updateFields[] = "fullname='$fullname'";
    }

    if (!empty($phone)) {
        $updateFields[] = "phone='$phone'";
    }

    if (!empty($description)) {
        $updateFields[] = "description='$description'";
    }

    if (!empty($hospital)) {
        $updateFields[] = "hospital='$hospital'";
    }

    if (!empty($occupation)) {
        $updateFields[] = "occupation='$occupation'";
    }

    if (!empty($address)) {
        $updateFields[] = "address='$address'";
    }

    if (!empty($gender)) {
        $updateFields[] = "gender='$gender'";
    }


    $sql .= implode(", ", $updateFields);


    $sql .= " where email = '$user';";


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