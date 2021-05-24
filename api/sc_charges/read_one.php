<?php

    // required Headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');

    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/sc_charges.php';

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    //prepare product objects
    $sc_charges = new SCCharges($db);

    // set ID property of sc_charges
    $sc_charges->sc_charge_id = isset($_GET['sc_charge_id']) ? $_GET['sc_charge_id'] : die();

    // read the details of product to be edited
    $sc_charges->readOne();

    // create array
    $sc_charges_arr = array(
      "sc_charge_id" =>  $sc_charges->sc_charge_id,
      "consignment_value" => $sc_charges->consignment_value,
      "sc_charge" => $sc_charges->sc_charge

    );

    // make it json format
    print_r(json_encode($sc_charges_arr));

?>
