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
  <title>Admin Dashboard - Recievings</title>
  <!-- Favicon -->
  <link href="./assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />

  <!-- Icons -->
  <link href="./assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="./assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="./assets/css/argon.css?v=1.0.0" rel="stylesheet">
  <link type="text/css" href="./assets/css/custom.css" rel="stylesheet">
  <link type="text/css" href="./assets/css/billing.css" rel="stylesheet">

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
            class="fas fa-bars menu-icon shadow-lg"></i>Recievings</a>
        <h4 class="branch-text" data-branch-phone="<?php echo $_SESSION["session_phone"] ?>"
          data-branch-name="<?php echo $_SESSION["session_branch"] ?>"
          data-branch-id="<?php echo $_SESSION["session_branch_id"] ?>">Branch :
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
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <form id="search_booking">
                <div class="row justify-content-md-center">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Enter Goods Consignment No:</label>
                      <input name="gc_no" type="text" class="form-control" id="gc_no_input" placeholder="Enter GC no">
                    </div>
                  </div>
                  <div class="col-md-2 mt-32">
                    <button type="submit" class="btn btn-block btn-primary recievings-btn">Submit</button>
                  </div>
                </div>
              </form>
            </div>
            <!-- To Do : add Reports here -->
          </div>
        </div>
      </div>


      <!-- Receipt -->
      <div class="card  mt-5 new-receipt  hide">
        <div class="row">
          <div class="col-md-6">
            <div class="card recievings-bill-card p-2  section-1">
              <div class="row mb-1">
                <div class="col-md-3 text-center">
                  <a href="./index">
                    <?php
                                if($_SESSION["session_branch"] == MAINBRANCH){
                                 ?>
                    <img src="./assets/img/brand/icon.png" style="height:50px;" alt="">
                    <p class="mb-0" style="font-weight:900;font-size:16px;color:balck">Sri Sai Cargo</p>

                    <?php
                                }else  if($_SESSION["session_branch"] == "BENGALURU"){
                                  ?>


                    <img src="./assets/img/brand/logo-new.png" style="height:50px;margin-top:30px" alt="">
                    <?php
                                }else{
?>
                    <img src="./assets/img/brand/logo.png" style="height:50px;margin-top:30px" alt="">
                    <p style="font-weight:900;font-size:10px;color:black">Sri Sai Cargo</p>


                    <?php
                                }
                    ?>
                  </a>
                </div>
                <div class="col-md-9">
                  <?php
                                if($_SESSION["session_branch"] == MAINBRANCH){
                                 ?>
                  <p class="mt-1 mb-1 text-justify address_line text-center" style="line-height:1;font-size:12px">
                    Shop No. 7, SSBM Complex, Tank Bund Road, Next to Upparpet Police Station, Majestic, Bangalore - 560009.
                  </p>
                  <hr class="mb-1 mt-0">
                  <p class="pb-0 text-justify address_line text-left" style="line-height:1">
                    <span class="pr-2" style="font-weight:600;float:left;font-size:12px">Mobile: 9449507037</span>
                    <span class="pr-2" style="font-weight:600;float:right;font-size:12px">
                      GSTIN: 29AKZPM2385H1ZB
                    </span>
                  </p>
                  <?php
                                }else  if($_SESSION["session_branch"] == "BENGALURU"){
                                  ?>
                  <p class="mt-4 text-justify address_line text-center" style="line-height:1">
                    Shop No. 7, SSBM Complex, Tank Bund Road, Next to Upparpet Police Station, Majestic,
                    Bangalore - 560009.<br />
                  </p>
                  <hr class="mb-1 mt-0">
                  <p class="pb-0 text-justify address_line text-left" style="line-height:1">
                    <span class="pr-2" style="font-weight:600;float:left;font-size:12px">Mobile: 9449507037</span>
                    <span class="pr-2" style="font-weight:600;float:right;font-size:12px">
                      GSTIN: 29AKZPM2385H1ZB
                    </span>
                  </p>
                  <?php
                                }else{
                                 
                                  ?>
                  <p class="mt-4 text-justify address_line text-center" style="line-height:1">
                    Shop No. 7, SSBM Complex, Tank Bund Road, Next to Upparpet Police Station, Majestic, Bangalore - 560009.
                  </p>
                  <hr class="mb-1 mt-0">
                  <p class="pb-0 text-justify address_line text-left" style="line-height:1">
                    <span class="pr-2" style="font-weight:600;float:left;font-size:12px">Mobile: 9449507037</span>
                    <span class="pr-2" style="font-weight:600;float:right;font-size:12px">
                      GSTIN: 29AKZPM2385H1ZB
                    </span>
                  </p>
                  <?php
                                }
                                ?>


                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <hr class="mt-0 mb-0">

                </div>
                <div class="col-md-8 text-center">
                  <h2 class="mt-0 mb-0">Delivey Receipt</h2>
                </div>
                <div class="col-md-4 text-right">
                  <h5 class="mt-1 mb-0 mr-4">Date: <span class="currentDateToday"></span></h5>
                </div>
                <div class="col-md-12">
                  <hr class="mt-0 mb-2">
                  <form id="recievings-bill-card-form" class="display_table">
                    <div class="row">
                      <div class="col-md-6">
                        <ul class="default-ul">
                          <li>GC No:</li>
                          <li><input type="text" class="form-control" name="gc_no"></li>
                        </ul>
                        <ul class="default-ul">
                          <li>Booking Date</li>
                          <li><input type="text" class="form-control" name="date"></li>
                        </ul>
                        <ul class="default-ul">
                          <li>From:</li>
                          <li><input type="text" class="form-control" name="from_place"></li>
                        </ul>
                        <ul class="default-ul">
                          <li>To:</li>
                          <li><input type="text" class="form-control" name="to_place"></li>
                        </ul>
                      </div>
                      <div class="col-md-6">

                        <ul class="default-ul">
                          <li>No. Packgs:</li>
                          <li><input type="text" class="form-control" name="no_of_packages"></li>
                        </ul>
                        <ul class="default-ul">
                          <li>Act. Wt:</li>
                          <li><input type="text" class="form-control" name="act_wt"></li>
                        </ul>
                        <ul class="default-ul">
                          <li>Desc of Goods:</li>
                          <li><input type="text" class="form-control" name="desc_of_goods"></li>
                        </ul>
                        <ul class="default-ul">
                          <li>Payment Mode:</li>
                          <li><input type="text" class="form-control" name="payment_mode"></li>
                        </ul>
                      </div>
                    </div>
                  </form>

                </div>
                <div class="col-md-12">
                  <hr class="mb-2 mt-2">
                  <h3 class="text-center">Receiver Details</h3>
                  <hr class="mb-2 mt-2">

                  <div class="row ">
                    <div class="col-md-6  display_table receivingsTable">
                      <ul class="default-ul">
                        <li>Receiver Name:</li>
                        <li><input type="text" class="form-control receiver_name"></li>
                      </ul>
                      <ul class="default-ul">
                        <li>Receivier Phone</li>
                        <li><input type="text" class="form-control receiver_phone"></li>
                      </ul>
                      <ul class="default-ul">
                        <li>Received On:</li>
                        <li><input type="text" class="form-control receiver_time"></li>
                      </ul>
                      <ul class="default-ul">
                        <li>Reciever Signature</li>
                        <li> </li>
                      </ul>
                    </div>
                    <div class="col-md-6  display_table receivingsTable">
                      <ul class="default-ul">
                        <li>Delivery Charges:</li>
                        <li><input type="text" class="form-control delivery_charges"></li>
                      </ul>
                      <ul class="default-ul">
                        <li>Receiver Name:</li>
                        <li><input type="text" class="form-control receiver_name"></li>
                      </ul>

                      <ul class="default-ul">
                        <li class="paid-hide">Total:</li>
                        <li><span class="total-charges paid-hide"></span></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <form class="receivingsForm">
                    <div class="hide2">
                      <input id="booking_id_bill" type="text" class="form-control hide">
                    </div>
                    <div class="row">
                      <div class="col md-6">
                        <ul class="default-ul">
                          <li>Reciever Name:</li>
                          <li><input type="text" class="form-control receiving_name" name="receiving_name"></li>
                        </ul>
                        <ul class="default-ul">
                          <li>Reciever Phone:</li>
                          <li><input type="text" class="form-control receiving_phone" maxlengli="10"
                              name="receiving_phone">
                          </li>
                          <ul class="default-ul">
                            <li>Reciever Signature</li>
                            <li> </li>
                          </ul>
                        </ul>
                      </div>
                      <div class="col-md-6">
                        <ul class="default-ul">
                          <li>Delivery Charges:</li>
                          <li class="text-left"><input style="text-align:right" id="delivery_charges" type="text"
                              class="form-control delivery_charges" name="delivery_charges">
                          </li>
                        </ul>
                        <ul class="default-ul">
                          <li class="paid-hide">Total:</li>
                          <li class="text-left paid-hide"><span class="total" id="total">000</span></li>
                        </ul>

                        <ul class="default-ul">
                          <li></li>
                          <li><button class="btn btn-block submit-delivery btn-primary">Submit Delivery</button></li>
                        </ul>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <button class="btn btn-primary receiving-print-btn  pl-5 pr-5 mt-3">Print</button>
          </div>

        </div>
      </div>
      <!-- End Receipt -->




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
  <!-- 
  <div class="modal" tabindex="-1" id="receivingsModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title">Receivings</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="receivingsForm">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="hide">
                  <input type="text" id="rec_booking_id" name="booking_id" class="form-control">
                  <input type="text" id="rec_delivery_charges" name="delivery_charges" class="form-control">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Receiver Name</label>
                  <input type="text" name="receiving_name" class="form-control" placeholder="Enter Receiver name">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Receiver phone</label>
                  <input type="text" name="receiving_phone" class="form-control" placeholder="Enter Receiver phone">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save & Print</button>
          </div>
        </form>
      </div>
    </div>
  </div> -->

  <div class="modal" tabindex="-1" id="printModal">
    <div class="modal-dialog modal-large">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title">Print Bill</h2>
          <button type="button" class="close close-print-modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="printThis" class="modal-body">
          <div class="row">

            <div class="section-2 col-md-6"></div>

            <div class="section-3 col-md-6"></div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary close-print-modal">Close</button>
          <button id="print" type="button" class="btn btn-primary printPage">Print</button>
        </div>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" charset="utf-8"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

  <!-- Argon JS -->
  <script src="./assets/js/argon.js?v=1.0.0"></script>
  <script src="./assets/js/sweetalert.min.js"></script>
  <script src="./assets/js/jquery.validate.min.js"></script>

  <script src="./assets/scripts/constant.js"></script>
  <script src="./assets/scripts/util.js"></script>
  <script src="./assets/scripts/recievings.js"></script>

</body>

</html>