<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate policy object
include_once '../objects/policy.php';

$database = new Database();
$db = $database->getConnection();

$policy = new Policy($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set policy property values
$policy->policy_name = $data->policy_name;


// create the policy
if($policy->create()){
    echo '{';
        echo '"message": "policy was created."';
    echo '}';
}

// if unable to create the policy, tell the user
else{
    echo '{';
        echo '"message": "Unable to create policy."';
    echo '}';
}
?>
