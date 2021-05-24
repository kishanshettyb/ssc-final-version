<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: Application/json; charset=UTF-8");

    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/hamali.php';

    // instantiate database and product objects
    $database = new Database();
    $db = $database->getConnection();

    // initialize object
    $hamali = new Hamali($db);

    // Query hamali
    $stmt = $hamali->read();
    $num = $stmt->rowCount();

    // check if more than 0 record found
    if($num>0){
      // hamali array
      $hamalis_arr = array();
      $hamalis_arr["records"] = array();

      // retrive our table contents
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          // extract row
          // this will make $row['name'] to just $name only
          extract($row);
          $hamali_items = array(
            "hamali_charge_id"=>$hamali_charge_id,
            "no_of_packages"=>$no_of_packages,
            "hamali_charge"=>$hamali_charge

        );
        array_push($hamalis_arr["records"],$hamali_items);
      }

      echo json_encode($hamalis_arr);
    }
    else{
      echo json_encode(
        array("message"=>"No hamali Found")
      );
    }
 ?>
