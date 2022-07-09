<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: public/home");
} else {
    header("Location: ");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../assets/logo-320.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="index.css" />
    <title>Jobskuy</title>
    <meta name="description" content="Jobskuy adalah website tempat kalian bisa mencari pekerjaan sampingan dan dapat menghasilkan uang. Ayo gunakan Jobskuy.">

    <!-- Google / Search Engine Tags -->
    <meta itemprop="name" content="Jobskuy - Cari Pekerjaan Sampingan">
    <meta itemprop="description" content="Jobskuy adalah website tempat kalian bisa mencari pekerjaan sampingan dan dapat menghasilkan uang. Ayo gunakan Jobskuy.">
    <meta itemprop="image" content="https://i.postimg.cc/VkJm2Mf7/logo-bg-white-320.png">

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="http://jobskuy.rf.gd">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Jobskuy - Cari Pekerjaan Sampingan">
    <meta property="og:description" content="Jobskuy adalah website tempat kalian bisa mencari pekerjaan sampingan dan dapat menghasilkan uang. Ayo gunakan Jobskuy.">
    <meta property="og:image" content="https://i.postimg.cc/VkJm2Mf7/logo-bg-white-320.png">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Jobskuy - Cari Pekerjaan Sampingan">
    <meta name="twitter:description" content="Jobskuy adalah website tempat kalian bisa mencari pekerjaan sampingan dan dapat menghasilkan uang. Ayo gunakan Jobskuy.">
    <meta name="twitter:image" content="https://i.postimg.cc/VkJm2Mf7/logo-bg-white-320.png">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm fixed-top" style="background-color: #f08425;">
        <div class="container">
            <a class="navbar-brand" href="">
                <img src="assets/logo-white.png" alt="" width="30" height="30" class="d-inline-block align-text-top">
                Jobskuy
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="public/login/">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="public/register/">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section>
        <div class="px-4 py-5 my-5 text-center">
            <img class="d-block mx-auto mb-1" src="assets/logo.png" alt="" width="120" height="120">
            <h1 class="display-5 fw-bold">Jobskuy</h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4">Jobskuy adalah website yang berfungsi untuk mempermudah masyarakat khususnya pengguna dalam memberi dan mencari pekerjaan. Selain itu, website ini juga langsung menampilkan list pekerjaan yang masih tersedia dan kisaran pendapatan yang akan diberikan secara langsung saat pekerjaan sudah selesai. Diharapkan website ini bisa membantu masyarakat khususnya pengguna dalam mencari dan memberi pekerjaan. </p>
            </div>
        </div>

        <div class="b-example-divider"></div>
    </section>

    <section>
        <div class="container col-xxl-8 px-4 py-5">
            <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                <div class="col-10 col-sm-8 col-lg-6">
                    <img src="assets/logo.png" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
                </div>
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold lh-1 mb-3">Temukan pekerjaan yang kamu suka</h1>
                    <p class="lead">Berbagai macam ragam perkerjaan dapat ditemukan di website ini. Seperti teknisi, service, programmer, dan lain-lainnya. Ayo daftar dan jadi bagian dari Jobskuy.</p>
                </div>
            </div>
        </div>

        <div class="b-example-divider"></div>

    </section>

    <section>
        <div class="px-4 py-5 my-5 text-center">
            <h1 class="display-5 fw-bold">Jobskuy Team</h1>
            <div class="col-lg-6 mx-auto">
                <div class="row justify-content-center">

                    <?php
                    for ($i = 0; $i < 5; $i++) {
                        $name = "";
                        $image = "";
                        if ($i == 0) {
                            $name = "Kurnia Akbar";
                            $image = "akbar.png";
                        } else if ($i == 1) {
                            $name = "Ahmad Faishal Albadri";
                            $image = "faishal.jpeg";
                        } else if ($i == 2) {
                            $name = "Bintang Arkaan Amin";
                            $image = "bintang.png";
                        } else if ($i == 3) {
                            $name = "Lalam Fathonah Fadhillah";
                            $image = "dilla.png";
                        } else if ($i == 4) {
                            $name = "Rafi Nurfaizi Herdiansyah";
                            $image = "rafi.png";
                        }
                    ?>
                        <div class="col-md-4 mt-4">
                            <div class="card">
                                <img src="assets/team/<?php echo $image ?>" class="img-fluid card-img-top" alt="" />
                                <div class="card-body">
                                    <h5 class="card-text text-center"><?php echo $name ?></h5>
                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dignissimos, reprehenderit.</p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#f08425" fill-opacity="1" d="M0,160L34.3,149.3C68.6,139,137,117,206,144C274.3,171,343,245,411,250.7C480,256,549,192,617,186.7C685.7,181,754,235,823,240C891.4,245,960,203,1029,170.7C1097.1,139,1166,117,1234,112C1302.9,107,1371,117,1406,122.7L1440,128L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
        </svg>
    </section>

    <!-- footer -->
    <footer class="text-white text-center pb-5" style="background-color: #f08425;">
        <p>Created by PT. Beyonders 2021</p>
    </footer>
</body>

</html>
</body>

</html>