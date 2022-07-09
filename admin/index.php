<?php
session_start();
if (!isset($_SESSION['adminjobskuy'])) header("Location: login/");
require_once("../config/config.php");
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/argon/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/logo-320.png">
    <title> Dashboard Admin Jobskuy </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../assets/argon/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/argon/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/argon/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/argon/css/argon-dashboard.css?v=2.0.3" rel="stylesheet" /> </head>

  <body>
    <div class="min-height-300 position-absolute w-100" style="background-color: #f08425;"></div>
    <main class="main-content position-relative border-radius-lg ">
      <!-- Navbar -->
      <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
        <div class="container-fluid py-1 px-3">
          <nav aria-label="breadcrumb">
            <h6 class="font-weight-bolder text-white mb-0">Dashboard</h6> </nav>
          <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <ul class="ms-md-auto navbar-nav  justify-content-end">
              <li class="nav-item d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-white font-weight-bold px-0">
                  <!-- <i class="fa fa-user me-sm-1"></i> -->
                  <span class="d-sm-inline d-none"> <?php echo ucfirst($_SESSION['adminjobskuy']['admin_name']); ?> </span> 
                </a>
              </li>
              <li class="nav-item d-flex align-items-center" style="margin-left: 24px;">
                <a href="#" class="nav-link text-white font-weight-bold px-0" data-bs-toggle="modal" data-bs-target="#modalLogout"> 
                  <span class="d-sm-inline d-none">Logout</span> 
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="container-fluid py-4">
        <div class="row">
        <?php
          $result = mysqli_query($con, "SELECT SUM(bid.bid_price) 'total_pendapatan' FROM bid WHERE bid.bid_status = 'Finished' AND MONTH(bid.bid_create) = MONTH(CURRENT_DATE()) AND YEAR(bid.bid_create) = YEAR(CURRENT_DATE())");
          if ($result) {
            foreach ($result as $key) {
              $totalpendapatan = "Rp " . number_format($key['total_pendapatan'], 0,',','.');
              $profit = $key['total_pendapatan'] * 12 / 100;
              $totalprofit = "Rp " . number_format($profit, 0,',','.');
        ?>
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-sm mb-0 text-uppercase font-weight-bold">Transaction</p>
                      <h5 class="font-weight-bolder"><?php echo $totalpendapatan;?></h5>
                      <p class="mb-0"> 
                        Revenue Transaction
                      </p>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle"> 
                      <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-sm mb-0 text-uppercase font-weight-bold">Jobskuy Profit</p>
                      <h5 class="font-weight-bolder"> <?php echo $totalprofit; ?> </h5>
                      <p class="mb-0"> 
                        Profit From Transaction
                      </p>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle"> 
                      <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-sm mb-0 text-uppercase font-weight-bold">Active Project</p>
                      <?php
                        $result = mysqli_query($con, "SELECT Count(*) 'project' FROM project WHERE project.project_status = 'Waiting'");
                        if ($result) {
                            foreach ($result as $key) {
                      ?>
                      <h5 class="font-weight-bolder"> <?php echo $key['project'];?> </h5>
                      <?php 
                            }
                        }
                      ?>
                      <p class="mb-0"> Available Project on Web </p>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle"> 
                      <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6">
            <div class="card">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-sm mb-0 text-uppercase font-weight-bold">Active Users</p>
                      <?php
                        $result = mysqli_query($con, "SELECT Count(*) 'user' FROM user");
                        if ($result) {
                            foreach ($result as $key) {
                      ?>
                      <h5 class="font-weight-bolder"> <?php echo $key['user'];?> </h5>
                      <?php 
                            }
                        }
                      ?>
                      <p class="mb-0"> 
                        All User Jobskuy
                      </p>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle"> 
                      <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i> 
                    </div>
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
        <div class="row mt-4">
          <div class="col-lg-6 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
              <div class="card-header pb-0 pt-3 bg-transparent">
                <div class="row">
                  <div class="col-md-8 col-sm-6">
                    <h6 class="text-capitalize">Transaction overview</h6>
                    <p class="text-sm mb-0"> 
                      <i class="fa fa-arrow-up text-success"></i> 
                      <span class="font-weight-bold">10% more</span> in 2022 
                    </p>
                  </div>
                  <div class="col-md-4 col-sm-6">
                    <div class="nav-wrapper position-relative end-0">
                      <ul class="nav nav-pills nav-fill p-1" role="tablist">
                        <li class="nav-item" onclick="monthTransaction();">
                          <a class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center"  data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">
                            <span class="ms-2">Month</span>
                          </a>
                        </li>
                        <li class="nav-item" onclick="weekTransaction();">
                          <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center" data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                            <span class="ms-2">Week</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body p-3">
                <div class="chart">
                  <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
              <div class="card-header pb-0 pt-3 bg-transparent">
                <div class="row">
                  <div class="col-md-8 col-sm-6">
                    <h6 class="text-capitalize">Profit overview</h6>
                    <p class="text-sm mb-0"> 
                      <i class="fa fa-arrow-up text-success"></i> 
                      <span class="font-weight-bold">10% more</span> in 2022 
                    </p>
                  </div>
                  <div class="col-md-4 col-sm-6">
                    <div class="nav-wrapper position-relative end-0">
                      <ul class="nav nav-pills nav-fill p-1" role="tablist">
                        <li class="nav-item" onclick="monthProfit();">
                          <a class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center"  data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">
                            <span class="ms-2">Month</span>
                          </a>
                        </li>
                        <li class="nav-item" onclick="weekProfit();">
                          <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center" data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                            <span class="ms-2">Week</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body p-3">
                <div class="chart">
                  <canvas id="chart-line2" class="chart-canvas" height="300"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-lg-7 mb-lg-0 mb-4">
            <div class="card ">
              <div class="card-header pb-0 p-3">
                <div class="row">
                  <div class="col-6 d-flex align-items-center">
                    <h6 class="mb-0">Admin Jobskuy</h6> 
                  </div>
                  <div class="col-6 text-end">
                    <button class="btn btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#modalAddAdmin" style="background-color: #f08425; color: white;">Add New</button>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table align-items-center ">
                  <tbody>
                    <?php
                      $result = mysqli_query($con, "SELECT * FROM admin ORDER BY admin_name ASC");
                      if ($result) {
                        foreach ($result as $key) {
                      ?>
                      <tr>
                        <td class="w-30">
                          <div class="d-flex px-2 py-1 align-items-center">
                            <div> 
                              <img src="../assets/profile/<?php echo $key['admin_image']; ?>" alt="admin image" width="32" height="32" style="border-radius: 25%;"> 
                            </div>
                            <div class="ms-4">
                              <p class="text-xs font-weight-bold mb-0">Nama:</p>
                              <h6 class="text-sm mb-0"> <?php echo $key['admin_name']; ?> </h6> 
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="ms-4">
                            <p class="text-xs font-weight-bold mb-0">Email:</p>
                            <h6 class="text-sm mb-0"> <?php echo $key['admin_email']; ?> </h6> 
                          </div>
                        </td>
                        <td>
                          <div class="ms-4">
                            <p class="text-xs font-weight-bold mb-0">No Telp:</p>
                            <h6 class="text-sm mb-0"> <?php echo $key['admin_phone']; ?> </h6> 
                          </div>
                        </td>
                        <td>
                          <div class="text-end">
                            <a class="btn btn-link text-dark px-3 mb-0" href="#" data-bs-toggle="modal" data-bs-target="#modalUpdateAdmin<?php echo $key['id_admin']; ?>"> <i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit </a>
                            <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="#" data-bs-toggle="modal" data-bs-target="#modalDeleteAdmin<?php echo $key['id_admin']; ?>"> <i class="far fa-trash-alt me-2"></i>Delete </a>
                          </div>
                        </td>
                      </tr>
                      <div class="modal fade" id="modalDeleteAdmin<?php echo $key['id_admin'];?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel">Delete Admin</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body"> Yakin ingin menghapus admin '
                              <?php echo $key['admin_name'];?>' ? 
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                              <a href="api/deleteAdmin.php?id=<?php echo $key['id_admin'];?>">
                                <button type="button" class="btn btn-primary">Delete</button>
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal fade" id="modalUpdateAdmin<?php echo $key['id_admin'];?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel">Add Admin</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form action="api/updateAdmin.php" method="POST" enctype="multipart/form-data">
                                <div class="container">
                                  <div class="form-group mb-3">
                                    <label for="admin_name">
                                      <h6>Admin Name</h6>
                                    </label>
                                    <input type="hidden" name="id_admin" value="<?php echo $key['id_admin']?>">
                                    <input type="text" name="admin_name" placeholder="Admin Name" required class="form-control" value="<?php echo $key['admin_name']?>"> 
                                  </div>
                                  <div class="form-group mb-3">
                                    <label for="admin_email">
                                      <h6>Admin Email</h6>
                                    </label>
                                    <input type="email" name="admin_email" placeholder="Admin Email" required class="form-control" value="<?php echo $key['admin_email']?>"> 
                                  </div>
                                  <div class="form-group mb-3">
                                    <label for="admin_phone">
                                      <h6>Admin Phone</h6>
                                    </label>
                                    <input type="text" name="admin_phone" placeholder="Admin Phone" required class="form-control" value="<?php echo $key['admin_phone']?>"> 
                                  </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                              <input type="submit" class="btn btn-primary btn-send pt-2 btn-block " value="Submit"> </div>
                          </div>
                          </form>
                        </div>
                      </div>
              </div>
              <?php
                        }
                      }
                    ?>
                </tbody>
                </table>
            </div>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="card">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-6 d-flex align-items-center">
                  <h6 class="mb-0">Categories Job</h6> </div>
                <div class="col-6 text-end">
                  <button class="btn btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#modalAddCategories" style="background-color: #f08425; color: white;">Add New</button>
                </div>
              </div>
            </div>
            <div class="card-body p-3">
              <ul class="list-group">
                <?php
                    $result = mysqli_query($con, "SELECT * FROM project_category ORDER BY project_category_name ASC");
                    if ($result) {
                      foreach ($result as $key) {
                    ?>
                  <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                    <div class="d-flex align-items-center">
                      <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center"> <i class="ni ni-mobile-button text-white opacity-10"></i> </div>
                      <div class="d-flex flex-column">
                        <h6 class="mb-1 text-dark text-sm"> <?php echo $key['project_category_name']; ?> </h6> </div>
                    </div>
                    <div class="d-flex text-end">
                      <a class="btn btn-link text-dark px-3 mb-0" href="#" data-bs-toggle="modal" data-bs-target="#modalUpdateCategories<?php echo $key['id_project_category']; ?>"> <i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit </a>
                      <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="#" data-bs-toggle="modal" data-bs-target="#modalDeleteCategories<?php echo $key['id_project_category']; ?>"> <i class="far fa-trash-alt me-2"></i>Delete </a>
                    </div>
                  </li>
                  <div class="modal fade" id="modalDeleteCategories<?php echo $key['id_project_category'];?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="staticBackdropLabel">Delete Category</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body"> 
                          Yakin ingin menghapus kategori '<?php echo $key['project_category_name'];?>' ? 
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <a href="api/deleteCategory.php?id=<?php echo $key['id_project_category'];?>">
                            <button type="button" class="btn btn-primary">Delete</button>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal fade" id="modalUpdateCategories<?php echo $key['id_project_category']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="staticBackdropLabel">Update Categories</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="background: #f5f5f5;">
                          <form action="api/updateCategory.php" method="POST" enctype="multipart/form-data">
                            <div class="container">
                              <div class="form-group mb-3">
                                <label for="project_category_name">
                                  <h6>Category Name</h6> </label>
                                <input type="hidden" name="id_project_category" value="<?php echo$key['id_project_category']?>">
                                <input type="text" name="project_category_name" placeholder="Category Name" value="<?php echo$key['project_category_name']?>" required class="form-control"> </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <input type="submit" class="btn btn-primary btn-send pt-2 btn-block " value="Submit"> </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <?php
                      }
                    }
                  ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer pt-3  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start"> ©
                <script>
                document.write(new Date().getFullYear())
                </script>, created by PT. Beyonders </div>
            </div>
          </div>
        </div>
      </footer>
      </div>
    </main>
    <!--   Core JS Files   -->
    <script src="../assets/argon/js/core/popper.min.js"></script>
    <script src="../assets/argon/js/core/bootstrap.min.js"></script>
    <script src="../assets/argon/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/argon/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/argon/js/plugins/chartjs.min.js"></script>
    <script>
    const api_url = "https://jobskuy.rf.gd/admin/api/chart.php";
    const api_url_weeek = "https://jobskuy.rf.gd/admin/api/chartweek.php";

    let jan = 0;
    let feb = 0;
    let mar = 0;
    let apr = 0;
    let may = 0;
    let jun = 0;
    let jul = 0;
    let aug = 0;
    let sep = 0;
    let oct = 0;
    let nov = 0;
    let des = 0;

    let janProfit = 0;
    let febProfit = 0;
    let marProfit = 0;
    let aprProfit = 0;
    let mayProfit = 0;
    let junProfit = 0;
    let julProfit = 0;
    let augProfit = 0;
    let sepProfit = 0;
    let octProfit = 0;
    let novProfit = 0;
    let desProfit = 0;

    let seninVal = 0;
    let selasaVal = 0;
    let rabuVal = 0;
    let kamisVal = 0;
    let jumatVal = 0;
    let sabtuVal = 0;
    let mingguVal = 0;

    let seninValProfit = 0;
    let selasaValProfit = 0;
    let rabuValProfit = 0;
    let kamisValProfit = 0;
    let jumatValProfit = 0;
    let sabtuValProfit = 0;
    let mingguValProfit = 0;


    let profit = 12;

    var chartIDTransaction;
    var chartIDProfit;

    async function getapiWeek(url) {
      const response = await fetch(url);
      var data = await response.json();

      for (let r of data) {
        var db_date = new Date(r.date.replace(/-/g,"/"));
        const date = new Date(db_date);
        const day = date.toLocaleString('default', {weekday: 'long'});

        if (day == "Monday") {

          seninVal = r.count
          seninValProfit = seninVal * profit / 100;

        } else if (day == "Tuesday") {

          selasaVal = r.count
          selasaValProfit = selasaVal * profit / 100;

        } else if (day == "Wednesday") {

          rabuVal = r.count
          rabuValProfit = rabuVal * profit / 100;
          
        } else if (day == "Thursday") {

          kamisVal = r.count
          kamisValProfit = kamisVal * profit / 100;
          
        } else if (day == "Friday") {

          jumatVal = r.count
          jumatValProfit = jumatVal * profit / 100;
          
        } else if (day == "Saturday") {

          sabtuVal = r.count
          sabtuValProfit = sabtuVal * profit / 100;
          
        } else if (day == "Sunday") {

          mingguVal = r.count
          mingguValProfit = mingguVal * profit / 100;
          
        }
      }
    }

    getapiWeek(api_url_weeek);

    async function getapi(url) {
      const response = await fetch(url);
      var data = await response.json();
      

        for (let r of data) {
          var db_date = new Date(r.date.replace(/-/g,"/"));
      const date = new Date(db_date);
      const month = date.toLocaleString('default', {month: 'long'});
      if (month == "January") {
            jan = r.count
            janProfit = jan * profit / 100;
      } else if (month == "February") {
            feb = r.count
            febProfit = feb * profit / 100;
      } else if (month == "March") {
            mar = r.count
            marProfit = mar * profit / 100;
      } else if (month == "April") {
            apr = r.count
            aprProfit = apr * profit / 100;
      } else if (month == "May") {
            may = r.count
            mayProfit = may * profit / 100;
      } else if (month == "June") {
            jun = r.count
            junProfit = jun * profit / 100;
      } else if (month == "July") {
            jul = r.count
            julProfit = jul * profit / 100;
      } else if (month == "August") {
            aug = r.count
            augProfit = aug * profit / 100;
      } else if (month == "September") {
            sep = r.count
            sepProfit = sep * profit / 100;
      } else if (month == "October") {
            oct = r.count
            octProfit = oct * profit / 100;
      } else if (month == "November") {
            nov = r.count
            novProfit = nov * profit / 100;
      } else if (month == "December") {
            des = r.count
            desProfit = des * profit / 100;
      }
    }

    var ctx1 = document.getElementById("chart-line").getContext("2d");
    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);
    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
    chartIDTransaction = new Chart(ctx1, {
      type: "line",
      data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Transaction",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#5e72e4",
          backgroundColor: gradientStroke1,
          borderWidth: 3,
          fill: true,
          data: [jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, des],
          maxBarThickness: 6
        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#5e72e4',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#ccc',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });

    var ctx1 = document.getElementById("chart-line2").getContext("2d");
    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);
    gradientStroke1.addColorStop(1, 'rgba(240, 132, 37, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(240, 132, 37, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(240, 132, 37, 0)');
    chartIDProfit = new Chart(ctx1, {
      type: "bar",
      data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Profit",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#f08425",
          backgroundColor: gradientStroke1,
          borderWidth: 3,
          fill: true,
          data: [janProfit, febProfit, marProfit, aprProfit, mayProfit, junProfit, julProfit, augProfit, sepProfit, octProfit, novProfit, desProfit],
          maxBarThickness: 6
        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#f08425',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#f08425',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
    }
    getapi(api_url);

    function monthTransaction() {
      if(chartIDTransaction){
          chartIDTransaction.destroy();
      }
      var ctx1 = document.getElementById("chart-line").getContext("2d");
      var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);
      gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
      gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
      gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
      chartIDTransaction = new Chart(ctx1, {
        type: "line",
        data: {
          labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          datasets: [{
            label: "Transaction",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#5e72e4",
            backgroundColor: gradientStroke1,
            borderWidth: 3,
            fill: true,
            data: [jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, des],
            maxBarThickness: 6
          }],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false,
            }
          },
          interaction: {
            intersect: false,
            mode: 'index',
          },
          scales: {
            y: {
              grid: {
                drawBorder: false,
                display: true,
                drawOnChartArea: true,
                drawTicks: false,
                borderDash: [5, 5]
              },
              ticks: {
                display: true,
                padding: 10,
                color: '#5e72e4',
                font: {
                  size: 11,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
              }
            },
            x: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
                borderDash: [5, 5]
              },
              ticks: {
                display: true,
                color: '#ccc',
                padding: 20,
                font: {
                  size: 11,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
              }
            },
          },
        },
      });
    }

    function weekTransaction() {
      if(chartIDTransaction){
          chartIDTransaction.destroy();
      }
      var ctx1 = document.getElementById("chart-line").getContext("2d");
      var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);
      gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
      gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
      gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
      chartIDTransaction = new Chart(ctx1, {
        type: "line",
        data: {
          labels: ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"],
          datasets: [{
            label: "Transaction",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#5e72e4",
            backgroundColor: gradientStroke1,
            borderWidth: 3,
            fill: true,
            data: [seninVal, selasaVal, rabuVal, kamisVal, jumatVal, sabtuVal, mingguVal],
            maxBarThickness: 6
          }],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false,
            }
          },
          interaction: {
            intersect: false,
            mode: 'index',
          },
          scales: {
            y: {
              grid: {
                drawBorder: false,
                display: true,
                drawOnChartArea: true,
                drawTicks: false,
                borderDash: [5, 5]
              },
              ticks: {
                display: true,
                padding: 10,
                color: '#5e72e4',
                font: {
                  size: 11,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
              }
            },
            x: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
                borderDash: [5, 5]
              },
              ticks: {
                display: true,
                color: '#ccc',
                padding: 20,
                font: {
                  size: 11,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
              }
            },
          },
        },
      });
    }

    function monthProfit() {
      if(chartIDProfit){
          chartIDProfit.destroy();
      }
      var ctx1 = document.getElementById("chart-line2").getContext("2d");
      var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);
      gradientStroke1.addColorStop(1, 'rgba(240, 132, 37, 0.2)');
      gradientStroke1.addColorStop(0.2, 'rgba(240, 132, 37, 0.0)');
      gradientStroke1.addColorStop(0, 'rgba(240, 132, 37, 0)');
      chartIDProfit = new Chart(ctx1, {
        type: "bar",
        data: {
          labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          datasets: [{
            label: "Profit",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#f08425",
            backgroundColor: gradientStroke1,
            borderWidth: 3,
            fill: true,
            data: [janProfit, febProfit, marProfit, aprProfit, mayProfit, junProfit, julProfit, augProfit, sepProfit, octProfit, novProfit, desProfit],
            maxBarThickness: 6
          }],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false,
            }
          },
          interaction: {
            intersect: false,
            mode: 'index',
          },
          scales: {
            y: {
              grid: {
                drawBorder: false,
                display: true,
                drawOnChartArea: true,
                drawTicks: false,
                borderDash: [5, 5]
              },
              ticks: {
                display: true,
                padding: 10,
                color: '#f08425',
                font: {
                  size: 11,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
              }
            },
            x: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
                borderDash: [5, 5]
              },
              ticks: {
                display: true,
                color: '#ccc',
                padding: 20,
                font: {
                  size: 11,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
              }
            },
          },
        },
      });
    }

    function weekProfit() {
      if(chartIDProfit){
          chartIDProfit.destroy();
      }
      var ctx1 = document.getElementById("chart-line2").getContext("2d");
      var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);
      gradientStroke1.addColorStop(1, 'rgba(240, 132, 37, 0.2)');
      gradientStroke1.addColorStop(0.2, 'rgba(240, 132, 37, 0.0)');
      gradientStroke1.addColorStop(0, 'rgba(240, 132, 37, 0)');
      chartIDProfit = new Chart(ctx1, {
        type: "bar",
        data: {
          labels: ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"],
          datasets: [{
            label: "Profit",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#f08425",
            backgroundColor: gradientStroke1,
            borderWidth: 3,
            fill: true,
            data: [seninValProfit, selasaValProfit, rabuValProfit, kamisValProfit, jumatValProfit, sabtuValProfit, mingguValProfit],
            maxBarThickness: 6
          }],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false,
            }
          },
          interaction: {
            intersect: false,
            mode: 'index',
          },
          scales: {
            y: {
              grid: {
                drawBorder: false,
                display: true,
                drawOnChartArea: true,
                drawTicks: false,
                borderDash: [5, 5]
              },
              ticks: {
                display: true,
                padding: 10,
                color: '#f08425',
                font: {
                  size: 11,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
              }
            },
            x: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
                borderDash: [5, 5]
              },
              ticks: {
                display: true,
                color: '#ccc',
                padding: 20,
                font: {
                  size: 11,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
              }
            },
          },
        },
      });
    }
    </script>
    <div class="modal fade" id="modalLogout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Logout Account</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body"> Yakin ingin keluar dari akun ini? </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <a href="../config/logoutadmin.php">
              <button type="button" class="btn btn-primary">Keluar</button>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modalAddCategories" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Add Category</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="api/addCategory.php" method="POST" enctype="multipart/form-data">
              <div class="container">
                <div class="form-group mb-3">
                  <label for="project_category_name">
                    <h6>Category Name</h6></label>
                  <input type="text" name="project_category_name" placeholder="Category Name" required class="form-control"> </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <input type="submit" class="btn btn-primary btn-send pt-2 btn-block " value="Submit"> </div>
        </div>
        </form>
      </div>
    </div>
    </div>
    <div class="modal fade" id="modalAddAdmin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Add Admin</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="api/addAdmin.php" method="POST" enctype="multipart/form-data">
              <div class="container">
                <div class="form-group mb-3">
                  <label for="admin_name">
                    <h6>Admin Name</h6></label>
                  <input type="text" name="admin_name" placeholder="Admin Name" required class="form-control"> </div>
                <div class="form-group mb-3">
                  <label for="admin_email">
                    <h6>Admin Email</h6></label>
                  <input type="email" name="admin_email" placeholder="Admin Email" required class="form-control"> </div>
                <div class="form-group mb-3">
                  <label for="admin_phone">
                    <h6>Admin Phone</h6></label>
                  <input type="text" name="admin_phone" placeholder="Admin Phone" required class="form-control"> </div>
                <div class="form-group mb-3">
                  <label for="admin_password">
                    <h6>Admin Password</h6></label>
                  <input type="Password" name="admin_password" placeholder="Admin Password" required class="form-control"> </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <input type="submit" class="btn btn-primary btn-send pt-2 btn-block " value="Submit"> </div>
        </div>
        </form>
      </div>
    </div>
    </div>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/argon/js/argon-dashboard.min.js?v=2.0.3"></script>
  </body>

  </html>