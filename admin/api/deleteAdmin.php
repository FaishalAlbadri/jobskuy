<?php
require_once("../../config/config.php");
if (!empty($_GET['id'])) {

    $id_admin = $_GET['id'];

    $result = mysqli_query($con, "DELETE FROM admin WHERE id_admin = '$id_admin'");

    if ($result) {
        header("Location: ../");
    } else {
        header("Location: ../");
    }
} else {
    header("Location: ../");
}
