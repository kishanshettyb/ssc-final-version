<?php

    // required Headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');


    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/admin.php';

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    //prepare admin objects
    $admin = new Admin($db);

    // set ID property of admins
    $admin->username = isset($_GET['username']) ? $_GET['username'] : die();
    $admin->password = isset($_GET['password']) ? $_GET['password'] : die();


    // read the details of admin to be edited
    $admin->readOneAdmin();

    // create array
    $admin_arr = array(
      "admin_id" =>  $admin->admin_id,
      "branch_id" =>  $admin->branch_id,
      "username" => $admin->username,
      "password" => $admin->password,
      "name" => $admin->name,
      "email" => $admin->email,
      "phone" => $admin->phone,
      "address" => $admin->address,
      "branch_name" => $admin->branch_name,
    );
  
?>
