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
    header("Location: patient.php");
    exit();
}


$user = $_SESSION['email'];





if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = isset($_POST['Fullname']) ? $_POST['Fullname'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $birth = isset($_POST['birthd']) ? $_POST['birthd'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';


    $sql = "UPDATE patient SET ";
    $updateFields = [];

    if (!empty($fullname)) {
        $updateFields[] = "Fullname='$fullname'";
    }

    if (!empty($phone)) {
        $updateFields[] = "phone='$phone'";
    }

    if (!empty($birth)) {
        $updateFields[] = "birthd='$birth'";
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
    header("Location: patient.php");
    exit(); // Redirect to the doctor.php page on success 
} else {
    echo "No rows were updated.";
}

mysqli_close($con);

?>