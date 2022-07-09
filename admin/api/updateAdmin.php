<?php
session_start();
require_once("../../config/config.php");
if (isset($_POST['id_admin']) && isset($_POST['admin_name']) && isset($_POST['admin_email']) && isset($_POST['admin_phone'])) {

    $id_admin = $_POST['id_admin'];
    $admin_name = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
    $admin_phone = $_POST['admin_phone'];

    $result = mysqli_query($con, "UPDATE admin SET admin_name = '$admin_name', admin_email = '$admin_email', admin_phone = '$admin_phone' WHERE id_admin = '$id_admin'");

    if ($result) {
        $_SESSION['adminjobskuy']['admin_name'] = $admin_name;
        $_SESSION['adminjobskuy']['admin_email'] = $admin_email;
        $_SESSION['adminjobskuy']['admin_phone'] = $admin_phone;
        header("Location: ../");
    } else {
        header("Location: ../");
    }
} else {
    header("Location: ../");
}
