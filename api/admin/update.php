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
$admin->username = $data->username;
$admin->password = $data->password;
$admin->name = $data->name;
$admin->email = $data->email;
$admin->phone = $data->phone;
$admin->address = $data->address;
$admin->branch = $data->branch;
$admin->profile = $data->profile;
$admin->branch_id = $data->branch_id;


// update the admin
if($admin->update()){
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
