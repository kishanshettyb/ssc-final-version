<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: Application/json; charset=UTF-8");

    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/policy.php';

    // instantiate database and product objects
    $database = new Database();
    $db = $database->getConnection();

    // initialize object
    $policy = new Policy($db);

    // Query policy
    $stmt = $policy->read();
    $num = $stmt->rowCount();

    // check if more than 0 record found
    if($num>0){
      // policy array
      $policys_arr = array();
      $policys_arr["records"] = array();

      // retrive our table contents
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          // extract row
          // this will make $row['name'] to just $name only
          extract($row);
          $policy_items = array(
            "policy_id"=>$policy_id,
            "policy_name"=>$policy_name,
        );
        array_push($policys_arr["records"],$policy_items);
      }

      echo json_encode($policys_arr);
    }
    else{
      echo json_encode(
        array("message"=>"No policy Found")
      );
    }
 ?>
