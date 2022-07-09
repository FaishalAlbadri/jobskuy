<?php
require_once("../../config/config.php");
require_once("../../library/ResizeImage/image.php");
session_start();

if (isset($_POST['edit'])) {

    $editType = $_POST['edit'];
    $id_user = $_SESSION['user']['id_user'];

    if ($editType == "username") {

        if (isset($_POST['user_name'])) {

            $user_name = $_POST['user_name'];

            $result = mysqli_query($con, "UPDATE user SET user_name = '$user_name' WHERE id_user = '$id_user'");

            if ($result) {
                unset($_SESSION['user']);
                $resultUser = mysqli_query($con, "SELECT * FROM user WHERE id_user = '$id_user'");
                $data = array();
                foreach ($resultUser as $key) {
                    $data = $key;
                }
                $_SESSION['user'] = $data;
                echo "<script>alert('Berhasil Ubah Username');window.location='../profile'</script>";
            } else {
                header("Location: ../profile");
            }
        } else {
            header("Location: ../profile");
        }
    } else if ($editType == "password") {
        if (isset($_POST['user_password_old']) && isset($_POST['user_password']) && isset($_POST['user_re_password'])) {
            $user_password_old = $_POST['user_password_old'];
            $user_password = $_POST['user_password'];
            $user_re_password = $_POST['user_re_password'];

            if ($user_password == $user_re_password) {
                $resultUser = mysqli_query($con, "SELECT * FROM user WHERE id_user = '$id_user'");
                $user_password_database = "";
                foreach ($resultUser as $key) {
                    $user_password_database = $key['user_password'];
                }

                if (password_verify($user_password_old, $user_password_database)) {
                    $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);
                    $resultPass = mysqli_query($con, "UPDATE user SET user_password = '$user_password_hash' WHERE id_user = '$id_user'");

                    if ($resultPass) {
                        unset($_SESSION['user']);
                        $result = mysqli_query($con, "SELECT * FROM user WHERE id_user = '$id_user'");
                        $data = array();
                        foreach ($result as $key) {
                            $data = $key;
                        }
                        $_SESSION['user'] = $data;
                        echo "<script>alert('Berhasil Ubah Password');window.location='../profile'</script>";
                    } else {
                        header("Location: ../profile");
                    }
                } else {
                    echo "<script>alert('Password Lama Tidak Cocok');window.location='../profile'</script>";
                }
            } else {
                echo "<script>alert('Password dengan Re-Password Tidak Cocok');window.location='../profile'</script>";
            }
        } else {
            header("Location: ../profile");
        }
    } else if ($editType == "image") {
        if (!empty($_FILES['user_image']['name'])) {
            $user_image = $_FILES["user_image"]["name"];
            $tempname = resize_image($_FILES["user_image"]["tmp_name"], 320, 320);
            $user_image_ext_explode = explode('.', $user_image);
            $user_image_ext_end = end($user_image_ext_explode);
            $user_image_ext = strtolower($user_image_ext_end);
            $user_image_new_name = "IMG_PROFILE_JOBSKUY_" . date('Ymdhi') . $id_user . "." . $user_image_ext;

            $result = mysqli_query($con, "UPDATE user SET user_image = '$user_image_new_name' WHERE id_user = '$id_user'");
            if ($result) {
                if (compressImage($tempname, "../../assets/profile/" . $user_image_new_name, 75)) {
                    unset($_SESSION['user']);
                    $resultUser = mysqli_query($con, "SELECT * FROM user WHERE id_user = '$id_user'");
                    $data = array();
                    foreach ($resultUser as $key) {
                        $data = $key;
                    }
                    $_SESSION['user'] = $data;
                    echo "<script>alert('Berhasil Ubah Poto Profil');window.location='../profile'</script>";
                } else {
                    header("Location: ../profile3");
                }
            } else {
                header("Location: ../profile2");
            }
        } else {
            header("Location: ../profile1");
        }
    } else {
        header("Location: ../profile");
    }
} else {
    header("Location: ../profile");
}
