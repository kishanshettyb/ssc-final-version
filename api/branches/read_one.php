<?php

    // required Headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');

    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/branches.php';

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    //prepare branches objects
    $branches = new Branches($db);

    // set ID property of branchess
    $branches->branch_id = isset($_GET['branch_id']) ? $_GET['branch_id'] : die();

    // read the details of branches to be edited
    $branches->readOne();

    // create array
    $branches_arr = array(
      "branch_id" =>  $branches->branch_id,
      "branch_name" => $branches->branch_name,
      "branch_code" => $branches->branch_code,
      "status" => $branches->status,
      "branch_phone" => $branches->branch_phone
    );

    // make it json format
    print_r(json_encode($branches_arr));

?>
