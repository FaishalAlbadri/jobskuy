<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: ../home");
} else {
    header("Location: ");
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="../../assets/logo-320.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <title>Registrasi</title>
</head>

<body>

    <section class="vh-100" style="background-color: #f08425;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="../../assets/kampusuii.jpeg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form method="POST" action="register.php">

                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                        </div>

                                        <h5 class="fw-normal mb-1 pb-3" style="letter-spacing: 1px;">Signup account</h5>

                                        <div class="form-outline mb-2">
                                            <label class="form-label" for="">Username</label>
                                            <input type="text" name="username" class="form-control form-control-lg" />
                                        </div>

                                        <div class="form-outline mb-2">
                                            <label class="form-label" for="">Nomor Telephone</label>
                                            <input type="text" name="phone" class="form-control form-control-lg" />
                                        </div>

                                        <div class="form-outline mb-2">
                                            <label class="form-label" for="">Email</label>
                                            <input type="email" name="email" class="form-control form-control-lg" />
                                        </div>

                                        <div class="form-outline mb-3">
                                            <label class="form-label" for="">Password</label>
                                            <input type="password" name="password" class="form-control form-control-lg" />
                                        </div>

                                        <div class="pt-1 mb-2">
                                            <input class="btn btn-lg" style="background-color: #f08425; color: white;" type="submit" value="Registrasi">
                                        </div>

                                        <p class="mb-3 pb-lg-2" style="color: #393f81;">Already have an account? <a href="../login/" style="color: #393f81;">Sign in</a></p>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>