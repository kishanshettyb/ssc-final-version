<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/hamali.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare hamali object
$hamali = new Hamali($db);

// get id of hamali to be edited
$data = json_decode(file_get_contents("php://input"));

// set ID property of hamali to be edited
$hamali->hamali_charge_id = $data->hamali_charge_id;

// set hamali property values
$hamali->no_of_packages = $data->no_of_packages;
$hamali->hamali_charge = $data->hamali_charge;


// update the hamali
if($hamali->update()){
    echo '{';
        echo '"message": "hamali was updated."';
    echo '}';
}

// if unable to update the hamali, tell the user
else{
    echo '{';
        echo '"message": "Unable to update hamali."';
    echo '}';
}
?>
