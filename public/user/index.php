<?php
require_once("../../config/auth.php");
require_once("../../config/config.php");

$id = "";
if ($_GET) {
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
    }
}

$result = mysqli_query($con, "SELECT * FROM user WHERE id_user = '$id'");
if ($result) {
    foreach ($result as $key) {
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="icon" type="image/x-icon" href="../../assets/logo-320.png" />
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css" />
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <title><?php echo $key['user_name']; ?></title>
            <link href="user.css" rel="stylesheet">
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
                                <a class="nav-link" href="../profile/">Profil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" class="list-group-item list-group-item-action" data-bs-toggle="modal" data-bs-target="#modalLogout">Keluar</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <section style="padding-bottom: 4em;">
                <div class="container" style="margin-top: 5em;">
                    <div class="row justify-content fs-5">
                        <div class="col-md-12">
                            <div class="container-fluid text-center">
                                <img src="../../assets/profile/<?php echo $key['user_image']; ?>" alt="jobsyuk_image_profile" width="150" height="150" class="rounded-circle img-thumbnail" />
                                <h3 style="margin-bottom: 1px;"><?php echo $key['user_name']; ?></h3>
                                <p>Rating : <span><b>3.5/5</b></span></p>
                            </div>
                            <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="project-tab" data-bs-toggle="tab" data-bs-target="#project" type="button" role="tab" aria-controls="project" aria-selected="true">Lapangan Pekerjaan</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button" role="tab" aria-controls="history" aria-selected="false">Riwayat Pekerjaan</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="project" role="tabpanel" aria-labelledby="project-tab">
                                    <div class="row" style="padding: 1em;">
                                        <?php
                                        $resultproject = mysqli_query($con, "SELECT * FROM project WHERE id_user = '$id' AND project_status = 'Waiting' ORDER BY project_create DESC");
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

                                            if (strlen($keyproject['project_description']) < 65) {
                                                $projectDesc = $projectDesc . " <br><br>";
                                            } else if (strlen($keyproject['project_description']) > 80) {
                                                $projectDesc = substr($keyproject['project_description'], 0, 79) . '...';
                                            }

                                            $splitAddress   = explode(',', $keyproject['project_address']);
                                            $projectAddress = $splitAddress[2] . ', ' . $splitAddress['3'];
                                        ?>

                                            <div class="col-6 mb-4">
                                                <div class="card mb-12">
                                                    <div class="row g-0">
                                                        <div class="col-md-3">
                                                            <img src="<?php echo $url_image; ?>" width="100%" height="100%">
                                                        </div>
                                                        <div class="col-md-9">
                                                            <a href="../detail/?id=<?php echo $keyproject['id_project']; ?>" style="text-decoration: none; color: black;">
                                                                <div class="card-body">
                                                                    <h5 class="card-title"><?php echo $keyproject['project_title']; ?></h5>
                                                                    <div class="container">
                                                                        <p><?php echo $projectDesc; ?></p>
                                                                        <p style="margin-top: -10px;"><?php echo "Pendapatan : " . $low . " - " . $high; ?></p>
                                                                        <p style="margin-top: -10px;"><small class="text-muted"><?php echo $projectAddress; ?></small></p>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
                                    <div class="row" style="padding: 1em;">
                                        <?php
                                        $resulthistory  = mysqli_query($con, "SELECT * FROM bid WHERE id_worker = '$id' AND bid_status = 'Finished' ORDER BY bid_create DESC");
                                        foreach ($resulthistory as $keyhistory) {
                                            $idProject = $keyhistory['id_project'];
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

                                                <div class="col-6 mb-4">
                                                    <div class="card mb-12">
                                                        <div class="row g-0">
                                                            <div class="col-md-3">
                                                                <img src="<?php echo $url_image; ?>" height="100%" width="100%">
                                                            </div>
                                                            <div class="col-md-9">
                                                                <div class="card-body">
                                                                    <h5 class="card-title"><?php echo $keyproject['project_title']; ?></h5>
                                                                    <div class="container">
                                                                        <p><?php echo $projectDesc; ?></p>
                                                                        <p style="margin-top: -10px;"><?php echo "Pendapatan : " . $low . " - " . $high; ?></p>
                                                                        <p style="margin-top: -10px;"><small class="text-muted"><?php echo $projectAddress; ?></small></p>
                                                                    </div>
                                                                </div>
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
                    </div>
                </div>
            </section>

            <footer class="text-center text-white" style="background-color: #f08425; position: fixed; width: 100%; bottom: 0;">
                <div class="text-center p-3">
                    Created by PT. Beyonders 2021
                </div>
            </footer>
        </body>

        </html>
<?php

    }
}
?>