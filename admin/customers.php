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
  <title>Admin Dashboard - Customers</title>
  <!-- Favicon -->
  <link href="./assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.css" />

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
        <h2 class="logo-text">Sri Sai Cargo</h2>
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#"><i class="fas fa-bars menu-icon shadow-lg"></i>Customers</a>
        <h4 class="branch-text" data-branch-id="<?php echo $_SESSION["session_branch_id"] ?>">Branch : <?php echo $_SESSION["session_branch"] ?></h4>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="./assets/img/profile-image/<?php echo $_SESSION["session_admin_profile"] ?>">
                </span>
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

        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">Customers List Table</h3>
            </div>
            <div class="table-responsive">
              <table id="customersTable" class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Customer Id</th>
                    <th scope="col">Consignor Name & Address</th>
                    <th scope="col">Consignor Phone</th>
                    <th scope="col">Consignee Name & Add</th>
                    <th scope="col">Consignee Phone</th>
                    <th scope="col">Actions</th>

                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              &copy; 2021 <a href="#" class="font-weight-bold ml-1" target="_blank">Sri Sai Cargo</a>
            </div>
          </div>
          <div class="col-xl-6">
            <ul class="nav nav-footer justify-content-center justify-content-xl-end">
              <li class="nav-item">
                <a href="#" class="nav-link" target="_blank">GSTIN: 29AKZPM2385H1ZB</a>
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

  <div class="modal" tabindex="-1" id="editCustomer">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Edit Customer</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="edit-customer-form">
      <div class="modal-body">
        
      <div class="row">
      <div class="col-md-6 hide">
          <div class="form-group">
            <label>Customer id</label>
            <input id="customer_id" type="text" class="form-control" name="customer_id">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Consignor Name & Address</label>
            <input type="text" class="form-control" name="consignor_name">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Consignor Phone</label>
            <input type="text" class="form-control" name="consignor_phone">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Consignee Name & Address</label>
            <input type="text" class="form-control" name="consignee_name">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Consignee Phone</label>
            <input type="text" class="form-control" name="consignee_phone">
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
  <script type="text/javascript"
    src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.js"></script>
  <!-- Optional JS -->
  <script src="./assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="./assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="./assets/js/sweetalert.min.js"></script>
  <script src="./assets/js/jquery.validate.min.js"></script>
  <script src="./assets/scripts/util.js"></script>
  <script src="./assets/js/argon.js?v=1.0.0"></script>
  <script src="./assets/scripts/customers.js"></script>

</body>

</html>
