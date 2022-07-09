<?php
require_once("../../config/auth.php");
require_once("../../config/config.php");

$filter = "";
if ($_GET) {
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
    <title>Pekerjaan</title>
    <link rel="icon" type="image/x-icon" href="../../assets/logo-320.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css" />
    <script src="../../library/jquery/jquery-3.3.1.min.js"></script>
    <link href="project.css" rel="stylesheet">
    <script src="project.js"></script>
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
                        <a class="nav-link active" href="../project/">Pekerjaan</a>
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
                                <a id="listTitle" class="list-group-item disabled">Pekerjaan</a>
                                <a href="../project/" class="list-group-item list-group-item-action">Semua</a>
                                <a href="../project/?f=1" class="list-group-item list-group-item-action">Tawar Menawar</a>
                                <a href="../project/?f=2" class="list-group-item list-group-item-action">Sedang Berjalan</a>
                                <a href="../project/?f=3" class="list-group-item list-group-item-action">Selesai</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <?php
                        $idUser = $_SESSION['user']['id_user'];
                        $result = "";
                        $titleStatus = "";
                        $colorStatus = "";
                        if ($filter == "1") {
                            $result = mysqli_query($con, "SELECT * FROM project WHERE id_user = '$idUser' AND project_status = 'Waiting' ORDER BY project_create DESC");
                            $titleStatus = "Tawar Menawar";
                            $colorStatus = "#6c757d";
                        } else if ($filter == "2") {
                            $result = mysqli_query($con, "SELECT * FROM project WHERE id_user = '$idUser' AND project_status = 'Progress' ORDER BY project_create DESC");
                            $titleStatus = "Sedang Berjalan";
                            $colorStatus = "#28a745";
                        } else if ($filter == "3") {
                            $result = mysqli_query($con, "SELECT * FROM project WHERE id_user = '$idUser' AND project_status = 'Finished' ORDER BY project_create DESC");
                            $titleStatus = "Selesai";
                            $colorStatus = "#007bff";
                        } else {
                            $result = mysqli_query($con, "SELECT * FROM project WHERE id_user = '$idUser' ORDER BY project_create DESC");
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

                            $splitAddress   = explode(',', $key['project_address']);
                            $projectAddress = $splitAddress[2] . ', ' . $splitAddress['3'];

                            if (empty($filter)) {
                                if ($key['project_status'] == "Waiting") {
                                    $titleStatus = "Tawar Menawar";
                                    $colorStatus = "#6c757d";
                                } else if ($key['project_status'] == "Progress") {
                                    $titleStatus = "Sedang Berjalan";
                                    $colorStatus = "#28a745";
                                } else if ($key['project_status'] == "Finished") {
                                    $titleStatus = "Selesai";
                                    $colorStatus = "#007bff";
                                }
                            }

                            if (strlen($key['project_description']) > 80)
                                $projectDesc = substr($key['project_description'], 0, 79) . '...';
                        ?>
                            <div class="col-md-12 mb-4">
                                <div class="card mb-12">
                                    <div class="row g-0">
                                        <div class="col-md-3">
                                            <img src="<?php echo $url_image; ?>" height="100%" width="100%" style="object-fit: cover;">
                                        </div>
                                        <div class="col-md-9">
                                            <a href="../detail/project/?id=<?php echo $key['id_project']; ?>" style="text-decoration: none; color: black;">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo $key['project_title']; ?></h5>
                                                    <div class="container">
                                                        <p><?php echo $projectDesc; ?></p>
                                                        <p style="margin-top: -10px;"><?php echo "Pendapatan : " . $low . " - " . $high; ?></p>
                                                        <p style="margin-top: -10px; margin-bottom: 2px;"><small class="text-muted"><?php echo $create_date . " | " . $projectAddress; ?></small></p>
                                                        <p style="margin: 0px;"><span class="badge" style="background-color: <?php echo $colorStatus; ?>;"><?php echo $titleStatus; ?></span></p>
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

                <div class="col-md-3">
                    <div class="position-sticky" style="top: 5rem;">
                        <div class="container">
                            <div class="list-group">
                                <a class="list-group-item"> <button id="createProject" type="button" class="btn btn-secondary" style="width: 100%; margin-top: 0.5em; margin-bottom: 0.5em;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Buat Pekerjaan</button> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Buat Pekerjaan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body" style="background: #f5f5f5;">
                    <form action="projectadd.php" method="POST" enctype="multipart/form-data">
                        <div class="container">

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="ratio ratio-1x1">
                                        <img id="display_project_image" width="100%" height="100%" style="object-fit: cover; border: 1px solid black;">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <h5 style="margin-top: 8px;">Foto Pekerjaan</h5>
                                    <p><small class="text-muted">Upload foto hanya bisa menggunakan file dalam bentuk PNG/JPG/JPEG<br>Maksimal file adalah 2 MB</small></p>
                                    <input type="file" id="project_image" name="project_image" accept="image/png, image/jpg, image/jpeg" required onchange="readURL(this);">
                                </div>
                            </div>
                        </div>
                        <hr class="rounded">
                        <div class="container">
                            <div class="form-group mb-3">
                                <label for="project_title">
                                    <h6>Judul Pekerjaan</h6>
                                </label>
                                <input type="text" name="project_title" placeholder="Judul Pekerjaan" required class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="project_category">
                                    <h6>Kategori Pekerjaan</h6>
                                </label>
                                <select id="project_category" name="project_category" class="form-select" required>
                                    <option value="" selected disabled>Pilih Kategori</option>
                                    <?php
                                    $resultCategoryProject = mysqli_query($con, "SELECT * FROM project_category ORDER BY project_category_name ASC");
                                    foreach ($resultCategoryProject as $keyCategoryProject) {
                                    ?>
                                        <option value="<?php echo $keyCategoryProject['id_project_category']; ?>"><?php echo $keyCategoryProject['project_category_name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="project_description">
                                    <h6>Deskripsi Pekerjaan</h6>
                                </label>
                                <textarea id="project_description" name="project_description" class="form-control" placeholder="Deskripsi Pekerjaan" rows="5" required data-error="Please, leave us a message."></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label style="margin-bottom: -8px;">
                                    <h6>Kisaran Harga Pekerjaan</h6>
                                </label>
                                <div class="row justify-content fs-5" style="padding-left: 8px; padding-right: 8px;">
                                    <div class="col-md-6">
                                        <p id="smallText" style="margin-bottom: 4px;"><small id="min_price" class="text-muted">Min Harga</small></p>
                                        <input type="number" id="min_price_value" name="min_price_value" placeholder="Min Harga Pekerjaan" required class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <p id="smallText" style="margin-bottom: 4px;"><small id="max_price" class="text-muted">Max Harga</small></p>
                                        <input type="number" id="max_price_value" name="max_price_value" placeholder="Max Harga Pekerjaan" required class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="provinsi">
                                    <h6>Pilih Alamat Provinsi</h6>
                                </label>
                                <?php
                                $sql_provinsi = mysqli_query($con, "SELECT * FROM provinces ORDER BY name ASC");
                                ?>
                                <select class="form-select" name="provinsi" id="provinsi" required>
                                    <option value="" selected disabled>Pilih Provinsi</option>
                                    <?php
                                    while ($rs_provinsi = mysqli_fetch_assoc($sql_provinsi)) {
                                        echo '<option value="' . $rs_provinsi['id'] . '">' . $rs_provinsi['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                                <img src="../../assets/loading.gif" width="35" id="load1" style="display:none;" />
                            </div>

                            <div class="form-group mb-3">
                                <label for="kota">
                                    <h6>Pilih Alamat Kota/Kabupaten</h6>
                                </label>
                                <select class="form-select" name="kota" id="kota" required>
                                    <option value="" selected disabled>Pilih Kota/Kabupaten</option>
                                </select>
                                <img src="../../assets/loading.gif" width="35" id="load2" style="display:none;" />
                            </div>

                            <div class="form-group mb-3">
                                <label for="kecamatan">
                                    <h6>Pilih Alamat Kecamatan</h6>
                                </label>
                                <select class="form-select" name="kecamatan" id="kecamatan" required>
                                    <option value="" selected disabled>Pilih Kecamatan</option>
                                </select>
                                <img src="../../assets/loading.gif" width="35" id="load3" style="display:none;" />
                            </div>

                            <div class="form-group mb-3">
                                <label for="kelurahan">
                                    <h6>Pilih Alamat Kelurahan</h6>
                                </label>
                                <select class="form-select" name="kelurahan" id="kelurahan" required>
                                    <option value="" selected disabled>Pilih Kelurahan</option>
                                </select>
                                <img src="../../assets/loading.gif" width="35" id="load3" style="display:none;" />
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <input type="submit" class="btn btn-primary btn-send pt-2 btn-block " value="Buat Pekerjaan">
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