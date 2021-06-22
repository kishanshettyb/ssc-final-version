<?php
session_start();
if(!isset($_SESSION["session_admin_username"]))
{
  header("Location:login");
}else{
  
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
  <title>Admin Dashboard - Profile</title>
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
  <link rel="stylesheet" href="./assets/css/dropzone.css">

</head>

<body>
  <!-- Sidenav -->
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main" data-admin-id="<?php echo $_SESSION["session_admin_id"] ?>">
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#"><i class="fas fa-bars menu-icon shadow-lg"></i>Admin</a>
        <h4 class="branch-text" data-branch-id="<?php echo $_SESSION["session_branch_id"] ?>">Branch : <?php echo $_SESSION["session_branch"] ?></h4>
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
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center profile-pic" style="min-height: 600px; background-image: url(assets/img/theme/bg-2.png); background-size: cover; background-position:bottom;">
 <!-- Mask -->
 <span class="mask bg-gradient-default opacity-8"></span>
      
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-12 col-md-10">
            <h1 class="display-2 text-white inline-block">Hello <span class="admin-name"></span></h1>
            <p class="text-white mt-0 mb-5">This is your profile page. You can change your personal details here.</p>
            <button type="button" class="btn btn-info editProfile" >
            Edit profile
            </button>

            <!-- data-toggle="modal" data-target="#edit-profile-modal" -->
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="assets/img/theme/team-4-800x800.jpg" class="rounded-circle">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              <div class="d-flex justify-content-between">
              </div>
            </div>
            <div class="card-body pt-5 pt-md-4">
              <div class="text-center pt-5">
                <h3 class="pt-3">
                  <span class="admin-name"></span> 
                </h3>
                <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i><span class="branch-name"></span> Branch
                </div>
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i>Branch Manager - <span class="branch-name"></span>
                </div>
                <div>
                  <i class="ni education_hat mr-2"></i>Sri Sai Cargo
                </div>
                <hr class="my-4" />
                <p><i class="fas fa-phone pr-2"></i><span class="branch-phone"></span></p>
                <p><i class="fas fa-envelope pr-2"></i><span class="branch-email"></span></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">My account</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form id="profile-form">
                <h6 class="heading-small text-muted mb-4">User information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Username</label>
                        <input type="text" name="username"  class="form-control form-control-alternative" placeholder="Enter Username" >
                      </div>
                    </div>
                    <div class="col-lg-5">
                      <div class="form-group">
                        <label class="form-control-label">Password</label>
                        <input type="password" name="password"  class="form-control form-control-alternative password" placeholder="Enter Password"  >
                      </div>
                    </div>
                    <div class="col-md-1 mt-32 ml-m-25">
                      <div class="form-group">
                        <button type="button" class="btn btn-primary showpasword"><i class="fas fa-eye"></i></button>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label">Name</label>
                        <input type="text" name="name"   class="form-control form-control-alternative" placeholder="Enter Name"  >
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Email address</label>
                        <input type="email" name="email" id="input-email" class="form-control form-control-alternative" placeholder="Enter Email">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Phone</label>
                        <input type="text" name="phone" class="form-control form-control-alternative" placeholder="Enter phone">
                      </div>
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


  


  <div class="modal" tabindex="-1" role="dialog" id="edit-profile-modal">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title">Edit Profile</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="edit-profile-form">
          <div class="modal-body">
            <div class="row">
            <div class="col-md-4  hide">
                <div class="form-group">
                  <label>Admin Id</label>
                  <input id="name" name="admin_id" type="text" class="form-control "
                    placeholder="Enter Admin id">
                     <input id="branch_id" name="branch_id" type="text" class="form-control "
                    placeholder="Enter Admin id">
                                         <input id="profile" name="profile" type="text" class="form-control "
                    placeholder=" ">
                    <input   name="status" type="text" class="form-control "
                    placeholder=" ">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Username</label>
                  <input id="username" name="username" type="text" class="form-control"
                    placeholder="Enter Username">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Password</label>
                  <input id="password" name="password" type="password" class="form-control password"
                    placeholder="Enter Password">
                </div>
              </div>
              <div class="col-md-1 mt-32 ml-m-25">
                <div class="form-group">
                  <button type="button" class="btn btn-primary showpasword"><i class="fas fa-eye"></i></button>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Profile Photo</label>
                  <!-- <input id="password" name="password" type="text" class="form-control hide"
                    placeholder="Enter Password"> -->
                    <button type="button" class="btn btn-primary upload-photo"><i class="fas fa-images pr-2"></i>Upload Photo</button>
                    <img class="upload-photo-preview shadow-lg" src="assets/img/theme/team-4-800x800.jpg" alt="">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Name</label>
                  <input id="name" name="name" type="text" class="form-control"
                    placeholder="Enter Name">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Email</label>
                  <input name="email" type="email" class="form-control" placeholder="Enter Email">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Phone</label>
                  <input name="phone" type="text" class="form-control" placeholder="Enter phone no">
                </div>
              </div>
              <div class="col-md-4 hide">
                <div class="form-group">
                  <label>Address</label>
                  <input name="address" type="text" class="form-control" placeholder="Enter phone no">
                </div>
              </div>
              <div class="col-md-4 hide">
                <div class="form-group">
                  <label>Branch</label>
                  <input name="branch" type="text" class="form-control" placeholder="Enter phone no">
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

  <div class="modal" tabindex="-1" role="dialog" id="profile-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Upload Profile Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div id="upload_file" class="dropzone noPadding dz-clickable" data-btn="product_images">
                    <div class="dropzone">
                      <div class="dz-message">
                        <h1>
                          <i class="fas fa-hand-point-up"></i>
                        </h1>
                        <h3>Drop files here or click to upload.</h3>
                        <h5>(Upload your File.)
                        </h5>
                      </div>
                    </div>
                  </div>
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

  <!-- Argon JS -->
  <script src="./assets/js/argon.js?v=1.0.0"></script>
  <script src="./assets/js/sweetalert.min.js"></script>
  <script src="./assets/js/jquery.validate.min.js"></script>
  <script src="../js/dropzone.js" charset="utf-8"></script>
  <script src="./assets/scripts/util.js"></script>
  <script src="./assets/scripts/profile.js"></script>
</body>

</html>