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
    $orders = new Bookings($db);

    // set ID property of products
    $orders->branch_id = isset($_GET['branch_id']) ? $_GET['branch_id'] : die();

    // read the details of product to be edited
    $stmt = $orders->readToPayBranch();
    $num = $stmt->rowCount();//extra


    if($num>0){
      // products array
      $orderss_arr = array();
      $orderss_arr["records"] = array();

      // retrive our table contents
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          // extract row
          // this will make $row['name'] to just $name only
          extract($row);
          $orders_items = array(
            "booking_id"=>$booking_id,
            "admin_id"=>$admin_id,
            "branch_id"=>$branch_id,
            "branch_name"=>$branch_name,
            "date"=>$date,
            "from_place" =>$from_place,
            "to_place" =>$to_place,
            "gc_no"=>$gc_no,
            "eway_bill_no"=>$eway_bill_no,
            "consignor_phone"=>$consignor_phone,
            "consignor_name_add" =>$consignor_name_add,
            "consignee_phone" =>$consignee_phone,
            "consignee_name_add"=>$consignee_name_add,
            "no_of_packages"=>$no_of_packages,
            "act_wt"=>$act_wt,
            "consignment_value" =>$consignment_value,
            "desc_of_goods" =>$desc_of_goods,
            "basic_freight"=>$basic_freight,
            "hamali"=>$hamali,
            "stat_charges"=>$stat_charges,
            // "sc" =>$sc,
            "value_of_sc" =>$value_of_sc,
            // "aoc"=>$aoc,
            "transhipment"=>$transhipment,
            "c_charges"=>$c_charges,
            // "d_charges" =>$d_charges,
            "with_pass" =>$with_pass,
            "gst" =>$gst,
            "subtotal" =>$subtotal,
            "delivery_charges" =>$delivery_charges,
            "total" =>$total,
            "payment_mode" =>$payment_mode,
            "status" =>$status
        );
        array_push($orderss_arr["records"],$orders_items);
      }
      echo json_encode($orderss_arr);
    }
    else{
      echo json_encode(
        array("message"=>"No bookings found")
      );
    }

?>
