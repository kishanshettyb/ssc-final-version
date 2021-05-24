<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: Application/json; charset=UTF-8");

    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/receivings.php';

    // instantiate database and product objects
    $database = new Database();
    $db = $database->getConnection();

    // initialize object
    $product = new Receivings($db);

    // Query Products
    $stmt = $product->read();
    $num = $stmt->rowCount();

    // check if more than 0 record found
    if($num>0){
      // products array
      $products_arr = array();
      $products_arr["records"] = array();

      // retrive our table contents
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          // extract row
          // this will make $row['name'] to just $name only
          extract($row);
          $product_items = array(
            "receiving_id"=>$receiving_id,
            "receiving_name"=>$receiving_name,
            "receiving_phone"=>$receiving_phone,
            "booking_id" =>$booking_id,
            "delivery_charges" =>$delivery_charges,
            "receiving_date_time" =>$receiving_date_time
        );
        array_push($products_arr["records"],$product_items);
      }

      echo json_encode($products_arr);
    }
    else{
      echo json_encode(
        array("message"=>"No receivings Found")
      );
    }
 ?>
