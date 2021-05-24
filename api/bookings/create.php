<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate bookings object
include_once '../objects/bookings.php';

$database = new Database();
$db = $database->getConnection();

$bookings = new Bookings($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));
date_default_timezone_set('Asia/Kolkata');

// set bookings property values
$bookings->admin_id = $data->admin_id;
$bookings->branch_id = $data->branch_id;
$bookings->date = date('Y-m-d H:i:s');
$bookings->from_place = $data->from_place;
$bookings->to_place = $data->to_place;
$bookings->gc_no = $data->gc_no;
$bookings->eway_bill_no = $data->eway_bill_no;
$bookings->consignor_phone = $data->consignor_phone;
$bookings->consignor_name_add = $data->consignor_name_add;
$bookings->consignee_phone = $data->consignee_phone;
$bookings->consignee_name_add = $data->consignee_name_add;
$bookings->no_of_packages = $data->no_of_packages;
$bookings->act_wt = $data->act_wt;
$bookings->consignment_value = $data->consignment_value;
$bookings->desc_of_goods = $data->desc_of_goods;
$bookings->basic_freight = $data->basic_freight;
$bookings->hamali = $data->hamali;
$bookings->stat_charges = $data->stat_charges;
// $bookings->sc = $data->sc;
$bookings->value_of_sc = $data->value_of_sc;
// $bookings->aoc = $data->aoc;
$bookings->transhipment = $data->transhipment;
$bookings->c_charges = $data->c_charges;
// $bookings->d_charges = $data->d_charges;
$bookings->with_pass = $data->with_pass;
$bookings->gst = $data->gst;
$bookings->total = $data->total;
$bookings->subtotal = $data->subtotal;
$bookings->payment_mode = $data->payment_mode;
$bookings->delivery_charges = $data->delivery_charges;
$bookings->status = "booked";



// create the bookings
if($bookings->create()){
    echo '{';
        echo '"message": "bookings was created."';
    echo '}';
}

// if unable to create the bookings, tell the user
else{
    echo '{';
        echo '"message": "Unable to create bookings."';
    echo '}';
}
?>
