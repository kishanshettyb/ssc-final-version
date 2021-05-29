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

    //prepare product objects
    $admin = new Admin($db);

    // set ID property of admin
    $admin->admin_id = isset($_GET['admin_id']) ? $_GET['admin_id'] : die();

    // read the details of product to be edited
    $admin->readOne();

    // create array
    $admin_arr = array(
      "admin_id" =>  $admin->admin_id,
      "username" => $admin->username,
      "password" => $admin->password,
      "name" => $admin->name,
      "email" => $admin->email,
      "phone" => $admin->phone,
      "address" => $admin->address,
      "branch" => $admin->branch,
      "profile" => $admin->profile,
      "branch_id" => $admin->branch_id,

    );

    // make it json format
    print_r(json_encode($admin_arr));

?>
