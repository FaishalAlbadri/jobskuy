<?php
require_once("../../config/auth.php");
require_once("../../config/config.php");

$idCategory = "";
$filter = "";
if ($_GET) {
    if (!empty($_GET['c'])) {
        $idCategory = $_GET['c'];
    }

    if (!empty($_GET['f'])) {
        $filter = $_GET['f'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/x-icon" href="../../assets/logo-320.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css" />
    <link href="home.css" rel="stylesheet">
    <script src="home.js"></script>
    <title>Jobskuy</title>
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
                    <li class="nav-item" id="search">
                        <form class="container-fluid" method="get" action="">
                            <input class="form-control me-2" type="search" placeholder="Sedang Mencari Pekerjaan ?" aria-label="Search" name="c">
                            <input type="hidden" name="f" value="<?php echo $filter; ?>">
                        </form>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../home/">Beranda</a>
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
                <div class="col-md-3">
                    <div class="position-sticky" style="top: 5rem;">
                        <div class="container">
                            <div class="list-group">
                                <a id="listTitle" class="list-group-item disabled">Kategori</a>
                                <?php

                                $result = mysqli_query($con, "SELECT * FROM project_category ORDER BY project_category_name ASC");
                                if ($result) {
                                    foreach ($result as $key) {
                                ?>
                                        <a href="../home/?c=<?php echo $key['id_project_category']; ?>&f=<?php echo $filter ?>" class="list-group-item list-group-item-action"><?php echo $key['project_category_name']; ?></a>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row">

                        <?php
                        if (empty($idCategory)) {
                            if ($filter == "1") {
                                $result = mysqli_query($con, "SELECT * FROM project WHERE project_status = 'Waiting' ORDER BY project_create DESC");
                            } else if ($filter == "2") {
                                $result = mysqli_query($con, "SELECT * FROM project WHERE project_status = 'Waiting' ORDER BY project_title ASC");
                            } else if ($filter == "3") {
                                $result = mysqli_query($con, "SELECT * FROM project WHERE project_status = 'Waiting' ORDER BY project_title DESC");
                            } else {
                                $result = mysqli_query($con, "SELECT * FROM project WHERE project_status = 'Waiting'");
                            }
                        } else {
                            if ($filter == "1") {
                                if (is_numeric($idCategory)) {
                                    $result = mysqli_query($con, "SELECT * FROM project WHERE id_project_category = '$idCategory' AND project_status = 'Waiting' ORDER BY project_create DESC");
                                } else {
                                    $result = mysqli_query($con, "SELECT * FROM project WHERE project_title LIKE '%$idCategory%' AND project_status = 'Waiting' OR project_description LIKE '%$idCategory%' AND project_status = 'Waiting' ORDER BY project_create DESC");
                                }
                            } else if ($filter == "2") {
                                if (is_numeric($idCategory)) {
                                    $result = mysqli_query($con, "SELECT * FROM project WHERE id_project_category = '$idCategory' AND project_status = 'Waiting' ORDER BY project_title ASC");
                                } else {
                                    $result = mysqli_query($con, "SELECT * FROM project WHERE project_title LIKE '%$idCategory%' AND project_status = 'Waiting' OR project_description LIKE '%$idCategory%' AND project_status = 'Waiting' ORDER BY project_title ASC");
                                }
                            } else if ($filter == "3") {
                                if (is_numeric($idCategory)) {
                                    $result = mysqli_query($con, "SELECT * FROM project WHERE id_project_category = '$idCategory' AND project_status = 'Waiting' ORDER BY project_title DESC");
                                } else {
                                    $result = mysqli_query($con, "SELECT * FROM project WHERE project_title LIKE '%$idCategory%' AND project_status = 'Waiting' OR project_description LIKE '%$idCategory%' AND project_status = 'Waiting' ORDER BY project_title DESC");
                                }
                            } else {
                                if (is_numeric($idCategory)) {
                                    $result = mysqli_query($con, "SELECT * FROM project WHERE id_project_category = '$idCategory' AND project_status = 'Waiting'");
                                } else {
                                    $result = mysqli_query($con, "SELECT * FROM project WHERE project_title LIKE '%$idCategory%' AND project_status = 'Waiting' OR project_description LIKE '%$idCategory%' AND project_status = 'Waiting'");
                                }
                            }
                        }

                        foreach ($result as $key) {
                            $url_image = "../../assets/job/" . $key['project_image'];

                            $hari = array(1 =>  'Minggu',  'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');

                            $bulan = array(1 =>   'Jan', 'Feb', 'Maret', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des');

                            $date_project = date('Y-m-d-H:i', strtotime($key['project_create']));
                            $time_project = date('H:i', strtotime($key['project_create']));

                            $split       = explode('-', $date_project);
                            $tgl_indo = $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];

                            $num = date('N', strtotime($date_project));
                            $create_date = $hari[$num] . ', ' . $tgl_indo . ' | ' . $time_project;

                            $low = "Rp " . number_format($key['project_price_low'], 0, ',', '.');
                            $high = "Rp " . number_format($key['project_price_high'], 0, ',', '.');

                            $projectDesc = $key['project_description'];

                            if (strlen($key['project_description']) > 80)
                                $projectDesc = substr($key['project_description'], 0, 79) . '...';

                            $splitAddress   = explode(',', $key['project_address']);
                            $projectAddress = $splitAddress[2] . ', ' . $splitAddress['3'];
                        ?>

                            <div class="col-md-12 mb-4">
                                <div class="card mb-12">
                                    <div class="row g-0">
                                        <div class="col-md-3">
                                            <img src="<?php echo $url_image; ?>" height="100%" width="100%" style="object-fit: cover;">
                                        </div>
                                        <div class="col-md-9">
                                            <a href="../detail/?id=<?php echo $key['id_project']; ?>" style="text-decoration: none; color: black;">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo $key['project_title']; ?></h5>
                                                    <div class="container">
                                                        <p><?php echo $projectDesc; ?></p>
                                                        <p style="margin-top: -10px;"><?php echo "Pendapatan : " . $low . " - " . $high; ?></p>
                                                        <p style="margin-top: -10px;"><small class="text-muted"><?php echo $create_date . " | " . $projectAddress; ?></small></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>

                    </div>
                </div>

                <div class="col-md-3">
                    <div class="position-sticky" style="top: 5rem;">
                        <div class="container">
                            <div class="list-group">
                                <a id="listTitle" class="list-group-item disabled">Filter</a>
                                <a href="../home/?c=<?php echo $idCategory; ?>&f=1" class="list-group-item list-group-item-action">Terbaru</a>
                                <a href="../home/?c=<?php echo $idCategory; ?>&f=2" class="list-group-item list-group-item-action">A-Z</a>
                                <a href="../home/?c=<?php echo $idCategory; ?>&f=3" class="list-group-item list-group-item-action">Z-A</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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