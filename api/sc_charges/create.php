<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate sc_charges object
include_once '../objects/sc_charges.php';

$database = new Database();
$db = $database->getConnection();

$sc_charges = new SCCharges($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set sc_charges property values
$sc_charges->consignment_value = $data->consignment_value;
$sc_charges->sc_charge = $data->sc_charge;

// create the sc_charges
if($sc_charges->create()){
    echo '{';
        echo '"message": "sc_charges was created."';
    echo '}';
}

// if unable to create the sc_charges, tell the user
else{
    echo '{';
        echo '"message": "Unable to create sc_charges."';
    echo '}';
}
?>
