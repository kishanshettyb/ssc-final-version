<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: Application/json; charset=UTF-8");

    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/sc_charges.php';

    // instantiate database and product objects
    $database = new Database();
    $db = $database->getConnection();

    // initialize object
    $sc_charges = new SCCharges($db);

    // Query sc_charges
    $stmt = $sc_charges->read();
    $num = $stmt->rowCount();

    // check if more than 0 record found
    if($num>0){
      // sc_charges array
      $sc_chargess_arr = array();
      $sc_chargess_arr["records"] = array();

      // retrive our table contents
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          // extract row
          // this will make $row['name'] to just $name only
          extract($row);
          $sc_charges_items = array(
            "sc_charge_id"=>$sc_charge_id,
            "consignment_value"=>$consignment_value,
            "sc_charge"=>$sc_charge
        );
        array_push($sc_chargess_arr["records"],$sc_charges_items);
      }

      echo json_encode($sc_chargess_arr);
    }
    else{
      echo json_encode(
        array("message"=>"No sc_charges Found")
      );
    }
 ?>
