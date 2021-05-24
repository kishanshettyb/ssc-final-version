<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: Application/json; charset=UTF-8");

    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/bookings.php';

    // instantiate database and product objects
    $database = new Database();
    $db = $database->getConnection();

    // initialize object
    $bookings = new Bookings($db);

    // Query bookings
    $stmt = $bookings->readCustomers();
    $num = $stmt->rowCount();

    // check if more than 0 record found
    if($num>0){
      // bookings array
      $bookingss_arr = array();
      $bookingss_arr["records"] = array();

      // retrive our table contents
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          // extract row
          // this will make $row['name'] to just $name only
          extract($row);
          $bookings_items = array(

            "consignor_phone"=>$consignor_phone,
            "consignor_name_add" =>$consignor_name_add,
            "consignee_phone" =>$consignee_phone,
            "consignee_name_add"=>$consignee_name_add,

        );
        array_push($bookingss_arr["records"],$bookings_items);
      }

      echo json_encode($bookingss_arr);
    }
    else{
      echo json_encode(
        array("message"=>"No bookings Found")
      );
    }
 ?>
