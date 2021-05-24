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
    $stmt = $bookings->read();
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
