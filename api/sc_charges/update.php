<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/sc_charges.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare sc_charges object
$sc_charges = new SCCharges($db);

// get id of sc_charges to be edited
$data = json_decode(file_get_contents("php://input"));

// set ID property of sc_charges to be edited
$sc_charges->sc_charge_id = $data->sc_charge_id;

// set sc_charges property values
$sc_charges->consignment_value = $data->consignment_value;
$sc_charges->sc_charge = $data->sc_charge;

// update the sc_charges
if($sc_charges->update()){
    echo '{';
        echo '"message": "sc_charges was updated."';
    echo '}';
}

// if unable to update the sc_charges, tell the user
else{
    echo '{';
        echo '"message": "Unable to update sc_charges."';
    echo '}';
}
?>
