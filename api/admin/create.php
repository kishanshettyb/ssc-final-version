<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate Admin object
include_once '../objects/admin.php';

$database = new Database();
$db = $database->getConnection();

$admin = new Admin($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set Admin property values
$admin->username = $data->username;
$admin->password = $data->password;
$admin->name = $data->name;
$admin->email = $data->email;
$admin->phone = $data->phone;
$admin->address = $data->address;
$admin->branch = $data->branch;
$admin->profile = $data->profile;
$admin->status = $data->status;
$admin->branch_id = $data->branch_id;


// create the Admin
if($admin->create()){
    echo '{';
        echo '"message": "admin was created."';
    echo '}';
}

// if unable to create the Admin, tell the user
else{
    echo '{';
        echo '"message": "Unable to create admin."';
    echo '}';
}
?>
