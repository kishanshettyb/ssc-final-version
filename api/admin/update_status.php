<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/admin.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare admin object
$admin = new Admin($db);

// get id of admin to be edited
$data = json_decode(file_get_contents("php://input"));

// set ID property of admin to be edited
$admin->admin_id = $data->admin_id;

// set admin property values
$admin->status = $data->status; 


// update the admin
if($admin->updateStatus()){
    echo '{';
        echo '"message": "admin was updated."';
    echo '}';
}

// if unable to update the admin, tell the user
else{
    echo '{';
        echo '"message": "Unable to update admin."';
    echo '}';
}
?>
