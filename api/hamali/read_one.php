<?php

    // required Headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');

    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/hamali.php';

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    //prepare hamali objects
    $hamali = new Hamali($db);

    // set ID property of hamalis
    $hamali->hamali_charge_id = isset($_GET['hamali_charge_id']) ? $_GET['hamali_charge_id'] : die();

    // read the details of hamali to be edited
    $hamali->readOne();

    // create array
    $hamali_arr = array(
      "hamali_charge_id" =>  $hamali->hamali_charge_id,
      "no_of_packages" => $hamali->no_of_packages,
      "hamali_charge" => $hamali->hamali_charge
    );

    // make it json format
    print_r(json_encode($hamali_arr));

?>
