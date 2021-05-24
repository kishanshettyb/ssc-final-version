<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: Application/json; charset=UTF-8");

    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/branches.php';

    // instantiate database and product objects
    $database = new Database();
    $db = $database->getConnection();

    // initialize object
    $branches = new Branches($db);

    // Query Branches
    $stmt = $branches->read();
    $num = $stmt->rowCount();

    // check if more than 0 record found
    if($num>0){
      // Branches array
      $branchess_arr = array();
      $branchess_arr["records"] = array();

      // retrive our table contents
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          // extract row
          // this will make $row['name'] to just $name only
          extract($row);
          $branches_items = array(
            "branch_id"=>$branch_id,
            "branch_name"=>$branch_name,
            "branch_phone"=>$branch_phone,
            "branch_code"=>$branch_code

        );
        array_push($branchess_arr["records"],$branches_items);
      }

      echo json_encode($branchess_arr);
    }
    else{
      echo json_encode(
        array("message"=>"No Branches Found")
      );
    }
 ?>
