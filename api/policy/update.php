<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/policy.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare policy object
$policy = new Policy($db);

// get id of policy to be edited
$data = json_decode(file_get_contents("php://input"));

// set ID property of policy to be edited
$policy->policy_id = $data->policy_id;

// set policy property values
$policy->policy_name = $data->policy_name;

// update the policy
if($policy->update()){
    echo '{';
        echo '"message": "policy was updated."';
    echo '}';
}

// if unable to update the policy, tell the user
else{
    echo '{';
        echo '"message": "Unable to update policy."';
    echo '}';
}
?>
