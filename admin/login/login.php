<?php

require_once("../../config/config.php");

if (isset($_POST['email']) && isset($_POST['password'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($con, "SELECT * FROM admin WHERE admin_email = '$email'");

    $row = mysqli_num_rows($result);

    if ($row > 0) {
        $data = array();
        $passworddatabase = "";
        foreach ($result as $key) {
            $data['id_admin'] = $key['id_admin'];
            $data['admin_name'] = $key['admin_name'];
            $data['admin_password'] = $key['admin_password'];
            $data['admin_phone'] = $key['admin_phone'];
            $data['admin_email'] = $key['admin_email'];
            $data['admin_image'] = $key['admin_image'];
            $passworddatabase = $key['admin_password'];
        }

        if (password_verify($password, $passworddatabase)) {
            session_start();
            $_SESSION['adminjobskuy'] = $data;
            header("Location: ../");
        } else {
            echo "<script>alert('Password Kamu Salah');window.location='login'</script>";
        }
    } else {
        header("Location: ../login");
    }
} else {
    header("Location: ../login");
}
