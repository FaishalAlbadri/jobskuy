<?php

require_once("../../config/config.php");

if (isset($_POST['email']) && isset($_POST['password'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($con, "SELECT * FROM user WHERE user_email = '$email'");

    $row = mysqli_num_rows($result);

    if ($row > 0) {
        $data = array();
        $passworddatabase = "";
        foreach ($result as $key) {
            $data['id_user'] = $key['id_user'];
            $data['user_name'] = $key['user_name'];
            $data['user_password'] = $key['user_password'];
            $data['user_phone'] = $key['user_phone'];
            $data['user_email'] = $key['user_email'];
            $data['user_image'] = $key['user_image'];
            $passworddatabase = $key['user_password'];
        }

        if (password_verify($password, $passworddatabase)) {
            session_start();
            $_SESSION['user'] = $data;
            header("Location: ../home");
        } else {
            echo "<script>alert('Password Kamu Salah');window.location='login'</script>";
        }
    } else {
        header("Location: ../login");
    }
} else {
    header("Location: ../login");
}
