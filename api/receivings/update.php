<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/receivings.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$product = new Receivings($db);

// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));

// set ID property of product to be edited
$product->receiving_id = $data->receiving_id;

// set product property values
$product->receiving_name = $data->receiving_name;
$product->receiving_phone = $data->receiving_phone;
$product->booking_id = $data->booking_id;
$product->delivery_charges = $data->delivery_charges;
$product->receiving_date_time = $data->receiving_date_time;
 

// update the product
if($product->update()){
    echo '{';
        echo '"message": "receiving updated."';
    echo '}';
}

// if unable to update the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to update receiving."';
    echo '}';
}
?>
