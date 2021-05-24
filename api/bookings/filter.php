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
    $customer = new Bookings($db);

    // set ID property of products
   
    $customer->branch_name = isset($_GET['branch_name']) ? $_GET['branch_name'] : die();
    $customer->payment_mode = isset($_GET['payment_mode']) ? $_GET['payment_mode'] : die();
    $customer->status = isset($_GET['status']) ? $_GET['status'] : die();
    $customer->start_date = isset($_GET['start_date']) ? $_GET['start_date'] : die();
    $customer->end_date = isset($_GET['end_date']) ? $_GET['end_date'] : die();

    $stmt = $customer->filter_bookings();
    $num = $stmt->rowCount();//extra


    if($num>0){
      $customers_arr["records"] = array();

      // retrive our table contents
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          extract($row);
          $customer_items = array(
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
            "total" =>$total,
            "payment_mode" =>$payment_mode,
            "status" =>$status

        );
        array_push($customers_arr['records'],$customer_items);
      }

      echo json_encode($customers_arr);
    }
    else{
      echo json_encode(
        array("message"=>"No data found")
      );
    }

?>
