<?php
require_once("../../config/config.php");
if (isset($_POST['admin_name']) && isset($_POST['admin_email']) && isset($_POST['admin_phone']) && isset($_POST['admin_password'])) {

    $admin_name = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
    $admin_phone = $_POST['admin_phone'];
    $admin_password = password_hash($_POST['admin_password'], PASSWORD_DEFAULT);

    $checkData = mysqli_query($con, "SELECT * FROM admin WHERE admin_email = '$admin_email'");
    $countdata = mysqli_num_rows($checkData);

    if ($countdata > 0) {
        echo "<script>alert('Email telah terdaftar.. silahkan gunakan email lain');window.location='addAdmin'</script>";
    } else {

        $result = mysqli_query($con, "INSERT INTO admin (admin_name, admin_phone, admin_email, admin_password) VALUES ('$admin_name', '$admin_phone', '$admin_email', '$admin_password')");

        if ($result) {
            header("Location: ../");
        } else {
            header("Location: ../");
        }
    }
} else {
    header("Location: ../");
}
