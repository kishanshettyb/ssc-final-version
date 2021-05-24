<?php

    // required Headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');

    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/receivings.php';

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    //prepare product objects
    $product = new Receivings($db);

    // set ID property of products
    $product->booking_id = isset($_GET['booking_id']) ? $_GET['booking_id'] : die();

    // read the details of product to be edited
    $product->readOne();

    // create array
    $product_arr = array(
      "receiving_id" =>  $product->receiving_id,
      "receiving_name" => $product->receiving_name,
      "receiving_phone" => $product->receiving_phone,
      "booking_id" => $product->booking_id,
      "delivery_charges" => $product->delivery_charges,
      "receiving_date_time" => $product->receiving_date_time
    );

    // make it json format
    print_r(json_encode($product_arr));

?>
