<?php

require_once("../../config/config.php");
require '../../library/PHPMailer/vendor/autoload.php';
require_once("../sendmail.php");


if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['phone'])) {

    $user_name = $_POST['username'];
    $user_email = $_POST['email'];
    $user_phone = $_POST['phone'];
    $user_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $checkData = mysqli_query($con, "SELECT * FROM user WHERE user_email = '$user_email'");
    $countdata = mysqli_num_rows($checkData);

    if ($countdata > 0) {
        echo "<script>alert('Email telah terdaftar.. silahkan gunakan email lain');window.location='register'</script>";
    } else {

        $result = mysqli_query($con, "INSERT INTO user (user_name, user_phone, user_email, user_password) VALUES ('$user_name', '$user_phone', '$user_email', '$user_password')");

        if ($result) {
            sendMail($user_email, $user_name, "Pendaftaran Jobskuy", "Selamat telah bergabung dengan jobskuy. Ayo temukan pekerjaan sesuai dengan bakatmu.");
            header("Location: ../login");
        } else {
            header("Location: ../register");
        }
    }
} else {
    header("Location: ../register");
}
