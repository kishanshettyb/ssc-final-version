<?php

    // required Headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');

    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/bookings.php';

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    //prepare product objects
    $product = new Bookings($db);

    // set ID property of products
    $product->admin_id = isset($_GET['admin_id']) ? $_GET['admin_id'] : die();
    $product->payment_mode = isset($_GET['payment_mode']) ? $_GET['payment_mode'] : die();

    // read the details of product to be edited
    $product->readCount();

    // create array
    $product_arr = array(
      "total_rows" =>  $product->total_rows,
    );

    // make it json format
    print_r(json_encode($product_arr));

?>
