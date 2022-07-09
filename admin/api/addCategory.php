<?php
require_once("../../config/config.php");
if (isset($_POST['project_category_name'])) {

    $project_category_name = $_POST['project_category_name'];

    $result = mysqli_query($con, "INSERT INTO project_category (project_category_name) VALUES ('$project_category_name')");

    if ($result) {
        header("Location: ../");
    } else {
        header("Location: ../");
    }
} else {
    header("Location: ../");
}
