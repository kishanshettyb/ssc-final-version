<?php

    // required Headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');

    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/customers.php';

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    //prepare product objects
    $product = new Customers($db);

    // set ID property of products
    $product->customer_id = isset($_GET['customer_id']) ? $_GET['customer_id'] : die();

    // read the details of product to be edited
    $product->readOne();

    // create array
    $product_arr = array(
      "consignor_name" =>  $product->consignor_name,
      "consignor_phone" => $product->consignor_phone,
      "consignee_name" => $product->consignee_name,
      "consignee_phone" => $product->consignee_phone,
      "customer_id" => $product->customer_id,
    );

    // make it json format
    print_r(json_encode($product_arr));

?>
