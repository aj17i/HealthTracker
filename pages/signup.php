<?php
require_once 'Login.php';
if (
    isset($_POST['fullname']) && $_POST['fullname'] != ""
    && isset($_POST['email']) && $_POST['email'] != ""
) {
    $fullname = $_POST['fullname'];

    $pass = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];

    $hashed = password_hash($pass, PASSWORD_DEFAULT);


    $query = "Select * From patient where email ='$email' and password='$hashed'";

    $res = mysqli_query($con, $query);

    $nbrows = mysqli_num_rows($res);
    if ($nbrows == 1) {
        echo "error : user already exists, try another email, or try logging in";
        header("refresh:5;url=register.php");
    } else {
        $query2 = "INSERT INTO `patient` (`fullname`,`password`,`email`,`phone`,`gender`) VALUES ('$fullname','$hashed','$email','$phone','$gender')";
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