<?php
require_once("../../config/auth.php");
require_once("../../config/config.php");

$id_user = $_SESSION['user']['id_user'];
$result = mysqli_query($con, "SELECT * FROM user WHERE id_user = '$id_user'");
foreach ($result as $key) {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" type="image/x-icon" href="../../assets/logo-320.png" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link href="profile.css" rel="stylesheet">
        <script src="profile.js"></script>
        <title><?php echo "Haloo " . ucfirst($_SESSION['user']['user_name']); ?></title>

    </head>

    <body>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <nav class="navbar navbar-expand-lg navbar-dark shadow-sm fixed-top" style="background-color: #f08425;">
            <div class="container">
                <a class="navbar-brand" href="../home/">
                    <img src="../../assets/logo-white.png" alt="" width="30" height="30" class="d-inline-block align-text-top">
                    Jobskuy
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="../home/">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../project/">Pekerjaan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../profile/">Profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" class="list-group-item list-group-item-action" data-bs-toggle="modal" data-bs-target="#modalLogout">Keluar</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <section style="padding-bottom: 4em;">
            <div class="container" style="margin-top: 6em;">
                <div class="row justify-content fs-5">
                    <div class="col-md-3 text-center">
                        <div class="position-sticky" style="top: 5rem;">
                            <img src="../../assets/profile/<?php echo $key['user_image']; ?>" alt="jobsyuk_image_profile" width="200" height="200" class="rounded-circle img-thumbnail" />
                        </div>
                    </div>

                    <div class="col-md-6" style="padding-top: 1em;">
                        <h3><?php echo $key['user_name']; ?></h3>
                        <p style="margin-bottom: 2px;"><i class="bi bi-envelope-open" style="margin-right: 8px;"></i><?php echo $key['user_email']; ?></p>
                        <p><i class="bi bi-telephone" style="margin-right: 8px;"></i><?php echo "+" . $key['user_phone']; ?></p>
                        <p>Rating : <span><b>3.5/5</b></span></p>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="joball-tab" data-bs-toggle="tab" data-bs-target="#joball" type="button" role="tab" aria-controls="joball" aria-selected="true">Semua</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="jobbidding-tab" data-bs-toggle="tab" data-bs-target="#jobbidding" type="button" role="tab" aria-controls="jobbidding" aria-selected="false">Tawar Menawar</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="jobprogress-tab" data-bs-toggle="tab" data-bs-target="#jobprogress" type="button" role="tab" aria-controls="jobprogress" aria-selected="false">Berjalan</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="jobfinish-tab" data-bs-toggle="tab" data-bs-target="#jobfinish" type="button" role="tab" aria-controls="jobfinish" aria-selected="false">Selesai</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="jobdeclined-tab" data-bs-toggle="tab" data-bs-target="#jobdeclined" type="button" role="tab" aria-controls="jobdeclined" aria-selected="false">Ditolak</button>
                            </li>
                        </ul>
                        <?php
                        $resultall = array();
                        $resultbidding = array();
                        $resultprogress = array();
                        $resultfinish = array();
                        $resultdeclined = array();
                        $resultBid = mysqli_query($con, "SELECT * FROM bid WHERE id_worker = '$id_user' ORDER BY bid_create DESC");
                        foreach ($resultBid as $keyBid) {
                            array_push($resultall, $keyBid);
                            $status = $keyBid['bid_status'];
                            if ($status == "Bid") {
                                array_push($resultbidding, $keyBid);
                            } else if ($status == "Accepted") {
                                array_push($resultprogress, $keyBid);
                            } else if ($status == "Finished") {
                                array_push($resultfinish, $keyBid);
                            } else if ($status == "Declined") {
                                array_push($resultdeclined, $keyBid);
                            }
                        }
                        ?>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="joball" role="tabpanel" aria-labelledby="joball-tab">
                                <div class="row" style="padding-top: 1em;">
                                    <?php
                                    foreach ($resultall as $keyall) {
                                        $idProject = $keyall['id_project'];
                                        $bidStatus = $keyall['bid_status'];
                                        $titleStatus = "";
                                        $colorStatus = "";
                                        if ($bidStatus == "Bid") {
                                            $titleStatus = "Tawar Menawar";
                                            $colorStatus = "#6c757d";
                                        } else if ($bidStatus == "Accepted") {
                                            $titleStatus = "Sedang Berjalan";
                                            $colorStatus = "#28a745";
                                        } else if ($bidStatus == "Finished") {
                                            $titleStatus = "Selesai";
                                            $colorStatus = "#007bff";
                                        } else if ($bidStatus == "Declined") {
                                            $titleStatus = "Ditolak";
                                            $colorStatus = "#eb4034";
                                        }
                                        $resultproject = mysqli_query($con, "SELECT * FROM project WHERE id_project = '$idProject'");
                                        foreach ($resultproject as $keyproject) {
                                            $url_image = "../../assets/job/" . $keyproject['project_image'];

                                            $hari = array(1 =>  'Minggu',  'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');

                                            $bulan = array(1 =>   'Jan', 'Feb', 'Maret', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des');

                                            $date_project = date('Y-m-d-H:i', strtotime($keyproject['project_create']));
                                            $time_project = date('H:i', strtotime($keyproject['project_create']));

                                            $split       = explode('-', $date_project);
                                            $tgl_indo = $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];

                                            $num = date('N', strtotime($date_project));
                                            $create_date = $hari[$num] . ', ' . $tgl_indo . ' | ' . $time_project;

                                            $low = "Rp " . number_format($keyproject['project_price_low'], 0, ',', '.');
                                            $high = "Rp " . number_format($keyproject['project_price_high'], 0, ',', '.');

                                            $projectDesc = $keyproject['project_description'];

                                            if (strlen($keyproject['project_description']) > 80)
                                                $projectDesc = substr($keyproject['project_description'], 0, 79) . '...';

                                            $splitAddress   = explode(',', $keyproject['project_address']);
                                            $projectAddress = $splitAddress[2] . ', ' . $splitAddress['3'];
                                    ?>

                                            <div class="col-md-12 mb-4">
                                                <div class="card mb-12">
                                                    <div class="row g-0">
                                                        <div class="col-md-3">
                                                            <img src="<?php echo $url_image; ?>" height="100%" width="100%" style="object-fit: cover;">
                                                        </div>
                                                        <div class="col-md-9">
                                                            <a href="../detail/?id=<?php echo $keyproject['id_project']; ?>" style="text-decoration: none; color: black;">
                                                                <div class="card-body">
                                                                    <h5 class="card-title"><?php echo $keyproject['project_title']; ?></h5>
                                                                    <div class="container">
                                                                        <p><?php echo $projectDesc; ?></p>
                                                                        <p style="margin-top: -10px;"><?php echo "Pendapatan : " . $low . " - " . $high; ?></p>
                                                                        <p style="margin-top: -10px;"><small class="text-muted"><?php echo $projectAddress; ?></small></p>
                                                                        <p style="margin-top: -10px; margin-bottom: -4px;"><span class="badge" style="background-color: <?php echo $colorStatus; ?>;"><?php echo $titleStatus; ?></span></p>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="jobbidding" role="tabpanel" aria-labelledby="jobbidding-tab">
                                <div class="row" style="padding-top: 1em;">
                                    <?php
                                    foreach ($resultbidding as $keybidding) {
                                        $idProject = $keybidding['id_project'];
                                        $titleStatus = "Tawar Menawar";
                                        $colorStatus = "#6c757d";
                                        $resultproject = mysqli_query($con, "SELECT * FROM project WHERE id_project = '$idProject'");
                                        foreach ($resultproject as $keyproject) {
                                            $url_image = "../../assets/job/" . $keyproject['project_image'];

                                            $hari = array(1 =>  'Minggu',  'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');

                                            $bulan = array(1 =>   'Jan', 'Feb', 'Maret', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des');

                                            $date_project = date('Y-m-d-H:i', strtotime($keyproject['project_create']));
                                            $time_project = date('H:i', strtotime($keyproject['project_create']));

                                            $split       = explode('-', $date_project);
                                            $tgl_indo = $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];

                                            $num = date('N', strtotime($date_project));
                                            $create_date = $hari[$num] . ', ' . $tgl_indo . ' | ' . $time_project;

                                            $low = "Rp " . number_format($keyproject['project_price_low'], 0, ',', '.');
                                            $high = "Rp " . number_format($keyproject['project_price_high'], 0, ',', '.');

                                            $projectDesc = $keyproject['project_description'];

                                            if (strlen($keyproject['project_description']) > 80)
                                                $projectDesc = substr($keyproject['project_description'], 0, 79) . '...';

                                            $splitAddress   = explode(',', $keyproject['project_address']);
                                            $projectAddress = $splitAddress[2] . ', ' . $splitAddress['3'];
                                    ?>

                                            <div class="col-md-12 mb-4">
                                                <div class="card mb-12">
                                                    <div class="row g-0">
                                                        <div class="col-md-3">
                                                            <img src="<?php echo $url_image; ?>" height="100%" width="100%" style="object-fit: cover;">
                                                        </div>
                                                        <div class="col-md-9">
                                                            <a href="../detail/?id=<?php echo $keyproject['id_project']; ?>" style="text-decoration: none; color: black;">
                                                                <div class="card-body">
                                                                    <h5 class="card-title"><?php echo $keyproject['project_title']; ?></h5>
                                                                    <div class="container">
                                                                        <p><?php echo $projectDesc; ?></p>
                                                                        <p style="margin-top: -10px;"><?php echo "Pendapatan : " . $low . " - " . $high; ?></p>
                                                                        <p style="margin-top: -10px;"><small class="text-muted"><?php echo $projectAddress; ?></small></p>
                                                                        <p style="margin-top: -10px; margin-bottom: -4px;"><span class="badge" style="background-color: <?php echo $colorStatus; ?>;"><?php echo $titleStatus; ?></span></p>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="jobprogress" role="tabpanel" aria-labelledby="jobprogress-tab">
                                <div class="row" style="padding-top: 1em;">
                                    <?php
                                    foreach ($resultprogress as $keyprogress) {
                                        $idProject = $keyprogress['id_project'];
                                        $titleStatus = "Sedang Berjalan";
                                        $colorStatus = "#28a745";
                                        $resultproject = mysqli_query($con, "SELECT * FROM project WHERE id_project = '$idProject'");
                                        foreach ($resultproject as $keyproject) {
                                            $url_image = "../../assets/job/" . $keyproject['project_image'];

                                            $hari = array(1 =>  'Minggu',  'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');

                                            $bulan = array(1 =>   'Jan', 'Feb', 'Maret', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des');

                                            $date_project = date('Y-m-d-H:i', strtotime($keyproject['project_create']));
                                            $time_project = date('H:i', strtotime($keyproject['project_create']));

                                            $split       = explode('-', $date_project);
                                            $tgl_indo = $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];

                                            $num = date('N', strtotime($date_project));
                                            $create_date = $hari[$num] . ', ' . $tgl_indo . ' | ' . $time_project;

                                            $low = "Rp " . number_format($keyproject['project_price_low'], 0, ',', '.');
                                            $high = "Rp " . number_format($keyproject['project_price_high'], 0, ',', '.');

                                            $projectDesc = $keyproject['project_description'];

                                            if (strlen($keyproject['project_description']) > 80)
                                                $projectDesc = substr($keyproject['project_description'], 0, 79) . '...';

                                            $splitAddress   = explode(',', $keyproject['project_address']);
                                            $projectAddress = $splitAddress[2] . ', ' . $splitAddress['3'];
                                    ?>

                                            <div class="col-md-12 mb-4">
                                                <div class="card mb-12">
                                                    <div class="row g-0">
                                                        <div class="col-md-3">
                                                            <img src="<?php echo $url_image; ?>" height="100%" width="100%" style="object-fit: cover;">
                                                        </div>
                                                        <div class="col-md-9">
                                                            <a href="../detail/?id=<?php echo $keyproject['id_project']; ?>" style="text-decoration: none; color: black;">
                                                                <div class="card-body">
                                                                    <h5 class="card-title"><?php echo $keyproject['project_title']; ?></h5>
                                                                    <div class="container">
                                                                        <p><?php echo $projectDesc; ?></p>
                                                                        <p style="margin-top: -10px;"><?php echo "Pendapatan : " . $low . " - " . $high; ?></p>
                                                                        <p style="margin-top: -10px;"><small class="text-muted"><?php echo $projectAddress; ?></small></p>
                                                                        <p style="margin-top: -10px; margin-bottom: -4px;"><span class="badge" style="background-color: <?php echo $colorStatus; ?>;"><?php echo $titleStatus; ?></span></p>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="jobfinish" role="tabpanel" aria-labelledby="jobfinish-tab">
                                <div class="row" style="padding-top: 1em;">
                                    <?php
                                    foreach ($resultfinish as $keyfinish) {
                                        $idProject = $keyfinish['id_project'];
                                        $titleStatus = "Selesai";
                                        $colorStatus = "#007bff";
                                        $resultproject = mysqli_query($con, "SELECT * FROM project WHERE id_project = '$idProject'");
                                        foreach ($resultproject as $keyproject) {
                                            $url_image = "../../assets/job/" . $keyproject['project_image'];

                                            $hari = array(1 =>  'Minggu',  'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');

                                            $bulan = array(1 =>   'Jan', 'Feb', 'Maret', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des');

                                            $date_project = date('Y-m-d-H:i', strtotime($keyproject['project_create']));
                                            $time_project = date('H:i', strtotime($keyproject['project_create']));

                                            $split       = explode('-', $date_project);
                                            $tgl_indo = $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];

                                            $num = date('N', strtotime($date_project));
                                            $create_date = $hari[$num] . ', ' . $tgl_indo . ' | ' . $time_project;

                                            $low = "Rp " . number_format($keyproject['project_price_low'], 0, ',', '.');
                                            $high = "Rp " . number_format($keyproject['project_price_high'], 0, ',', '.');

                                            $projectDesc = $keyproject['project_description'];

                                            if (strlen($keyproject['project_description']) > 80)
                                                $projectDesc = substr($keyproject['project_description'], 0, 79) . '...';

                                            $splitAddress   = explode(',', $keyproject['project_address']);
                                            $projectAddress = $splitAddress[2] . ', ' . $splitAddress['3'];
                                    ?>

                                            <div class="col-md-12 mb-4">
                                                <div class="card mb-12">
                                                    <div class="row g-0">
                                                        <div class="col-md-3">
                                                            <img src="<?php echo $url_image; ?>" height="100%" width="100%" style="object-fit: cover;">
                                                        </div>
                                                        <div class="col-md-9">
                                                            <a href="../detail/?id=<?php echo $keyproject['id_project']; ?>" style="text-decoration: none; color: black;">
                                                                <div class="card-body">
                                                                    <h5 class="card-title"><?php echo $keyproject['project_title']; ?></h5>
                                                                    <div class="container">
                                                                        <p><?php echo $projectDesc; ?></p>
                                                                        <p style="margin-top: -10px;"><?php echo "Pendapatan : " . $low . " - " . $high; ?></p>
                                                                        <p style="margin-top: -10px;"><small class="text-muted"><?php echo $projectAddress; ?></small></p>
                                                                        <p style="margin-top: -10px; margin-bottom: -4px;"><span class="badge" style="background-color: <?php echo $colorStatus; ?>;"><?php echo $titleStatus; ?></span></p>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="jobdeclined" role="tabpanel" aria-labelledby="jobdeclined-tab">
                                <div class="row" style="padding-top: 1em;">
                                    <?php
                                    foreach ($resultdeclined as $keydeclined) {
                                        $idProject = $keydeclined['id_project'];
                                        $titleStatus = "Ditolak";
                                        $colorStatus = "#eb4034";
                                        $resultproject = mysqli_query($con, "SELECT * FROM project WHERE id_project = '$idProject'");
                                        foreach ($resultproject as $keyproject) {
                                            $url_image = "../../assets/job/" . $keyproject['project_image'];

                                            $hari = array(1 =>  'Minggu',  'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');

                                            $bulan = array(1 =>   'Jan', 'Feb', 'Maret', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des');

                                            $date_project = date('Y-m-d-H:i', strtotime($keyproject['project_create']));
                                            $time_project = date('H:i', strtotime($keyproject['project_create']));

                                            $split       = explode('-', $date_project);
                                            $tgl_indo = $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];

                                            $num = date('N', strtotime($date_project));
                                            $create_date = $hari[$num] . ', ' . $tgl_indo . ' | ' . $time_project;

                                            $low = "Rp " . number_format($keyproject['project_price_low'], 0, ',', '.');
                                            $high = "Rp " . number_format($keyproject['project_price_high'], 0, ',', '.');

                                            $projectDesc = $keyproject['project_description'];

                                            if (strlen($keyproject['project_description']) > 80)
                                                $projectDesc = substr($keyproject['project_description'], 0, 79) . '...';

                                            $splitAddress   = explode(',', $keyproject['project_address']);
                                            $projectAddress = $splitAddress[2] . ', ' . $splitAddress['3'];
                                    ?>

                                            <div class="col-md-12 mb-4">
                                                <div class="card mb-12">
                                                    <div class="row g-0">
                                                        <div class="col-md-3">
                                                            <img src="<?php echo $url_image; ?>" height="100%" width="100%" style="object-fit: cover;">
                                                        </div>
                                                        <div class="col-md-9">
                                                            <a href="../detail/?id=<?php echo $keyproject['id_project']; ?>" style="text-decoration: none; color: black;">
                                                                <div class="card-body">
                                                                    <h5 class="card-title"><?php echo $keyproject['project_title']; ?></h5>
                                                                    <div class="container">
                                                                        <p><?php echo $projectDesc; ?></p>
                                                                        <p style="margin-top: -10px;"><?php echo "Pendapatan : " . $low . " - " . $high; ?></p>
                                                                        <p style="margin-top: -10px;"><small class="text-muted"><?php echo $projectAddress; ?></small></p>
                                                                        <p style="margin-top: -10px; margin-bottom: -4px;"><span class="badge" style="background-color: <?php echo $colorStatus; ?>;"><?php echo $titleStatus; ?></span></p>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3" style="padding-top: 0.5em;">
                        <!-- <button type="button" class="btn btn-secondary" style="border-radius: 1em; width:100%;">Edit Profile</button> -->
                        <div class="position-sticky" style="top: 5rem;">
                            <div class="container">
                                <div class="list-group" style="width: 100%;">
                                    <a id="listTitle" class="list-group-item disabled">Setting</a>
                                    <a href="#" class="list-group-item list-group-item-action" data-bs-toggle="modal" data-bs-target="#modalUsername">Edit Username</a>
                                    <a href="#" class="list-group-item list-group-item-action" data-bs-toggle="modal" data-bs-target="#modalUserImage">Edit Photo</a>
                                    <a href="#" class="list-group-item list-group-item-action" data-bs-toggle="modal" data-bs-target="#modalUserPassword">Edit Password</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal fade" id="modalUsername" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Username</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="profile.php" method="POST">
                            <div class="container">
                                <div class="form-group mb-3">
                                    <label for="project_title">
                                        <h6>Username Baru</h6>
                                    </label>
                                    <input type="hidden" name="edit" value="username">
                                    <input type="text" name="user_name" placeholder="<?php echo $key['user_name']; ?>" required class="form-control">
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <input type="submit" class="btn btn-primary btn-send pt-2 btn-block " value="Ubah">
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalUserImage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Foto Profil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="profile.php" method="POST" enctype="multipart/form-data">
                            <div class="container">
                                <div class="form-group mb-3">
                                    <input type="hidden" name="edit" value="image">
                                    <div class="ratio ratio-1x1 mb-3">
                                        <img id="display_user_image" width="100%" height="100%" style="object-fit: cover; border: 1px solid black;">
                                    </div>
                                    <input type="file" id="user_image" name="user_image" accept="image/png, image/jpg, image/jpeg" required onchange="readURL(this);">
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <input type="submit" class="btn btn-primary btn-send pt-2 btn-block " value="Ubah">
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalUserPassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="profile.php" method="POST">
                            <div class="container">
                                <div class="form-group mb-3">
                                    <label for="user_password_old">
                                        <h6>Password Lama</h6>
                                    </label>
                                    <input type="hidden" name="edit" value="password">
                                    <input type="password" name="user_password_old" placeholder="Password Lama" required class="form-control">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="user_password">
                                        <h6>Password Baru</h6>
                                    </label>
                                    <input type="password" name="user_password" placeholder="Password Baru" required class="form-control">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="user_re_password">
                                        <h6>Ulangi Password Baru</h6>
                                    </label>
                                    <input type="password" name="user_re_password" placeholder="Ulangi Password Baru" required class="form-control">
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <input type="submit" class="btn btn-primary btn-send pt-2 btn-block " value="Ubah">
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalLogout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Keluar Akun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Yakin ingin keluar dari akun ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <a href="../../config/logout.php"><button type="button" class="btn btn-primary">Keluar</button></a>
                    </div>
                </div>
            </div>
        </div>
        <footer class="text-center text-white" style="background-color: #f08425; position: fixed; width: 100%; bottom: 0;">
        <div class="text-center p-3">
            Created by PT. Beyonders 2021
        </div>
    </footer>
    </body>

    </html>
<?php
}
?>