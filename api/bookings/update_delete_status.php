<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/bookings.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare bookings object
$bookings = new Bookings($db);

// get id of bookings to be edited
$data = json_decode(file_get_contents("php://input"));

// set ID property of bookings to be edited
$bookings->booking_id = $data->booking_id;

// set bookings property values
$bookings->status = $data->status;
$bookings->total = $data->total;




// update the bookings
if($bookings->updateDeleteStatus()){
    echo '{';
        echo '"message": "bookings was updated."';
    echo '}';
}

// if unable to update the bookings, tell the user
else{
    echo '{';
        echo '"message": "Unable to update bookings."';
    echo '}';
}
?>
