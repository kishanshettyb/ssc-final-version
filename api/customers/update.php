<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/customers.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$product = new Customers($db);

// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));

// set ID property of product to be edited
$product->customer_id = $data->customer_id;

// set product property values
$product->consignor_name = $data->consignor_name;
$product->consignor_phone = $data->consignor_phone;
$product->consignee_name = $data->consignee_name;
$product->consignee_phone = $data->consignee_phone;

// update the product
if($product->update()){
    echo '{';
        echo '"message": "customer updated."';
    echo '}';
}

// if unable to update the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to update customer."';
    echo '}';
}
?>
