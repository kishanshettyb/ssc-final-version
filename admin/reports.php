<?php
session_start();
if(!isset($_SESSION["session_admin_username"]))
{
  header("Location:login");
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
  <title>Admin Dashboard - Reports</title>
  <!-- Favicon -->
  <link href="./assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">

  <!-- Icons -->
  <link href="./assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="./assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

  <link href="./assets/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../admin/assets/css/jquery.toast.min.css">

  <!-- Argon CSS -->
  <link type="text/css" href="./assets/css/argon.css?v=1.0.0" rel="stylesheet">
  <link type="text/css" href="./assets/css/custom.css" rel="stylesheet">
</head>

<body>
  <!-- Sidenav -->
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
        aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
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
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main"
                aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#"><i
            class="fas fa-bars menu-icon shadow-lg"></i>Reports</a>
        <h4 class="branch-text" data-branch-name="<?php echo $_SESSION["session_branch"] ?>" data-branch-id="<?php echo $_SESSION["session_branch_id"] ?>">Branch :
          <?php echo $_SESSION["session_branch"] ?></h4>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">
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
          <!-- Card stats -->
          <div class="row">
            <!-- <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <button type="button" class="btn btn-secondary createBranch">Create New Branch</button>
              </div>
            </div> -->
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col mb-4">
          <div class="card shadow">
            <div class="card-header border-0">
              <form id="filterForm">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Date</label>
                      <div class="input-daterange datepicker row align-items-center">
                        <div class="col">
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                              </div>
                              <input name="start_date" id="start_date" data-date-format="yyyy-mm-dd" class="form-control datepicker" placeholder="Start date" type="text">
                            </div>
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                              </div>
                              <input name="end_date" id="end_date" data-date-format="yyyy-mm-dd"  class="form-control datepicker" placeholder="End date" type="text">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2 branch-div">
                    <div class="form-group">
                      <label>Branch</label>
                      <select name="branch" class="form-control small_input dropdownInput js-example-basic-single"
                        id="branches">
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <label>Payment Mode</label>
                    <select name="payment_mode" class="form-control small_input dropdownInput js-example-basic-single"
                      id="payment_mode">
                      <option value="All">All</option>
                      <option value="To Pay">To Pay</option>
                      <option value="Paid">Paid</option>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Status</label>
                    <select name="status" id="status" class="form-control" id="exampleFormControlSelect1">
                      <option value="All">All</option>
                      <option value="booked">booked</option>
                      <option value="delivered">delivered</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <button class="btn btn-danger mt-32"><i class="fas fa-times"></i></button>
                    <button type="submit" class="btn btn-primary mt-32"><i
                        class="fas fa-search pr-2"></i>Search</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">Bookings Reports</h3>
            </div>
            <div class="table-responsive">
              <table id="bookingTable" class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">GC No</th>
                    <th scope="col">Date</th>
                    <th scope="col">From</th>
                    <th scope="col">To</th>
                    <th scope="col">No. Pack</th>
                    <th scope="col">Weight</th>
                    <th scope="col">Basic freight</th>
                    <th scope="col">Hamali</th>
                    <th scope="col">Stat.</th>
                    <th scope="col">Value SC</th>
                    <th scope="col">Transhipment</th>
                    <th scope="col">C Charges</th>
                    <th scope="col">With Pass</th>
                    <th scope="col">Sub Total</th>
                    <th scope="col">GST</th>
                    <th scope="col">Delivery Charges</th>
                    <th scope="col">Total</th>
                    <th scope="col">Status</th>
                    <th scope="col">Payment Mode</th>
                    <th scope="col">Consignor Name & Address</th>
                    <th scope="col">Consignee Name & Address</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
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


  <div class="modal" tabindex="-1" role="dialog" id="branchesModal">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title">Create Branch</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="branchForm">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-4 hide">
                <div class="form-group">
                  <label>Branch Id</label>
                  <input id="branch_id" name="branch_id" type="text" class="form-control "
                    placeholder="Enter Branch id">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Branch Name</label>
                  <input name="branch_name" type="text" class="form-control" placeholder="Enter Branch Name">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Branch Code</label>
                  <input name="branch_code" type="text" class="form-control" placeholder="Enter Branch Code">
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
    src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.js">
  </script>
  <!-- Optional JS -->
  <script src="./assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="./assets/vendor/chart.js/dist/Chart.extension.js"></script>

  <script src="./assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>



  <!-- Argon JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>

  <script src="./assets/js/argon.js?v=1.0.0"></script>
  <script src="./assets/js/sweetalert.min.js"></script>
  <script src="./assets/scripts/constant.js"></script>
  <script src="./assets/js/jquery.validate.min.js"></script>
  <script src="./assets/scripts/util.js"></script>
  <script src="../js/jquery.toast.min.js" charset="utf-8"></script>
  <script src="./assets/scripts/reports.js"></script>
  <script>
    $(".datepicker").datepicker({dateFormat: 'dd-mm-yy'});
  </script>
</body>

</html>