<?php

    // required Headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');

    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/bookings.php';

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    //prepare product objects
    $bookings = new Bookings($db);

    // set ID property of bookings
    $bookings->gc_no = isset($_GET['gc_no']) ? $_GET['gc_no'] : die();

    // read the details of product to be edited
    $bookings->readOneGCNo();

    // create array
    $bookings_arr = array(
      "booking_id" =>  $bookings->booking_id,
      "admin_id" => $bookings->admin_id,
      "branch_id" => $bookings->branch_id,
      // "branch_name" => $bookings->branch_name,
      "date" => $bookings->date,
      "from_place" => $bookings->from_place,
      "to_place" => $bookings->to_place,
      "gc_no" =>  $bookings->gc_no,
      "eway_bill_no" => $bookings->eway_bill_no,
      "consignor_phone" => $bookings->consignor_phone,
      "consignor_name_add" => $bookings->consignor_name_add,
      "consignee_phone" => $bookings->consignee_phone,
      "consignee_name_add" =>  $bookings->consignee_name_add,
      "no_of_packages" => $bookings->no_of_packages,
      "act_wt" => $bookings->act_wt,
      "consignment_value" => $bookings->consignment_value,
      "desc_of_goods" => $bookings->desc_of_goods,
      "basic_freight" =>  $bookings->basic_freight,
      "hamali" => $bookings->hamali,
      "stat_charges" => $bookings->stat_charges,
      // "sc" => $bookings->sc,
      "value_of_sc" => $bookings->value_of_sc,
      // "aoc" =>  $bookings->aoc,
      "transhipment" => $bookings->transhipment,
      "c_charges" => $bookings->c_charges,
      // "d_charges" => $bookings->d_charges,
      "with_pass" => $bookings->with_pass,
      "gst" => $bookings->gst,
      "delivery_charges" => $bookings->delivery_charges,
      "total" => $bookings->total,
      "subtotal" => $bookings->subtotal,
      "payment_mode" => $bookings->payment_mode,
      "status" => $bookings->status
    );

    // make it json format
    print_r(json_encode($bookings_arr));

?>
