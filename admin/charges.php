<?php
session_start();
if(!isset($_SESSION["session_admin_username"]))
{
  header("Location:admin/login");
}
error_reporting(0);
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Admin Dashboard - Charges</title>
  <!-- Favicon -->
  <link href="./assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="./assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="./assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="./assets/css/argon.css?v=1.0.0" rel="stylesheet">
  <link type="text/css" href="./assets/css/custom.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">

</head>

<body>
  <!-- Sidenav -->
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
     <a class="navbar-brand pt-0 mx-auto text-center" href="./index">
        <img src="./assets/img/brand/icon-new.png" class="logo-img" alt="">
        <h2 class="logo-text">Sri Sai Sri Transport</h2>
      </a>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-10 collapse-brand text-center mx-auto">
              <a href="./index">
                 <img src="./assets/img/brand/logo-new.png" class="logo-img" alt="">
              </a>
            </div>
            <div class="col-2 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <!-- Form -->

       <!-- Navigation -->
       <?php include 'menu.php';?>
        <!-- Navigation -->
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#"><i class="fas fa-bars menu-icon shadow-lg"></i>Charges</a>
        <h4 class="branch-text" data-branch-id="<?php echo $_SESSION["session_branch_id"] ?>">Branch : <?php echo $_SESSION["session_branch"] ?></h4>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold"><?php echo $_SESSION["session_admin_username"] ?></span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div>
              <a href="profile.php" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>My profile</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="logout.php" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->

        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">Hamali Chage: <span class="text-primary"><i class="fas fa-rupee-sign pr-2 pl-2"></i><span class="hamali_charge">00.00</span></span></h3>
            </div>
            <hr class="pt-0 pb-0 mb-0 mt-0">
            <div class="card-body">
              <form id="hamliForm">
                <div class="row">
                  <div class="col-md-4 hide">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Hamali id</label>
                      <input id="hamali_charge_id" name="hamali_charge_id" type="text" class="form-control" placeholder="Enter Hamali Charges id">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">No. of. Packages</label>
                      <input id="no_of_packages" name="no_of_packages" value="1" type="text" class="form-control" placeholder="Enter No. of. Packages">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Hamali Charges</label>
                      <input id="hamali_charge" name="hamali_charge" type="text" class="form-control" placeholder="Enter Hamali Charges">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block mt-32">Save</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
      <div class="row mt-5">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">S C Charge: <span class="text-primary"><i class="fas fa-rupee-sign pr-2 pl-2"></i><span class="sc_charge">00.00</span></span></h3>
            </div>
            <hr class="pt-0 pb-0 mb-0 mt-0">
            <div class="card-body">
              <form id="sc_chargesForm">
                <div class="row">
                  <div class="col-md-4 hide">
                    <div class="form-group">
                      <label for="exampleInputEmail1">sc_charge_id</label>
                      <input id="sc_charge_id" name="sc_charge_id" class="form-control" placeholder="Enter No. of. Packages">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Consignment value</label>
                      <input id="consignment_value" name="consignment_value" type="text" class="form-control" placeholder="Enter consignment value">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">S C Charges</label>
                      <input id="sc_charge" name="sc_charge" type="text" class="form-control" placeholder="Enter S C Charges">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block mt-32">Save</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
      <div class="row mt-5">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">Policy: <span class="text-primary"><i class="fas fa-info-circle pr-2 pl-2"></i><span class="policy_name"> </span></span></h3>
            </div>
            <hr class="pt-0 pb-0 mb-0 mt-0">
            <div class="card-body">
              <form id="policyForm">
                <div class="row">
                  <div class="col-md-8 hide">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Policy id</label>
                      <input id="policy_id" name="policy_id" type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Policy</label>
                      <input id="policy_name" name="policy_name" type="text" class="form-control" placeholder="Ex: Subject to Banglore Jurisdiction">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block mt-32">Save</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
      <!-- Footer -->
      <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              &copy; 2019 <a href="#" class="font-weight-bold ml-1" target="_blank">Sri Sai Sri Transport</a>
            </div>
          </div>
          <div class="col-xl-6">
            <ul class="nav nav-footer justify-content-center justify-content-xl-end">
              <li class="nav-item">
                <a href="#" class="nav-link" target="_blank">GSTIN: Ap: 37AEGFS8998P1zL, Ts: 36AEGFS8998P1ZN</a>
              </li>
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>


  <div class="modal" tabindex="-1" role="dialog" id="adminModal">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title">Create Admin</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="" action="index" method="post">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Username</label>
                  <input name="username" type="text" class="form-control" placeholder="Enter username">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Password</label>
                  <input name="password" type="password" class="form-control" placeholder="Enter password">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Name</label>
                  <input name="name" type="text" class="form-control" placeholder="Enter name">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Email</label>
                  <input name="email" type="email" class="form-control" placeholder="Enter email">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Phone</label>
                  <input name="phone" type="text" class="form-control" placeholder="Enter phone">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Address</label>
                  <input name="address" type="text" class="form-control" placeholder="Enter address">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>

      </div>
    </div>
  </div>


  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="./assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="./assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="./assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="./assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="./assets/js/argon.js?v=1.0.0"></script>
  <script src="./assets/js/sweetalert.min.js"></script>
  <script src="./assets/js/jquery.validate.min.js"></script>
  <script src="./assets/scripts/util.js"></script>
  <script src="./assets/scripts/charges.js"></script>
</body>
</body>

</html>
