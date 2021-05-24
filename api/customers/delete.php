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

// prepare image object
$image = new Customers($db);

// get id of image to be edited
$data = json_decode(file_get_contents("php://input"));

// set ID property of image to be edited
$image->customer_id = $data->customer_id;

// update the image
if($image->delete_customer()){
    echo '{';
        echo '"message": "customer deleted."';
    echo '}';
}

// if unable to update the image, tell the user
else{
    echo '{';
        echo '"message": "Unable to delete customer."';
    echo '}';
}
?>
