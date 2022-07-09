<?php
require_once("../../config/config.php");
require_once("../../library/ResizeImage/image.php");
session_start();

if (isset($_POST['project_title']) && isset($_POST['project_category']) && isset($_POST['project_description']) && isset($_POST['min_price_value']) && isset($_POST['max_price_value']) && isset($_POST['provinsi']) && isset($_POST['kota']) && isset($_POST['kelurahan']) && isset($_POST['kecamatan']) && !empty($_FILES['project_image']['name'])) {

    $project_title = $_POST['project_title'];
    $project_category = $_POST['project_category'];
    $project_description = $_POST['project_description'];
    $min_price_value = $_POST['min_price_value'];
    $max_price_value = $_POST['max_price_value'];
    $provinsi = $_POST['provinsi'];
    $kota = $_POST['kota'];
    $kecamatan = $_POST['kecamatan'];
    $kelurahan = $_POST['kelurahan'];
    $id_user = $_SESSION['user']['id_user'];
    $project_address = "";
    $project_image = $_FILES["project_image"]["name"];
    $tempname = resize_image($_FILES["project_image"]["tmp_name"], 320, 320);
    $project_image_ext = strtolower(end(explode('.', $project_image)));
    $project_image_new_name = "IMG_JOB_JOBSKUY_" . date('Ymdhi') . $id_user . "." . $project_image_ext;


    $getKel = mysqli_query($con, "SELECT name FROM villages WHERE id ='$kelurahan'");
    foreach ($getKel as $keyKel) {
        $data = strtolower($keyKel['name']);
        $data = ucfirst($data);
        $project_address = $project_address . $data . ", ";
    }

    $getKec = mysqli_query($con, "SELECT name FROM districts WHERE id ='$kecamatan'");
    foreach ($getKec as $keyKec) {
        $data = strtolower($keyKec['name']);
        $data = ucfirst($data);
        $project_address = $project_address . $data . ", ";
    }

    $getKota = mysqli_query($con, "SELECT name FROM regencies WHERE id ='$kota'");
    foreach ($getKota as $keyKota) {
        $data = strtolower($keyKota['name']);
        $data = ucfirst($data);
        $project_address = $project_address . $data . ", ";
    }

    $getProv = mysqli_query($con, "SELECT name FROM provinces WHERE id ='$provinsi'");
    foreach ($getProv as $keyProv) {
        $data = strtolower($keyProv['name']);
        $data = ucfirst($data);
        $project_address = $project_address . $data;
    }

    $result = mysqli_query(
        $con,
        "INSERT INTO 
    project 
    (id_user, id_project_category, project_title, project_description, project_price_low, project_price_high, project_address, project_image) 
    VALUES 
    ('$id_user', '$project_category', '$project_title', '$project_description', '$min_price_value', '$max_price_value', '$project_address', '$project_image_new_name')"
    );

    if ($result) {
        if (compressImage($tempname, "../../assets/job/" . $project_image_new_name, 75)) {
            header("Location: ../project");
        } else {
            echo "<script>alert('Gagal mengupload foto pekerjaan baru!');window.location='../project'</script>";
        }
    } else {
        echo "<script>alert('Gagal membuat pekerjaan baru!');window.location='../project'</script>";
    }
} else {
    header("Location: ../project");
}
