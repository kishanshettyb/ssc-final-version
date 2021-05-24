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
include_once '../objects/customers.php';

$database = new Database();
$db = $database->getConnection();

$product = new Customers($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set product property values
$product->consignor_name = $data->consignor_name;
$product->consignor_phone = $data->consignor_phone;
$product->consignee_name = $data->consignee_name;
$product->consignee_phone = $data->consignee_phone;

// create the product
if($product->create()){
    echo '{';
        echo '"message": "Customer created."';
    echo '}';
}

// if unable to create the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to create customer."';
    echo '}';
}
?>
