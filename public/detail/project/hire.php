<?php
require_once("../../../config/config.php");

if (isset($_POST['id_project']) && isset($_POST['id_user'])) {
    $id_project = $_POST['id_project'];
    $id_user = $_POST['id_user'];

    $resultChangesProjectStatus = mysqli_query($con, "UPDATE project SET project_status = 'Progress' WHERE id_project = '$id_project'");
    if ($resultChangesProjectStatus) {
        $resultChangesBidStatusDeclined = mysqli_query($con, "UPDATE bid SET bid_status = 'Declined' WHERE id_project = '$id_project'");
        if ($resultChangesBidStatusDeclined) {
            $resultChangesBidStatusAccepted = mysqli_query($con, "UPDATE bid SET bid_status = 'Accepted' WHERE id_project = '$id_project' AND id_worker = '$id_user'");
            if ($resultChangesBidStatusAccepted) {

                $resultProject = mysqli_query($con, "SELECT project_title FROM project WHERE id_project = '$id_project'");
                $resultWorker = mysqli_query($con, "SELECT user_name, user_email FROM user WHERE id_user = '$id_user'");
                $user_name = "";
                $user_email = "";
                $project_title = "";
                foreach ($resultWorker as $keyWorker) {
                    $user_name = $keyWorker['user_name'];
                    $user_email = $keyWorker['user_email'];
                }

                foreach ($resultProject as $keyProject) {
                    $project_title = $keyProject['project_title'];
                }

                echo "success";
            } else {
                echo "gagal";
            }
        } else {
            echo "gagal";
        }
    } else {
        echo "gagal";
    }
}
