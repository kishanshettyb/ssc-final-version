 <!DOCTYPE html>
 <html>

 <head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
   <meta name="author" content="Creative Tim">
   <title>Login - Sri Sai Sri Transport</title>
   <!-- Favicon -->
   <link href="./assets/img/brand/favicon.png" rel="icon" type="image/png">
   <!-- Fonts -->
   <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
   <!-- Icons -->
   <link href="./assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
   <link href="./assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
   <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
   <!-- Argon CSS -->
   <link type="text/css" href="./assets/css/argon.css?v=1.0.0" rel="stylesheet">
   <link type="text/css" href="./assets/css/custom.css" rel="stylesheet">

 </head>

 <body class="bg-default">
   <div class="main-content">
     <!-- Navbar -->
     <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
       <div class="container px-4">
         <a class="navbar-brand" href="./index">
           <h2 class="text-white">Sri Sai Sri Transport</h2>
         </a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main"
           aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
           <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbar-collapse-main">
           <!-- Collapse header -->
           <div class="navbar-collapse-header d-md-none">
             <div class="row">
               <div class="col-6 collapse-brand">
                 <h2> <a href="./index">
                     Sri Sai Sri Transport
                   </a></h2>
               </div>
               <div class="col-6 collapse-close">
                 <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main"
                   aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                   <span></span>
                   <span></span>
                 </button>
               </div>
             </div>
           </div>
           <!-- Navbar items -->
           <ul class="navbar-nav ml-auto">
             <li class="nav-item">
               <a class="nav-link nav-link-icon" href="#">
                 <i class="fas fa-map-marker"></i>
                 <span class="nav-link-inner--text">Flat No:1, Block No:10, Road No:5, Autonagar, Hyderabad-500070.</span>
               </a>
             </li>
             <li class="nav-item">
               <a class="nav-link nav-link-icon" href="tel:8309333628">
                 <i class="fas fa-phone"></i>
                 <span class="nav-link-inner--text">+91 8309333628</span>
               </a>
             </li>
             <!-- <form class="form-inline my-2 my-lg-0 ml-5">
               <a type="button"  class="btn btn-outline-secondary admin-login-btn ml-5" href="adminlogin">
                 <i class="fas fa-user-shield"></i>
                 <span class="nav-link-inner--text">Admin Login</span>
               </a>
      </form> -->
           </ul>
         </div>
       </div>
     </nav>
     <!-- Header -->
     <div class="header bg-gradient-primary py-7 py-lg-8">
       <div class="container">
         <div class="header-body text-center mb-7">
           <div class="row justify-content-center mt-5">
             <div class="col-lg-5 col-md-6">
               <h1 class="text-white">Welcome Admin!</h1>
               <p class="text-lead text-light">Use these to login and mange your Parcel service Bookings!!</p>
             </div>
           </div>
         </div>
       </div>
       <div class="separator separator-bottom separator-skew zindex-100">
         <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
           xmlns="http://www.w3.org/2000/svg">
           <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
         </svg>
       </div>
     </div>
     <!-- Page content -->
     <div class="container mt--8 pb-5">
       <div class="row justify-content-center">
         <div class="col-lg-5 col-md-7">
           <div class="card bg-secondary shadow border-0">
             <div class="card-body px-lg-5 py-lg-5">
               <div class="text-center text-muted mb-4">
                 <h2><i class="fas fa-user-shield"></i> Login</h2>
               </div>
               <form id="loginForm">
                 <div class="form-group">
                   <label for="exampleInputEmail1">Username</label>
                   <input name="username" id="username" type="text" class="form-control" placeholder="Enter username">
                 </div>
                 <div class="form-group">
                   <label for="exampleInputEmail1">Password</label>
                   <input name="password" id="password" type="password" class="form-control"
                     placeholder="Enter password">
                 </div>
                 <div class="text-center">
                   <button type="submit" class="btn btn-primary btn-block mt-5">Log In<i
                       class="fas fa-arrow-right pl-2"></i></button>
                 </div>
               </form>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
   <!-- Footer -->
   <footer class="py-5">
     <div class="container">
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
     </div>
   </footer>
   <!-- Argon Scripts -->
   <!-- Core -->
   <script src="./assets/vendor/jquery/dist/jquery.min.js"></script>
   <script src="./assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

   <!-- Argon JS -->
   <script src="./assets/js/argon.js?v=1.0.0"></script>
   <script src="./assets/js/sweetalert.min.js"></script>
   <script src="./assets/js/jquery.validate.min.js"></script>
   <script src="./assets/scripts/constant.js"></script>
   <script src="./assets/scripts/util.js"></script>
   <script src="./assets/scripts/login.js"></script>

 </body>

 </html>