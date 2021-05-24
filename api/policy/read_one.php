<?php

    // required Headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');

    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/policy.php';

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    //prepare product objects
    $product = new Policy($db);

    // set ID property of products
    $product->policy_id = isset($_GET['policy_id']) ? $_GET['policy_id'] : die();

    // read the details of product to be edited
    $product->readOne();

    // create array
    $product_arr = array(
      "policy_id" =>  $product->policy_id,
      "policy_name" => $product->policy_name
    );

    // make it json format
    print_r(json_encode($product_arr));

?>
