<?php
require_once("../../config/config.php");
if (isset($_POST['id_project_category']) && isset($_POST['project_category_name'])) {

    $id_project_category = $_POST['id_project_category'];
    $project_category_name = $_POST['project_category_name'];

    $result = mysqli_query($con, "UPDATE project_category SET project_category_name = '$project_category_name' WHERE id_project_category = '$id_project_category'");

    if ($result) {
        header("Location: ../");
    } else {
        header("Location: ../");
    }
} else {
    header("Location: ../");
}
