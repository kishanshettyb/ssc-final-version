<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate hamali object
include_once '../objects/hamali.php';

$database = new Database();
$db = $database->getConnection();

$hamali = new Hamali($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set hamali property values
$hamali->no_of_packages = $data->no_of_packages;
$hamali->hamali_charge = $data->hamali_charge;


// create the hamali
if($hamali->create()){
    echo '{';
        echo '"message": "hamali was created."';
    echo '}';
}

// if unable to create the hamali, tell the user
else{
    echo '{';
        echo '"message": "Unable to create hamali."';
    echo '}';
}
?>
