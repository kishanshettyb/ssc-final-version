<?php
require_once('../api/config/constants.php');
session_start();
if(!isset($_SESSION["session_admin_username"]))
{
  header("Location:admin/login");
}else{
  if($_SESSION["session_branch"] == MAINBRANCH){
    ?>
<ul class="navbar-nav">
  <li class="nav-item ">
    <a class="nav-link" href="./index">
      <i class="fas fa-th-large text-primary"></i> Dashboard
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="./admin">
      <i class="fas fa-user-shield text-danger"></i> Admin
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="./customers">
      <i class="fas fa-users text-blue"></i> Customers
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="./branches">
      <i class="fas fa-map-marker-alt text-orange"></i> Branches
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="./charges">
      <i class="fas fa-rupee-sign text-info"></i> Charges
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link bookings-menu" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="false"
      aria-controls="navbar-examples">
      <i class="fas fa-shipping-fast text-red text-orange"></i>
      <span class="nav-link-text">Bookings</span>
    </a>
    <div class="collapse" id="navbar-examples">
      <ul class="nav nav-sm flex-column">
        <li class="nav-item">
          <a href="./new-bookings" class="nav-link">
            <div class="menu-alphabet">N</div>
            New Bookings
          </a>
        </li>
        <li class="nav-item">
          <a href="./bookings" class="nav-link">
            <div class="menu-alphabet">A</div>
            All Bookings
          </a>
        </li>
        <li class="nav-item">
          <a href="./paid_bookings" class="nav-link">
            <div class="menu-alphabet">P</div>
            Paid Bookings
          </a>
        </li>
        <li class="nav-item">
          <a href="./to_pay_bookings" class="nav-link">
            <div class="menu-alphabet">T</div>
            To Pay Bookings
          </a>
        </li>
      </ul>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#navbar-receivings" data-toggle="collapse" role="button" aria-expanded="false"
      aria-controls="navbar-receivings">
      <i class="fas fa-truck-loading text-primary text-orange"></i>
      <span class="nav-link-text">Receivings</span>
    </a>
    <div class="collapse" id="navbar-receivings">
      <ul class="nav nav-sm flex-column">
        <li class="nav-item">
          <a href="./receivings-list" class="nav-link">
            <div class="menu-alphabet">R</div>
           Receivings List
          </a>
        </li>
        <li class="nav-item">
          <a href="./receivings" class="nav-link">
            <div class="menu-alphabet">R</div>
            Receivings
          </a>
        </li>
      </ul>
    </div>
  </li>
  <!--  -->
  <li class="nav-item">
    <a class="nav-link" href="./reports">
      <i class="fas fa-chart-pie text-primary"></i> Reports
    </a>
  </li>
</ul>
<?php
  }else{
    ?>
<ul class="navbar-nav">
  <li class="nav-item">
    <a class="nav-link bookings-menu" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="true"
      aria-controls="navbar-examples">
      <i class="fas fa-shipping-fast text-red text-orange"></i>
      <span class="nav-link-text">Bookings</span>
    </a>
    <div class="collapse show" id="navbar-examples">
      <ul class="nav nav-sm flex-column">
      <li class="nav-item">
          <a href="./new-bookings" class="nav-link">
            <div class="menu-alphabet">N</div>
            New Bookings
          </a>
        </li>
        <li class="nav-item">
          <a href="./bookings" class="nav-link">
            <div class="menu-alphabet">A</div>
            All Bookings
          </a>
        </li>
        <li class="nav-item">
          <a href="./paid_bookings" class="nav-link">
            <div class="menu-alphabet">P</div>
            Paid Bookings
          </a>
        </li>
        <li class="nav-item">
          <a href="./to_pay_bookings" class="nav-link">
            <div class="menu-alphabet">T</div>
            To Pay Bookings
          </a>
        </li>
      </ul>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#navbar-receivings" data-toggle="collapse" role="button" aria-expanded="false"
      aria-controls="navbar-receivings">
      <i class="fas fa-truck-loading text-primary text-orange"></i>
      <span class="nav-link-text">Receivings</span>
    </a>
    <div class="collapse" id="navbar-receivings">
      <ul class="nav nav-sm flex-column">
        
        <li class="nav-item">
          <a href="./receivings-list" class="nav-link">
            <div class="menu-alphabet">R</div>
           Receivings List
          </a>
        </li>
        <li class="nav-item">
          <a href="./receivings" class="nav-link">
            <div class="menu-alphabet">R</div>
            Receivings
          </a>
        </li>
      </ul>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="./customers">
      <i class="fas fa-users text-blue"></i> Customers
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="./reports">
      <i class="fas fa-chart-pie text-primary"></i> Reports
    </a>
  </li>
</ul>
<?php
  }
}
error_reporting(0);
?>