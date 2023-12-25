<?php
require_once 'Login.php';
if (
    isset($_POST['fname']) && $_POST['fname'] != ""
    && isset($_POST['lname']) && $_POST['lname'] != ""
    && isset($_POST['email']) && $_POST['email'] != ""
) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $pass = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];


    $query = "Select * From patient where email ='$email' and password='$pass'";

    $res = mysqli_query($con, $query);

    $nbrows = mysqli_num_rows($res);
    if ($nbrows == 1) {
        echo "error : user already exists, try another email, or try logging in";
        header("refresh:5;url=register.php");
    } else {
        $query2 = "INSERT INTO `patient` (`fname`,`lname`,`password`,`email`,`phone`,`gender`) VALUES ('$fname','$lname','$pass','$email','$phone','$gender')";
        $result2 = mysqli_query($con, $query2);
        if (!$result2) {
            echo "error registration";
            header("refresh:5;url=signup.html");
        } else {
            header("location:patientLogin.html");
        }

    }
}
?>