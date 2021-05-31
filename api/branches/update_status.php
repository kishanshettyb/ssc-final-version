<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/branches.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare branches object
$branches = new Branches($db);

// get id of branches to be edited
$data = json_decode(file_get_contents("php://input"));

// set ID property of branches to be edited
$branches->branch_id = $data->branch_id;

// set branches property values
$branches->status = $data->status;

// update the branches
if($branches->updateStatus()){
    echo '{';
        echo '"message": "branches was updated."';
    echo '}';
}

// if unable to update the branches, tell the user
else{
    echo '{';
        echo '"message": "Unable to update branches."';
    echo '}';
}
?>
