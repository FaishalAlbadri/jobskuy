<?php

require_once("../../config/config.php");
session_start();

if (isset($_POST['id']) && isset($_POST['value']) && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['title'])) {

    $id_project = $_POST['id'];
    $bid_price = $_POST['value'];
    $id_worker = $_SESSION['user']['id_user'];
    $worker_name = $_SESSION['user']['user_name'];
    $user_email = $_POST['email'];
    $user_name = $_POST['username'];
    $project_title = $_POST['title'];
    $bid_price_format = number_format($bid_price, 0, ',', '.');

    $result = mysqli_query($con, "INSERT INTO bid (id_worker, id_project, bid_price) VALUES ('$id_worker', '$id_project', '$bid_price')");
    if ($result) {
        echo "success";
    } else {
        echo "gagal";
    }
}
