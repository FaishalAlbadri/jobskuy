<?php
require_once("../../config/config.php");
if (!empty($_GET['id'])) {

    $id_project_category = $_GET['id'];

    $result = mysqli_query($con, "DELETE FROM project_category WHERE id_project_category = '$id_project_category'");

    if ($result) {
        header("Location: ../");
    } else {
        header("Location: ../");
    }
} else {
    header("Location: ../");
}
