<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate Branches object
include_once '../objects/branches.php';

$database = new Database();
$db = $database->getConnection();

$branches = new Branches($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set Branches property values
$branches->branch_name = $data->branch_name;
$branches->branch_code = $data->branch_code;
$branches->branch_phone = $data->branch_phone;

// create the Branches
if($branches->create()){
    echo '{';
        echo '"message": "branches was created."';
    echo '}';
}

// if unable to create the Branches, tell the user
else{
    echo '{';
        echo '"message": "Unable to create branches."';
    echo '}';
}
?>
