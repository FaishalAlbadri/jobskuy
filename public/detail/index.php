<?php
require_once("../../config/auth.php");
require_once("../../config/config.php");

$id = "";
$idUser = "";
$userEmail = "";
$userName = "";
if ($_GET) {
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
    }
}

$result = mysqli_query($con, "SELECT * FROM project WHERE id_project = '$id'");
if ($result) {
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

        $avgprice = ($key['project_price_high'] + $key['project_price_low']) / 2;
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
            <title><?php echo $key['project_title']; ?></title>
            <link href="detail.css" rel="stylesheet">

        </head>

        <body>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
            <script src="../../library/BlockUI/jquery.blockUI.js"></script>

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
                        <div class="col-md-3">
                            <div class="position-sticky" style="top: 5rem;">
                                <img class="rounded" src="<?php echo $url_image; ?>" height="100%" width="100%" style="object-fit: cover;">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h3 id="titleproject"><?php echo $key['project_title']; ?></h3>
                            <p id="normalP" style="margin-top: -5px; margin-bottom: 4px"><i class="bi bi-geo-alt-fill text-secondary"></i> <small class="text-muted"><?php echo $key['project_address']; ?></small></p>
                            <p id="normalP"><i class="bi bi-clock-fill text-secondary"></i><small class=" text-muted"> <?php echo $create_date; ?></small></p>
                            <h2 id="bidrange" style="margin-top: 5px;"><?php echo "<b>" . $low . "</b> - <b>" . $high . "</b>"; ?></h2>
                            <hr class="rounded">
                            <p id="desc"><small class="text-muted">Deskripsi Pekerjaan</small></p>
                            <p style="margin-top: -5px;"><?php echo nl2br($key['project_description']); ?></p>
                            <hr class="rounded mb-3">
                        </div>

                        <div class="col-md-3">
                            <div class="position-sticky" style="top: 5rem;">
                                <div class="row justify-content fs-5">

                                    <div class="col-md-12 mb-3">
                                        <?php
                                        $idUser = $key['id_user'];
                                        $resultuser = mysqli_query($con, "SELECT * FROM user WHERE id_user = '$idUser'");
                                        if ($resultuser) {
                                            foreach ($resultuser as $keyuser) {
                                                $userName = $keyuser['user_name'];
                                                $userEmail = $keyuser['user_email'];
                                                $imgUser = $keyuser['user_image'];
                                                if (empty($imgUser)) {
                                                    $imgUser = "../../assets/profile/base.jpeg";
                                                } else {
                                                    $imgUser = "../../assets/profile/" . $keyuser['user_image'];
                                                }

                                                $bulan = array(1 =>   'Jan', 'Feb', 'Maret', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des');

                                                $userCreate = date('Y-m-d-H:i', strtotime($keyuser['user_created']));
                                                $split       = explode('-', $userCreate);
                                                $createduser = $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];
                                        ?>
                                                <div class="card">
                                                    <div class="card-header">
                                                        Tentang Pembuat
                                                    </div>
                                                    <div class="bg-white rounded shadow-sm py-3 px-1 text-center">
                                                        <img src="<?php echo $imgUser; ?>" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                                                        <h5 class="mb-0"><?php echo $keyuser['user_name']; ?></h5>
                                                        <div class="row justify-content" style="padding-right: 16px; padding-left: 16px;">
                                                            <div class="col mt-3">
                                                                <a href="../user/?id=<?php echo $idUser; ?>" class="btn btn-outline-dark" role="button" aria-pressed="true" style="width: 100%;">Lihat Profil</a>
                                                            </div>
                                                            <?php
                                                            $sessionIdUser = $_SESSION['user']['id_user'];
                                                            $checkBid = mysqli_query($con, "SELECT * FROM bid WHERE id_project = '$id' AND id_worker = '$sessionIdUser' AND bid_status = 'Accepted' OR id_project = '$id' AND id_worker = '$sessionIdUser' AND bid_status = 'Finished'");
                                                            $checkBidRow = mysqli_num_rows($checkBid);
                                                            if ($checkBidRow > 0) {
                                                            ?>
                                                                <div class="col mt-3">
                                                                    <a target="_blank" href="https://wa.me/<?php echo $keyuser['user_phone']; ?>" class="btn btn-outline-success" role="button" aria-pressed="true" style="width: 100%;">Whatsapp</a>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>

                                    <div class="col-md-12">
                                        <?php
                                        $sessionIdUser = $_SESSION['user']['id_user'];
                                        $checkBid = mysqli_query($con, "SELECT * FROM bid WHERE id_project = '$id' AND id_worker = '$sessionIdUser'");
                                        $checkBidRow = mysqli_num_rows($checkBid);
                                        if ($checkBidRow > 0) {
                                            foreach ($checkBid as $keybid) {
                                                $statusbid = $keybid['bid_status'];
                                                $bidPrice = "Rp " . number_format($keybid['bid_price'], 0, ',', '.');
                                                if ($statusbid == "Bid") {
                                        ?>
                                                    <div class="card">
                                                        <div class="card-header">
                                                            Tawar Pekerjaan
                                                        </div>
                                                        <div class="card-body">
                                                            <p><small class="text-muted" style="font-size: 85%;">Status : Sedang Menawar</small></p>
                                                            <p style="margin-top: -8px;">Kamu telah menawar pekerjaan ini dengan pendapatan sebesar <br><b><?php echo $bidPrice; ?></b></p>
                                                        </div>
                                                    </div>
                                                <?php
                                                } else if ($statusbid == "Accepted") {
                                                ?>
                                                    <div class="card">
                                                        <div class="card-header">
                                                            Tawar Pekerjaan
                                                        </div>
                                                        <div class="card-body">
                                                            <p><small class="text-muted" style="font-size: 85%;">Status : Bekerja</small></p>
                                                            <p style="margin-top: -8px;">Kamu diterima untuk bekerja dengan pendapatan <br> <b><?php echo $bidPrice; ?></b></p>
                                                            <p>Bekerjalah secara serius dan amanah. Terima Kasih.</p>
                                                        </div>
                                                    </div>
                                                <?php
                                                } else if ($statusbid == "Declined") {
                                                ?>
                                                    <div class="card">
                                                        <div class="card-header">
                                                            Tawar Pekerjaan
                                                        </div>
                                                        <div class="card-body">
                                                            <p><small class="text-muted" style="font-size: 85%;">Status : Ditolak</small></p>
                                                            <p style="margin-top: -8px;">Mohon maaf sepertinya kamu belum terpilih. Tetap semangat dan jangan putus asa. Ayo cari pekerjaan lain !</p>
                                                        </div>
                                                    </div>
                                                <?php
                                                } else if ($statusbid == "Finished") {
                                                ?>
                                                    <div class="card">
                                                        <div class="card-header">
                                                            Tawar Pekerjaan
                                                        </div>
                                                        <div class="card-body">
                                                            <p><small class="text-muted" style="font-size: 85%;">Status : Selesai</small></p>
                                                            <p style="margin-top: -8px;">Kamu telah menerima pendapatan sebesar <br><b><?php echo $bidPrice; ?></b></p>
                                                            <p>Terima kasih telah berpartisipasi dalam membantu layanan Jobskuy.</p>
                                                        </div>
                                                    </div>
                                                <?php
                                                }
                                            }
                                        } else {
                                            if ($idUser != $sessionIdUser) {
                                                ?>
                                                <div class="card">
                                                    <div class="card-header">
                                                        Tawar Pekerjaan
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="slidecontainer mb-3">
                                                            <input type="range" min="<?php echo $key['project_price_low']; ?>" max="<?php echo $key['project_price_high']; ?>" value="<?php echo $avgprice; ?>" class="slider" id="bidSlider">
                                                        </div>
                                                        <a id="bidPrice" class="btn btn-lg" onclick="return bid('<?php echo $id; ?>', '<?php echo $userEmail; ?>', '<?php echo $userName; ?>' , '<?php echo $key['project_title']; ?>')" role="button" aria-disabled="true" style="width: 100%; background-color: #f08425; color: white;"></a>
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
            <script src="detail.js"></script>

        </body>

        </html>

<?php
    }
}
?>