<?php
require_once('../api/config/constants.php');

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
  <title>Admin Dashboard - New Bookings</title>
  <!-- Favicon -->
  <link href="./assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.css" />

  <!-- Icons -->
  <link href="./assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="./assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">

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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">New Bookings</a>
        <h4 class="branch-text" data-branch-phone="<?php echo $_SESSION["session_phone"] ?>"  data-branch-name="<?php echo $_SESSION["session_branch"] ?>"
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

        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">New Bookings</h3>
            </div>
            <section class="mb-1 mt-0  ml-2 mr-2 pb-1 pt-1 shadow-sm section-1">
              <div class="container-fluid">
                <div class="lds-roller">
                  <div></div>
                  <div></div>
                  <div></div>
                  <div></div>
                  <div></div>
                  <div></div>
                  <div></div>
                  <div></div>
                </div>

                <form id="bookingForm" class="bookingForm">
                  <input name="admin_id" id="admin_id" value="<?php echo $_SESSION["session_admin_id"] ?>" type="text"
                    class="form-control small-input hide" placeholder="Enter Admin Id" />
                  <input name="booking_id" id="booking_id" type="text" class="form-control small-input hide"
                    placeholder="Enter Booking Id" />
                    <input name="delivery_charges"  type="text" class="form-control small-input hide"
                    placeholder="Enter Booking Id" />
                  <input name="branch_id" value="<?php echo $_SESSION["session_branch_id"] ?>" type="text"
                    class="form-control small-input hide" placeholder="Enter Booking Id" />

                  <div class="row  mt-1 pl-2 pr-2">
                    <div class="col-md-8 border">
                      <!-- address -->
                      <div class="row">

                        <div class="col-md-9 bb address">
                          <div class="row">
                            <div class="col-md-5">
                              <div class="text-center">
                                <img src="./assets/img/brand/icon-new.png" class="billing-logo-img" alt="">
                                <h2 class="billing-logo-text mb-0"><?php
                                if($_SESSION["session_branch"] == MAINBRANCH){
                                 echo  "Sri Sai Cargo";
                                }else  if($_SESSION["session_branch"] == "BANGALORE"){
                                  echo  "Sri Sai Cargo";
                                }else{
                                 echo  "Sri Sai Cargo";
                                }
                                ?></h2>
                              </div>
                            </div>
                            <div class="col-md-7 m-0">
                              <p class="mt-4 text-justify address_line text-center" style="line-height:1.2">

                              <?php
                              if($_SESSION["session_branch"] == MAINBRANCH){
                                echo "Shop No. 7, SSBM Complex, Tank Bund Road, Next to Upparpet Police Station, Majestic, Bangalore - 560009.";
                              }else if($_SESSION["session_branch"] == "BANGALORE"){
                               echo  "Shop No. 7, SSBM Complex, Tank Bund Road, Next to Upparpet Police Station, Majestic, Bangalore - 560009.";
                              }else {
                                echo "Shop No. 7, SSBM Complex, Tank Bund Road, Next to Upparpet Police Station, Majestic, Bangalore - 560009.";
                              }
                              ?>
                                <!-- Shop No. 7, SSBM Complex, Tank Bund Road, Next to Upparpet Police Station, Majestic,
                                Bangalore - 560009.<br /> -->
                              </p>
                            </div>
                          </div>


                          <hr class="mt-0 mb-1">

                          <p class="pb-0 text-justify address_line text-left" style="line-height:1">
                            <span class="pr-2" style="font-weight:600;float:left">Mobile: 
                            <?php 
                             if($_SESSION["session_branch"] == MAINBRANCH){
                               echo "9449507037";
                              }else if($_SESSION["session_branch"] == "BANGALORE"){
                               echo "GSTIN: 9449507037";
                             }else{
                              echo "9449507037";
                             }
                             ?>
                            </span>
                            <span class="pr-2" style="font-weight:600;float:right;font-size:12px">
                            <?php 
                             if($_SESSION["session_branch"] == MAINBRANCH){
                               echo "GSTIN: 29AKZPM2385H1ZB";
                              }else if($_SESSION["session_branch"] == "BANGALORE"){
                               echo "GSTIN: 29AKZPM2385H1ZB";
                             }else{
                              echo "GSTIN: 29AKZPM2385H1ZB";
                             }
                             ?>
                            </span>
                        </div>
                        <!-- <div class="col-md-8 bb address">
                          <h4 class="mb-0 color-pink text-center">Sri Sai Cargo </h4>
                          <hr class="mt-2 mb-2">
                          <p class="mb-1 text-justify address_line text-center" style="line-height:1">
                            Shop No. 7, SSBM Complex, Tank Bund Road, Next to Upparpet Police Station, Majestic, Bangalore - 560009.<br />
                            Mobile No: +91 9449507037
                            <span class="pr-2" style="font-weight:600;float:right">
                              GSTIN: 29AKZPM2385H1ZB
                            </span></p>

                        </div> -->
                        <div class="col-md-3 bl bb pt-2  text-center">
                          <h6 style="font-size:16px;font-weight:700;margin-bottom:0">Goods Consignment Note:</h6>
                          <h6 style="font-weight:900;font-size:24px;" class="mb-0 pb-0 gc_no"> </h6>
                          <input name="gc_no" id="gc_no" value="BLR0003" type="text"
                            class="form-control small-input hide gc_no" placeholder="Enter gc no" />
                        </div>
                      </div>
                      <!-- Body  -->
                      <div class="row mt-2 mb-0">
                        <div class="col-md-5">
                          <label class="small-label" for="exampleInputEmail1">Consignor Name, Address:</label>
                        </div>
                        <div class="col-md-3 text-right mt-minus-5">
                          <label class="small-label" for="exampleInputEmail1">E-Way Bill No:</label>
                        </div>
                        <div class="col-md-4">
                          <input name="eway_bill_no" id='eway_bill_no' minlength="12" maxlength="12" type="text"
                            class="form-control small-input" style="margin-top:-4px" />
                        </div>
                        <div class="col-md-4">
                          <input id="consignor_phone" maxlength="10" name="consignor_phone" type="text"
                            class="form-control small-input" placeholder="Enter Mobile No" />
                        </div>
                        <div class="col-md-8 consignee-consignor-row">
                          <input name="consignor_name_add" type="text"
                            class="consignor_name_add form-control small-input uppercase" placeholder="Enter Address" />
                          <select id="consignor_name_add"
                            class="form-control dropdownInput  js-example-basic-single-dynamic  consignor_dropdown">
                          </select>
                        </div>
                        <div class="col-md-12">
                          <label class="small-label" for="exampleInputEmail1">Consignee Name, Address:</label>
                        </div>
                        <div class="col-md-4">
                          <input id="consignee_phone" maxlength="10" name="consignee_phone" type="text"
                            class="form-control  consignee_phone small-input" placeholder="Enter Mobile No" />
                        </div>
                        <div class="col-md-8 consignee-consignor-row">
                          <input name="consignee_name_add" type="text"
                            class="consignee_name_add form-control small-input uppercase" placeholder="Enter Address" />
                          <select id="consignee_name_add"
                            class="form-control dropdownInput js-example-basic-single-dynamic consignee_dropdown">

                          </select>
                        </div>
                      </div>

                      <!-- Parcel Information -->
                      <div class="row  mt-2 mb-1">
                        <div class="col-md-12">
                          <h5 class="mb-1">Parcel Information:</h5>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label for="exampleInputEmail1">No. Pkgs:</label>
                            <input name="no_of_packages" id="no_of_packages" type="text"
                              class="form-control small-input" />
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Act. Wt:</label>
                            <input name="act_wt" type="text" class="form-control small-input" />
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Consignment Value</label>
                            <input id="consignment_value" name="consignment_value" type="text"
                              class="form-control small-input" />
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Description of Goods</label>
                            <input name="desc_of_goods" type="text" class="form-control small-input" />
                          </div>
                        </div>
                      </div>
                      <!-- Policy -->
                      <div class="row">
                        <div class="col-md-6">
                          <p class="text-small text-justify mt-0 mb-2">I/We agree to this G.C Note copy and in the event
                            of loss /
                            damage to the parcel, our claim shall be limited to Rs.5/- per KG of Actual Weight.</p>
                        </div>
                        <div class="col-md-6">
                          <input type="text" class="form-control mt-0 small-input" id="policy" 
                          value="<?php 
                             if($_SESSION["session_branch"] == MAINBRANCH){
                               echo "SUBJECT TO BANGLORE JURISDICTION";
                              }else if($_SESSION["session_branch"] == "BANGALORE"){
                               echo "SUBJECT TO BANGLORE JURISDICTION";
                             }else{
                              echo "SUBJECT TO BANGLORE JURISDICTION";
                             }
                             ?>" style="font-size:13px">
                        </div>
                      </div>

                      <!-- Signatures & Buttons -->
                      <div class="row pt-0 pb-0 text-center signature-row">
                        <div class="col-md-4">
                          <button type="button" class="btn btn-light btn-sm">Booking Person Signature</button>
                        </div>
                        <div class="col-md-4">
                          <button id="link" type="button" class="btn btn-light btn-sm">Delivery Person
                            Signature</button>
                          <p id="box"></p>
                        </div>
                        <div class="col-md-4">
                          <button type="button" class="btn btn-light btn-sm">Signature of Incharge</button>
                        </div>
                      </div>
                      <div class="row mt-0 pb-1 buttons-row">
                        <div class="col-md-4">
                          <div class="custom-control custom-radio custom-control-inline">
                            <input   value="To Pay" type="radio" id="customRadioInline1" name="payment_mode"
                              class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline1">To Pay</label>
                          </div>
                          <div class="custom-control custom-radio custom-control-inline">
                            <input value="Paid" type="radio" id="customRadioInline2" name="payment_mode"
                              class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline2">Paid</label>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <button type="reset" class="btn btn-block btn-secondary btn-sm">Cancel</button>
                        </div>
                        <div class="col-md-2">
                          <button type="submit" class="btn btn-block btn-danger btn-sm btn-save-submit">Save &
                            Submit</button>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4  border-right br bb-large bt-large">
                      <div class="row">
                        <div class="col-md-12 text-right">
                          <h5 class="pt-2 mb-0">Date: <span class="currentDate">06-08-2019</span></h5>
                          <input name="date" type="text" class="form-control small-input hide currentDate"
                            placeholder="Enter date" />
                        </div>
                      </div>
                      <div class="row mb-2">
                        <div class="col-md-3 text-right">
                          <h4>From:</h4>
                        </div>
                        <div class="col-md-9">
                          <input name="from_place" type="text" value="<?php echo $_SESSION["session_branch"]?>" class="form-control small-input">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3 text-right">
                          <h4>To:</h4>
                        </div>
                        <div class="col-md-9">
                          <select name="to_place" class="form-control small_input dropdownInput js-example-basic-single"
                            id="branches">
                          </select>
                        </div>
                        <div class="col-md-12   pt-0 pb-0 mt-1 mb-1">
                          <hr class="mt-2 mb-2">
                        </div>
                      </div>
                      <!-- charges -->
                      <div class="row">
                        <!-- charges -->
                        <div class="col-md-10">
                          <div class="row mb-0">
                            <div class="col-md-6 text-right">
                              <label class="small-label">Basic Freight:</label>
                            </div>
                            <div class="col-md-6">
                              <input id="basic_freight" name="basic_freight" type="text"
                                class="form-control text-end small-input">
                            </div>
                          </div>
                          <div class="row mb-0">
                            <div class="col-md-6 text-right">
                              <label class="small-label">Hamali:</label>
                            </div>
                            <div class="col-md-6">
                              <input name="hamali" id="hamali" value="" type="text"
                                class="form-control text-end small-input">
                            </div>
                          </div>
                          <div class="row mb-0">
                            <div class="col-md-6 text-right">
                              <label class="small-label">Stat. Charges:</label>
                            </div>
                            <div class="col-md-6">
                              <input id="stat_charges" name="stat_charges" value="20.00" type="text"
                                class="form-control text-end small-input">
                            </div>
                          </div>
                          <!-- <div class="row mb-0">
                  <div class="col-md-6 text-right">
                    <label class="small-label">S C:</label>
                  </div>
                  <div class="col-md-6">
                    <input name="sc" id="sc" type="text" class="form-control text-end small-input">
                  </div>
                </div> -->
                          <div class="row mb-0">
                            <div class="col-md-6 text-right">
                              <label class="small-label">Value S C:</label>
                            </div>
                            <div class="col-md-6">
                              <input name="value_of_sc" id="value_of_sc" type="text"
                                class="form-control text-end small-input">
                            </div>
                          </div>
                          <!-- <div class="row mb-0">
                  <div class="col-md-6 text-right">
                    <label class="small-label">A O C:</label>
                  </div>
                  <div class="col-md-6">
                    <input name="aoc" id="aoc" value="16.00" type="text" class="form-control text-end small-input">
                  </div>
                </div> -->
                          <div class="row mb-0">
                            <div class="col-md-6 text-right">
                              <label class="small-label">Transhipment:</label>
                            </div>
                            <div class="col-md-6">
                              <input name="transhipment" id="transhipment" value="" type="text"
                                class="form-control text-end small-input">
                            </div>
                          </div>
                          <div class="row mb-0">
                            <div class="col-md-6 text-right">
                              <label class="small-label">C Charges:</label>
                            </div>
                            <div class="col-md-6">
                              <input name="c_charges" id="c_charges" type="text"
                                class="form-control  text-end small-input">
                            </div>
                          </div>
                          <!-- <div class="row mb-0">
                            <div class="col-md-6 text-right">
                              <label class="small-label">D Charges:</label>
                            </div>
                            <div class="col-md-6">
                              <input name="d_charges" id="d_charges"  type="text" class="form-control text-end small-input">
                            </div>
                          </div> -->
                          <div class="row mb-0">
                            <div class="col-md-6 text-right">
                              <label class="small-label">With Pass:</label>
                            </div>
                            <div class="col-md-6">
                              <input id="with_pass" name="with_pass" value="10.00" type="text"
                                class="form-control text-end small-input">
                            </div>
                          </div>
                          <div class="row mb-0">
                            <div class="col-md-6 text-right">
                              <label class="small-label color-pink">Sub Total:</label>
                            </div>
                            <div class="col-md-6">
                              <input name="subtotal" id="subtotal" type="text"
                                class="form-control small-input text-end">
                            </div>
                          </div>
                          <div class="row mb-0">
                            <div class="col-md-6 text-right">
                              <label class="small-label">GST:</label>
                            </div>
                            <div class="col-md-6">
                              <input id="gst" name="gst" type="text" class="form-control small-input text-end">
                            </div>
                          </div>
                          <!-- <div class="row mb-0">
                            <div class="col-md-6 text-right">
                              <label class="small-label">Delivey Chgs:</label>
                            </div>
                            <div class="col-md-6">
                              <input   type="text" class="form-control small-input text-end">
                            </div>
                          </div> -->
                          <div class="row mb-0">
                            <div class="col-md-6 text-right">
                              <label class="small-label color-pink f-18">Total:</label>
                            </div>
                            <div class="col-md-6">
                              <input name="total" id="total" type="text" class="form-control small-input text-end">
                            </div>
                          </div>
                        </div>
                        <!-- to pay -->
                        <div class="col-md-2">
                          <div class="v-line color-pink">
                            TO PAY
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </section>

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

  <!-- <div id="editBookingModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title">Edit Booking</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="bookingForm">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-4 hide">
                <div class="form-group">
                  <label>Booking Id</label>
                  <input id="booking_id" name="booking_id" type="text" class="form-control"
                    placeholder="Enter booking id">
                </div>
              </div>
              <div class="col-md-4 hide">
                <div class="form-group">
                  <label>Admin id</label>
                  <input id="admin_id" name="admin_id" type="text" class="form-control" placeholder="Enter admin id">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Date</label>
                  <input name="date" type="text" class="form-control" placeholder="Enter date">
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label>From place</label>
                  <input name="from_place" type="text" class="form-control" placeholder="Enter from place">
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label>To place</label>
                  <input name="to_place" type="text" class="form-control" placeholder="Enter to place">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Goods C.No</label>
                  <input name="gc_no" type="text" class="form-control" placeholder="Enter Goods Cons.. no">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>E-way bill no</label>
                  <input name="eway_bill_no" type="text" class="form-control" placeholder="Enter eway bill no">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Consignor phone</label>
                  <input name="consignor_phone" type="text" class="form-control" placeholder="Enter consignor phone">
                </div>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <label>Consignor name address</label>
                  <input name="consignor_name_add" type="text" class="form-control"
                    placeholder="Enter consignor name add">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Consignee phone</label>
                  <input name="consignee_phone" type="text" class="form-control" placeholder="Enter consignee phone">
                </div>
              </div>
              <div class="col-md-9">
                <div class="form-group">
                  <label>Consignee name address</label>
                  <input name="consignee_name_add" type="text" class="form-control"
                    placeholder="Enter consignee name  add">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>No. packages</label>
                  <input name="no_of_packages" type="text" class="form-control" placeholder="Enter no of packages">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Act wt.</label>
                  <input name="act_wt" type="text" class="form-control" placeholder="Enter act wt">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>consignment_value</label>
                  <input name="consignment_value" type="text" class="form-control"
                    placeholder="Enter consignment value">
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label>Desc of goods</label>
                  <input name="desc_of_goods" type="text" class="form-control" placeholder="Enter desc of goods">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Basic freight</label>
                  <input name="basic_freight" type="text" class="form-control" placeholder="Enter basic  freight">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Hamali</label>
                  <input name="hamali" type="text" class="form-control" placeholder="Enter hamali">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Stat charges</label>
                  <input name="stat_charges" type="text" class="form-control" placeholder="Enter stat charges">
                </div>
              </div>
              <div class="col-md-2 hide">
                <div class="form-group">
                  <label>SC</label>
                  <input name="sc" type="text" class="form-control" placeholder="Enter sc">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Value of scd</label>
                  <input name="value_of_sc" type="text" class="form-control" placeholder="Enter value of sc">
                </div>
              </div>
              <div class="col-md-2 hide">
                <div class="form-group">
                  <label>AOC</label>
                  <input name="aoc" type="text" class="form-control" placeholder="Enter aoc">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>transhipment</label>
                  <input name="transhipment" type="text" class="form-control" placeholder="Enter transhipment">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>C charges</label>
                  <input name="c_charges" type="text" class="form-control" placeholder="Enter c charges">
                </div>
              </div>
              <div class="col-md-2 hide">
                <div class="form-group">
                  <label>D charges</label>
                  <input name="d_charges" type="text" class="form-control" placeholder="Enter d charges">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>with pass</label>
                  <input name="with_pass" type="text" class="form-control" placeholder="Enter with pass">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>GST</label>
                  <input name="gst" type="text" class="form-control" placeholder="Enter gst">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Pay mode</label>
                  <input name="payment_mode" type="text" class="form-control" placeholder="Enter payment mode">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Sub Total</label>
                  <input name="subtotal" type="text" class="form-control" placeholder="Enter sub total">
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>Total</label>
                  <input name="total" type="text" class="form-control" placeholder="Enter total">
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
          <div class="section-2"></div>
          <div class="section-3"></div>
          <div class="section-4"></div>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" charset="utf-8"></script>
  <!-- Argon JS -->
  <script src="./assets/js/argon.js?v=1.0.0"></script>
  <script src="./assets/js/sweetalert.min.js"></script>
  <script src="./assets/js/jquery.validate.min.js"></script>
  <script src="./assets/scripts/util.js"></script>
  <script src="./assets/scripts/billing.js"></script>
</body>

</html>