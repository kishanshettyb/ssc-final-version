<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate product object
include_once '../objects/receivings.php';

$database = new Database();
$db = $database->getConnection();

$product = new Receivings($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));
date_default_timezone_set('Asia/Kolkata');
// set product property values
$product->receiving_name = $data->receiving_name;
$product->receiving_phone = $data->receiving_phone;
$product->booking_id = $data->booking_id;
$product->delivery_charges = $data->delivery_charges;
$product->receiving_date_time = date('Y-m-d H:i:s');

// create the product
if($product->create()){
    echo '{';
        echo '"message": "receiving created."';
    echo '}';
}

// if unable to create the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to create receiving."';
    echo '}';
}
?>
