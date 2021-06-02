<?php

  class Bookings
  {
      // databse connection and table names
      private $conn;
      private $table_name = "bookings";

      // Object properties
      public $booking_id;
      public $admin_id;
      public $branch_id;
      public $date;
      public $from_place;
      public $to_place;
      public $gc_no;
      public $eway_bill_no;
      public $consignor_phone;
      public $consignor_name_add;
      public $consignee_phone;
      public $consignee_name_add;
      public $no_of_packages;
      public $act_wt;
      public $consignment_value;
      public $desc_of_goods;
      public $basic_freight;
      public $hamali;
      public $stat_charges;
      // public $sc;
      public $value_of_sc;
      // public $aoc;
      public $transhipment;
      public $c_charges;
      // public $d_charges;
      public $with_pass;
      public $gst;
      public $total;
      public $subtotal;
      public $payment_mode;
      public $delivery_charges;





      // constructor with $db as database connection
      public function __construct($db)
      {
        $this->conn = $db;
      }

      // read productss
      function read(){
        // Select all Query
        $query = "SELECT bookings.*, branches.branch_name FROM
                  ".$this->table_name." 
                   INNER JOIN branches ON branches.branch_id = bookings.branch_id WHERE bookings.from_place='BENGALURU'
                  ORDER BY booking_id DESC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute Query
        $stmt->execute();

        return $stmt;
      }

       // read productss
       function readBranch(){

        // query to read single record
        $query = "SELECT  bookings.*, branches.branch_name FROM
        ".$this->table_name."
        INNER JOIN branches ON branches.branch_id = bookings.branch_id
        WHERE bookings.branch_id = ? ORDER BY bookings.booking_id DESC ";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of product to be updated
        $stmt->bindParam(1, $this->branch_id);

        // execute query
        $stmt->execute();

        return $stmt;
      }

      function readToplace(){

        // query to read single record
        $query = "SELECT  bookings.*, branches.branch_name FROM
        ".$this->table_name."
        INNER JOIN branches ON branches.branch_id = bookings.branch_id
        WHERE bookings.to_place = ? ORDER BY bookings.booking_id DESC ";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of product to be updated
        $stmt->bindParam(1, $this->to_place);

        // execute query
        $stmt->execute();

        return $stmt;
      }
      
      // read productss
      function readPaidBranch(){

        // query to read single record
        $query = "SELECT  bookings.*, branches.branch_name FROM
        ".$this->table_name."
        INNER JOIN branches ON branches.branch_id = bookings.branch_id
        WHERE  bookings.payment_mode = 'Paid' AND bookings.branch_id =  ? ORDER BY booking_id DESC ";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of product to be updated
        $stmt->bindParam(1, $this->branch_id);

        // execute query
        $stmt->execute();

        return $stmt;
      }

      // read productss
      function readToPayBranch(){

        // query to read single record
        $query = "SELECT  bookings.*, branches.branch_name FROM
        ".$this->table_name."
        INNER JOIN branches ON branches.branch_id = bookings.branch_id
        WHERE  bookings.payment_mode = 'To Pay' AND bookings.branch_id =  ? ORDER BY booking_id DESC ";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of product to be updated
        $stmt->bindParam(1, $this->branch_id);

        // execute query
        $stmt->execute();

        return $stmt;
      }

           

      // read productss
      function readPaid(){
        // Select all Query
        $query = "SELECT  bookings.*, branches.branch_name FROM ".$this->table_name." 
        INNER JOIN branches ON branches.branch_id = bookings.branch_id
        
        WHERE bookings.payment_mode = 'Paid' ORDER BY bookings.booking_id DESC ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute Query
        $stmt->execute();

        return $stmt;
      }
      // read productss
      function readToPay(){
        // Select all Query
        $query = "SELECT  bookings.*, branches.branch_name FROM ".$this->table_name." 
        INNER JOIN branches ON branches.branch_id = bookings.branch_id 
        WHERE bookings.payment_mode = 'To Pay' ORDER BY bookings.booking_id DESC ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute Query
        $stmt->execute();

        return $stmt;
      }

      function readCustomers(){
        // Select all Query
        $query = "SELECT consignor_phone,consignor_name_add,consignee_phone,consignee_name_add FROM
                  ".$this->table_name."  ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute Query
        $stmt->execute();

        return $stmt;
      }

      // Create products
      function create(){
        $query = "SELECT  * FROM ".$this->table_name." WHERE gc_no=:gc_no";
        $stmt1 = $this->conn->prepare($query);
        $stmt1->bindParam(":gc_no", $this->gc_no);
        $stmt1->execute();

        if($stmt1->rowCount() > 0){
            return false;
        } else {
            $this->insert();
            return true;
        }
      }
      function insert(){

        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    admin_id=:admin_id,
                    branch_id=:branch_id,
                    date=:date,
                     from_place=:from_place, 
                     to_place=:to_place,
                      gc_no=:gc_no,
                    eway_bill_no=:eway_bill_no, 
                    consignor_phone=:consignor_phone,
                     consignor_name_add=:consignor_name_add, 
                     consignee_phone=:consignee_phone,
                      consignee_name_add=:consignee_name_add,
                    no_of_packages=:no_of_packages, 
                    act_wt=:act_wt, 
                    consignment_value=:consignment_value, 
                    desc_of_goods=:desc_of_goods, 
                    basic_freight=:basic_freight,
                    hamali=:hamali, 
                    stat_charges=:stat_charges, 
                    value_of_sc=:value_of_sc, 
                    transhipment=:transhipment, 
                    c_charges=:c_charges, 
                    with_pass=:with_pass, 
                    gst=:gst,
                    total=:total,
                    subtotal=:subtotal,
                    status=:status,
                    delivery_charges=:delivery_charges,
                    payment_mode=:payment_mode";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->admin_id=htmlspecialchars(strip_tags($this->admin_id));
        $this->branch_id=htmlspecialchars(strip_tags($this->branch_id));
        $this->date=htmlspecialchars(strip_tags($this->date));
        $this->from_place=htmlspecialchars(strip_tags($this->from_place));
        $this->to_place=htmlspecialchars(strip_tags($this->to_place));
        $this->gc_no=htmlspecialchars(strip_tags($this->gc_no));
        $this->eway_bill_no=htmlspecialchars(strip_tags($this->eway_bill_no));
        $this->consignor_phone=htmlspecialchars(strip_tags($this->consignor_phone));
        $this->consignor_name_add=htmlspecialchars(strip_tags($this->consignor_name_add));
        $this->consignee_phone=htmlspecialchars(strip_tags($this->consignee_phone));
        $this->consignee_name_add=htmlspecialchars(strip_tags($this->consignee_name_add));
        $this->no_of_packages=htmlspecialchars(strip_tags($this->no_of_packages));
        $this->act_wt=htmlspecialchars(strip_tags($this->act_wt));
        $this->consignment_value=htmlspecialchars(strip_tags($this->consignment_value));
        $this->desc_of_goods=htmlspecialchars(strip_tags($this->desc_of_goods));
        $this->basic_freight=htmlspecialchars(strip_tags($this->basic_freight));
        $this->hamali=htmlspecialchars(strip_tags($this->hamali));
        $this->stat_charges=htmlspecialchars(strip_tags($this->stat_charges));
        // $this->sc=htmlspecialchars(strip_tags($this->sc));
        $this->value_of_sc=htmlspecialchars(strip_tags($this->value_of_sc));
        // $this->aoc=htmlspecialchars(strip_tags($this->aoc));
        $this->transhipment=htmlspecialchars(strip_tags($this->transhipment));
        $this->c_charges=htmlspecialchars(strip_tags($this->c_charges));
        // $this->d_charges=htmlspecialchars(strip_tags($this->d_charges));
        $this->with_pass=htmlspecialchars(strip_tags($this->with_pass));
        $this->gst=htmlspecialchars(strip_tags($this->gst));
        $this->total=htmlspecialchars(strip_tags($this->total));
        $this->subtotal=htmlspecialchars(strip_tags($this->subtotal));
        $this->status=htmlspecialchars(strip_tags($this->status));
        $this->delivery_charges=htmlspecialchars(strip_tags($this->delivery_charges));
        $this->payment_mode=htmlspecialchars(strip_tags($this->payment_mode));



        // bind values
        $stmt->bindParam(":admin_id", $this->admin_id);
        $stmt->bindParam(":branch_id", $this->branch_id);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":from_place", $this->from_place);
        $stmt->bindParam(":to_place", $this->to_place);
        $stmt->bindParam(":gc_no", $this->gc_no);
        $stmt->bindParam(":eway_bill_no", $this->eway_bill_no);
        $stmt->bindParam(":consignor_phone", $this->consignor_phone);
        $stmt->bindParam(":consignor_name_add", $this->consignor_name_add);
        $stmt->bindParam(":consignee_phone", $this->consignee_phone);
        $stmt->bindParam(":consignee_name_add", $this->consignee_name_add);
        $stmt->bindParam(":no_of_packages", $this->no_of_packages);
        $stmt->bindParam(":act_wt", $this->act_wt);
        $stmt->bindParam(":consignment_value", $this->consignment_value);
        $stmt->bindParam(":desc_of_goods", $this->desc_of_goods);
        $stmt->bindParam(":basic_freight", $this->basic_freight);
        $stmt->bindParam(":hamali", $this->hamali);
        $stmt->bindParam(":stat_charges", $this->stat_charges);
        // $stmt->bindParam(":sc", $this->sc);
        $stmt->bindParam(":value_of_sc", $this->value_of_sc);
        // $stmt->bindParam(":aoc", $this->aoc);
        $stmt->bindParam(":transhipment", $this->transhipment);
        $stmt->bindParam(":c_charges", $this->c_charges);
        // $stmt->bindParam(":d_charges", $this->d_charges);
        $stmt->bindParam(":with_pass", $this->with_pass);
        $stmt->bindParam(":gst", $this->gst);
        $stmt->bindParam(":total", $this->total);
        $stmt->bindParam(":subtotal", $this->subtotal);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":delivery_charges", $this->delivery_charges);
        $stmt->bindParam(":payment_mode", $this->payment_mode);




        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
      }

      // read one
      function readOne(){

        // query to read single record
        $query = "SELECT
                *
              FROM
                  " . $this->table_name . "
              WHERE
                booking_id = ?";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of product to be updated
        $stmt->bindParam(1, $this->booking_id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->admin_id = $row['admin_id'];
        $this->branch_id = $row['branch_id'];
        $this->date = $row['date'];
        $this->from_place = $row['from_place'];
        $this->to_place = $row['to_place'];
        $this->gc_no = $row['gc_no'];
        $this->eway_bill_no = $row['eway_bill_no'];
        $this->consignor_phone = $row['consignor_phone'];
        $this->consignor_name_add = $row['consignor_name_add'];
        $this->consignee_phone = $row['consignee_phone'];
        $this->consignee_name_add = $row['consignee_name_add'];
        $this->no_of_packages = $row['no_of_packages'];
        $this->act_wt = $row['act_wt'];
        $this->consignment_value = $row['consignment_value'];
        $this->desc_of_goods = $row['desc_of_goods'];
        $this->basic_freight = $row['basic_freight'];
        $this->hamali = $row['hamali'];
        $this->stat_charges = $row['stat_charges'];
        // $this->sc = $row['sc'];
        $this->value_of_sc = $row['value_of_sc'];
        // $this->aoc = $row['aoc'];
        $this->transhipment = $row['transhipment'];
        $this->c_charges = $row['c_charges'];
        // $this->d_charges = $row['d_charges'];
        $this->with_pass = $row['with_pass'];
        $this->gst = $row['gst'];
        $this->total = $row['total'];
        $this->delivery_charges = $row['delivery_charges'];
        $this->subtotal = $row['subtotal'];
        $this->payment_mode = $row['payment_mode'];
        $this->status = $row['status'];

      }
      // read one
      function readOneGCNo(){

        // query to read single record
        $query = "SELECT  *
        FROM " . $this->table_name . " WHERE gc_no = ?  ";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of product to be updated
        $stmt->bindParam(1, $this->gc_no);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->admin_id = $row['admin_id'];
        $this->booking_id = $row['booking_id'];
        $this->branch_id = $row['branch_id'];
        // $this->branch_name = $row['branch_name'];
        $this->date = $row['date'];
        $this->from_place = $row['from_place'];
        $this->to_place = $row['to_place'];
        $this->gc_no = $row['gc_no'];
        $this->eway_bill_no = $row['eway_bill_no'];
        $this->consignor_phone = $row['consignor_phone'];
        $this->consignor_name_add = $row['consignor_name_add'];
        $this->consignee_phone = $row['consignee_phone'];
        $this->consignee_name_add = $row['consignee_name_add'];
        $this->no_of_packages = $row['no_of_packages'];
        $this->act_wt = $row['act_wt'];
        $this->consignment_value = $row['consignment_value'];
        $this->desc_of_goods = $row['desc_of_goods'];
        $this->basic_freight = $row['basic_freight'];
        $this->hamali = $row['hamali'];
        $this->stat_charges = $row['stat_charges'];
        // $this->sc = $row['sc'];
        $this->value_of_sc = $row['value_of_sc'];
        // $this->aoc = $row['aoc'];
        $this->transhipment = $row['transhipment'];
        $this->c_charges = $row['c_charges'];
        // $this->d_charges = $row['d_charges'];
        $this->with_pass = $row['with_pass'];
        $this->gst = $row['gst'];
        $this->total = $row['total'];
        $this->delivery_charges = $row['delivery_charges'];

        $this->subtotal = $row['subtotal'];
        $this->payment_mode = $row['payment_mode'];
        $this->status = $row['status'];

      }

      // read one
      function readOneGCNoBranch(){

        // query to read single record
        $query = "SELECT  * FROM " . $this->table_name . "
              WHERE     gc_no = ?   AND  to_place=? ";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of product to be updated
        $stmt->bindParam(1, $this->gc_no);
        $stmt->bindParam(2, $this->to_place);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->admin_id = $row['admin_id'];
        $this->booking_id = $row['booking_id'];
        $this->branch_id = $row['branch_id'];
        // $this->branch_name = $row['branch_name'];
        $this->date = $row['date'];
        $this->from_place = $row['from_place'];
        $this->to_place = $row['to_place'];
        $this->gc_no = $row['gc_no'];
        $this->eway_bill_no = $row['eway_bill_no'];
        $this->consignor_phone = $row['consignor_phone'];
        $this->consignor_name_add = $row['consignor_name_add'];
        $this->consignee_phone = $row['consignee_phone'];
        $this->consignee_name_add = $row['consignee_name_add'];
        $this->no_of_packages = $row['no_of_packages'];
        $this->act_wt = $row['act_wt'];
        $this->consignment_value = $row['consignment_value'];
        $this->desc_of_goods = $row['desc_of_goods'];
        $this->basic_freight = $row['basic_freight'];
        $this->hamali = $row['hamali'];
        $this->stat_charges = $row['stat_charges'];
        // $this->sc = $row['sc'];
        $this->value_of_sc = $row['value_of_sc'];
        // $this->aoc = $row['aoc'];
        $this->transhipment = $row['transhipment'];
        $this->c_charges = $row['c_charges'];
        // $this->d_charges = $row['d_charges'];
        $this->with_pass = $row['with_pass'];
        $this->gst = $row['gst'];
        $this->total = $row['total'];
        $this->delivery_charges = $row['delivery_charges'];

        $this->subtotal = $row['subtotal'];
        $this->payment_mode = $row['payment_mode'];
        $this->status = $row['status'];

      }



            
      

      // read one
      function readOneBranch(){

        // query to read single record
        $query = "SELECT
                *
              FROM
                  " . $this->table_name . "
              WHERE
                booking_id = ? AND branch_id = ?";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of product to be updated
        $stmt->bindParam(1, $this->booking_id);
        $stmt->bindParam(2, $this->branch_id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->admin_id = $row['admin_id'];
        $this->branch_id = $row['branch_id'];
        $this->date = $row['date'];
        $this->from_place = $row['from_place'];
        $this->to_place = $row['to_place'];
        $this->gc_no = $row['gc_no'];
        $this->eway_bill_no = $row['eway_bill_no'];
        $this->consignor_phone = $row['consignor_phone'];
        $this->consignor_name_add = $row['consignor_name_add'];
        $this->consignee_phone = $row['consignee_phone'];
        $this->consignee_name_add = $row['consignee_name_add'];
        $this->no_of_packages = $row['no_of_packages'];
        $this->act_wt = $row['act_wt'];
        $this->consignment_value = $row['consignment_value'];
        $this->desc_of_goods = $row['desc_of_goods'];
        $this->basic_freight = $row['basic_freight'];
        $this->hamali = $row['hamali'];
        $this->stat_charges = $row['stat_charges'];
        // $this->sc = $row['sc'];
        $this->value_of_sc = $row['value_of_sc'];
        // $this->aoc = $row['aoc'];
        $this->transhipment = $row['transhipment'];
        $this->c_charges = $row['c_charges'];
        // $this->d_charges = $row['d_charges'];
        $this->with_pass = $row['with_pass'];
        $this->gst = $row['gst'];
        $this->total = $row['total'];
        $this->delivery_charges = $row['delivery_charges'];

        $this->subtotal = $row['subtotal'];
        $this->payment_mode = $row['payment_mode'];

      }


      // update the product
      function update(){

          // update query
          $query = "UPDATE
                      " . $this->table_name . "
                  SET
                      admin_id = :admin_id,
                      branch_id = :branch_id,
                      date = :date,
                      from_place = :from_place,
                      to_place = :to_place,
                      gc_no = :gc_no,
                      eway_bill_no = :eway_bill_no,
                      consignor_phone = :consignor_phone,
                      consignor_name_add = :consignor_name_add,
                      consignee_phone = :consignee_phone,
                      consignee_name_add = :consignee_name_add,
                      no_of_packages = :no_of_packages,
                      act_wt = :act_wt,
                      consignment_value = :consignment_value,
                      desc_of_goods = :desc_of_goods,
                      basic_freight = :basic_freight,
                      hamali = :hamali,
                      stat_charges = :stat_charges,
                      value_of_sc = :value_of_sc,
                      transhipment = :transhipment,
                      c_charges = :c_charges,
                      with_pass = :with_pass,
                      gst = :gst,
                      total = :total,
                      subtotal = :subtotal,
                      payment_mode= :payment_mode,
                      status= :status




                  WHERE
                      booking_id = :booking_id";

          // prepare query statement
          $stmt = $this->conn->prepare($query);

          // sanitize
          $this->admin_id=htmlspecialchars(strip_tags($this->admin_id));
          $this->branch_id=htmlspecialchars(strip_tags($this->branch_id));
          $this->date=htmlspecialchars(strip_tags($this->date));
          $this->from_place=htmlspecialchars(strip_tags($this->from_place));
          $this->to_place=htmlspecialchars(strip_tags($this->to_place));
          $this->gc_no=htmlspecialchars(strip_tags($this->gc_no));
          $this->eway_bill_no=htmlspecialchars(strip_tags($this->eway_bill_no));
          $this->consignor_phone=htmlspecialchars(strip_tags($this->consignor_phone));
          $this->consignor_name_add=htmlspecialchars(strip_tags($this->consignor_name_add));
          $this->consignee_phone=htmlspecialchars(strip_tags($this->consignee_phone));
          $this->consignee_name_add=htmlspecialchars(strip_tags($this->consignee_name_add));
          $this->no_of_packages=htmlspecialchars(strip_tags($this->no_of_packages));
          $this->act_wt=htmlspecialchars(strip_tags($this->act_wt));
          $this->consignment_value=htmlspecialchars(strip_tags($this->consignment_value));
          $this->desc_of_goods=htmlspecialchars(strip_tags($this->desc_of_goods));
          $this->basic_freight=htmlspecialchars(strip_tags($this->basic_freight));
          $this->hamali=htmlspecialchars(strip_tags($this->hamali));
          $this->stat_charges=htmlspecialchars(strip_tags($this->stat_charges));
          // $this->sc=htmlspecialchars(strip_tags($this->sc));
          $this->value_of_sc=htmlspecialchars(strip_tags($this->value_of_sc));
          // $this->aoc=htmlspecialchars(strip_tags($this->aoc));
          $this->transhipment=htmlspecialchars(strip_tags($this->transhipment));
          $this->c_charges=htmlspecialchars(strip_tags($this->c_charges));
          // $this->d_charges=htmlspecialchars(strip_tags($this->d_charges));
          $this->with_pass=htmlspecialchars(strip_tags($this->with_pass));
          $this->gst=htmlspecialchars(strip_tags($this->gst));
          $this->total=htmlspecialchars(strip_tags($this->total));
          $this->subtotal=htmlspecialchars(strip_tags($this->subtotal));
          $this->payment_mode=htmlspecialchars(strip_tags($this->payment_mode));
          $this->status=htmlspecialchars(strip_tags($this->status));



          $this->booking_id=htmlspecialchars(strip_tags($this->booking_id));

          // bind new values
          $stmt->bindParam(':admin_id', $this->admin_id);
          $stmt->bindParam(':branch_id', $this->branch_id);
          $stmt->bindParam(':date', $this->date);
          $stmt->bindParam(':from_place', $this->from_place);
          $stmt->bindParam(':to_place', $this->to_place);
          $stmt->bindParam(':gc_no', $this->gc_no);
          $stmt->bindParam(':eway_bill_no', $this->eway_bill_no);
          $stmt->bindParam(':consignor_phone', $this->consignor_phone);
          $stmt->bindParam(':consignor_name_add', $this->consignor_name_add);
          $stmt->bindParam(':consignee_phone', $this->consignee_phone);
          $stmt->bindParam(':consignee_name_add', $this->consignee_name_add);
          $stmt->bindParam(':no_of_packages', $this->no_of_packages);
          $stmt->bindParam(':act_wt', $this->act_wt);
          $stmt->bindParam(':consignment_value', $this->consignment_value);
          $stmt->bindParam(':desc_of_goods', $this->desc_of_goods);
          $stmt->bindParam(':basic_freight', $this->basic_freight);
          $stmt->bindParam(':hamali', $this->hamali);
          $stmt->bindParam(':stat_charges', $this->stat_charges);
          // $stmt->bindParam(':sc', $this->sc);
          $stmt->bindParam(':value_of_sc', $this->value_of_sc);
          // $stmt->bindParam(':aoc', $this->aoc);
          $stmt->bindParam(':transhipment', $this->transhipment);
          $stmt->bindParam(':c_charges', $this->c_charges);
          // $stmt->bindParam(':d_charges', $this->d_charges);
          $stmt->bindParam(':with_pass', $this->with_pass);
          $stmt->bindParam(':gst', $this->gst);
          $stmt->bindParam(':total', $this->total);
          $stmt->bindParam(':subtotal', $this->subtotal);
          $stmt->bindParam(':payment_mode', $this->payment_mode);
          $stmt->bindParam(':status', $this->status);




          $stmt->bindParam(':booking_id', $this->booking_id);

          // execute the query
          if($stmt->execute()){
              return true;
          }

          return false;
      }
      // update the product
      function updateStatus(){

        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                     status= :status,
                     delivery_charges= :delivery_charges,
                     total= :total
                WHERE
                    booking_id = :booking_id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
      
        $this->status=htmlspecialchars(strip_tags($this->status));
        $this->delivery_charges=htmlspecialchars(strip_tags($this->delivery_charges));
        $this->total=htmlspecialchars(strip_tags($this->total));
        $this->booking_id=htmlspecialchars(strip_tags($this->booking_id));

        // bind new values
        
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':delivery_charges', $this->delivery_charges);
        $stmt->bindParam(':total', $this->total);
        $stmt->bindParam(':booking_id', $this->booking_id);

        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

     // update the product
      function updateDeleteStatus(){

        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                     status= :status,
                     total= :total
                WHERE
                    booking_id = :booking_id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
      
        $this->status=htmlspecialchars(strip_tags($this->status));
        $this->total=htmlspecialchars(strip_tags($this->total));
        $this->booking_id=htmlspecialchars(strip_tags($this->booking_id));

        // bind new values
        
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':total', $this->total);
        $stmt->bindParam(':booking_id', $this->booking_id);

        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

      // search products
      function search($keywords){

          $query  = "SELECT b.* FROM " . $this->table_name . " b
          WHERE b.consignor_phone LIKE ?  GROUP BY consignor_name_add
          HAVING COUNT(*) > 0  ";

          // prepare query statement
          $stmt = $this->conn->prepare($query);

          // sanitize
          $keywords=htmlspecialchars(strip_tags($keywords));
          $keywords = "%{$keywords}%";

          // bind
          $stmt->bindParam(1, $keywords);



          // execute query
          $stmt->execute();

          return $stmt;
      }

      function searchConsignee($keywords){

          $query  = "SELECT b.* FROM " . $this->table_name . " b
          WHERE b.consignee_phone LIKE ?  GROUP BY consignee_name_add
          HAVING COUNT(*) > 0 ";

          // prepare query statement
          $stmt = $this->conn->prepare($query);

          // sanitize
          $keywords=htmlspecialchars(strip_tags($keywords));
          $keywords = "%{$keywords}%";

          // bind
          $stmt->bindParam(1, $keywords);



          // execute query
          $stmt->execute();

          return $stmt;
      }
      function readCount(){

        // query to read single record
        $query = "SELECT count(booking_id) as total_rows from bookings  WHERE admin_id = ? AND payment_mode = ?";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of product to be updated
        $stmt->bindParam(1, $this->admin_id);
        $stmt->bindParam(2, $this->payment_mode);


        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->total_rows = $row['total_rows'];
      }

      function filter_bookings(){

       
          if ( $this->branch_name !== "All"  && $this->payment_mode !== "All"  && $this->status !== "All"   && $this->start_date !== "All" && $this->end_date !== "All") {
          $query = "SELECT  * FROM bookings 
           INNER JOIN branches ON branches.branch_id = bookings.branch_id
           WHERE branch_name = ? AND  payment_mode = ?  AND  bookings.status  = ? AND date BETWEEN ? AND ?  ";
          // prepare query statement
          $stmt = $this->conn->prepare( $query );

          // bind id of product to be updated
          
          $stmt->bindParam(1, $this->branch_name);
          $stmt->bindParam(2, $this->payment_mode);
          $stmt->bindParam(3, $this->status);
          $stmt->bindParam(4, $this->start_date);
          $stmt->bindParam(5, $this->end_date);


          // execute query
          $stmt->execute();
          return $stmt;
        }

         else if ($this->branch_name == "All"  && $this->payment_mode == "All"  && $this->status == "All"   && $this->start_date !== "All" && $this->end_date !== "All") {
           $query = "SELECT  * FROM bookings 
           INNER JOIN branches ON branches.branch_id = bookings.branch_id
           WHERE branch_name   LIKE '%'  AND  payment_mode   LIKE '%'  AND  bookings.status    LIKE '%'  AND date BETWEEN   ?  AND   ?   ";
           // prepare query statement
           $stmt = $this->conn->prepare( $query );

           // bind id of product to be updated
           $stmt->bindParam(1, $this->start_date);
           $stmt->bindParam(2, $this->end_date);
           


           // execute query
           $stmt->execute();
           return $stmt;
              }
// branch only
              else if ($this->branch_name !== "All"  && $this->payment_mode == "All"  && $this->status == "All"   && $this->start_date !== "All" && $this->end_date !== "All") {
                $query = "SELECT  * FROM bookings 
                INNER JOIN branches ON branches.branch_id = bookings.branch_id
                WHERE branch_name   = ?  AND  payment_mode   LIKE '%'  AND  bookings.status   LIKE '%'  AND date BETWEEN   ?  AND   ?   ";
                // prepare query statement
                $stmt = $this->conn->prepare( $query );
     
                // bind id of product to be updated
                $stmt->bindParam(1, $this->branch_name);
                $stmt->bindParam(2, $this->start_date);
                $stmt->bindParam(3, $this->end_date);
     
     
                // execute query
                $stmt->execute();
                return $stmt;
                   }
                  // payment only
                   else if ($this->branch_name == "All"  && $this->payment_mode !== "All"  && $this->status == "All"   && $this->start_date !== "All" && $this->end_date !== "All") {
                    $query = "SELECT  * FROM bookings 
                    INNER JOIN branches ON branches.branch_id = bookings.branch_id
                    WHERE branch_name   LIKE '%'  AND  payment_mode = ?    AND  bookings.status   LIKE '%'  AND date BETWEEN   ?  AND   ?   ";
                    // prepare query statement
                    $stmt = $this->conn->prepare( $query );
         
                    // bind id of product to be updated
                    $stmt->bindParam(1, $this->payment_mode);
                    $stmt->bindParam(2, $this->start_date);
                    $stmt->bindParam(3, $this->end_date);
         
         
                    // execute query
                    $stmt->execute();
                    return $stmt;
                       }


                        // status only
                   else if ($this->branch_name == "All"  && $this->payment_mode == "All"  && $this->status !== "All"   && $this->start_date !== "All" && $this->end_date !== "All") {
                    $query = "SELECT  * FROM bookings 
                    INNER JOIN branches ON branches.branch_id = bookings.branch_id
                    WHERE branch_name   LIKE '%'  AND  payment_mode LIKE '%'    AND  bookings.status   = ? AND date BETWEEN   ?  AND   ?   ";
                    // prepare query statement
                    $stmt = $this->conn->prepare( $query );
         
                    // bind id of product to be updated
                    $stmt->bindParam(1, $this->status);
                    $stmt->bindParam(2, $this->start_date);
                    $stmt->bindParam(3, $this->end_date);
         
         
                    // execute query
                    $stmt->execute();
                    return $stmt;
                       }

                         // branch & payment only
                   else if ($this->branch_name !== "All"  && $this->payment_mode !== "All"  && $this->status == "All"   && $this->start_date !== "All" && $this->end_date !== "All") {
                    $query = "SELECT  * FROM bookings 
                    INNER JOIN branches ON branches.branch_id = bookings.branch_id
                    WHERE branch_name   = ?  AND  payment_mode = ?   AND  bookings.status  LIKE '%' AND date BETWEEN   ?  AND   ?   ";
                    // prepare query statement
                    $stmt = $this->conn->prepare( $query );
         
                    // bind id of product to be updated
                    $stmt->bindParam(1, $this->branch_name);
                    $stmt->bindParam(2, $this->payment_mode);
                    $stmt->bindParam(3, $this->start_date);
                    $stmt->bindParam(4, $this->end_date);
         
         
                    // execute query
                    $stmt->execute();
                    return $stmt;
                       }

                        // branch & status only
                   else if ($this->branch_name !== "All"  && $this->payment_mode == "All"  && $this->status !== "All"   && $this->start_date !== "All" && $this->end_date !== "All") {
                    $query = "SELECT  * FROM bookings 
                    INNER JOIN branches ON branches.branch_id = bookings.branch_id
                    WHERE branch_name   = ?  AND  payment_mode  LIKE '%'    AND  bookings.status = ? AND date BETWEEN   ?  AND   ?   ";
                    // prepare query statement
                    $stmt = $this->conn->prepare( $query );
         
                    // bind id of product to be updated
                    $stmt->bindParam(1, $this->branch_name);
                    $stmt->bindParam(2, $this->status);
                    $stmt->bindParam(3, $this->start_date);
                    $stmt->bindParam(4, $this->end_date);
         
         
                    // execute query
                    $stmt->execute();
                    return $stmt;
                       }

                       // payment & status only
                   else if ($this->branch_name == "All"  && $this->payment_mode !== "All"  && $this->status !== "All"   && $this->start_date !== "All" && $this->end_date !== "All") {
                    $query = "SELECT  * FROM bookings 
                    INNER JOIN branches ON branches.branch_id = bookings.branch_id
                    WHERE branch_name     LIKE '%' AND  payment_mode = ?    AND  bookings.status = ? AND date BETWEEN   ?  AND   ?   ";
                    // prepare query statement
                    $stmt = $this->conn->prepare( $query );
         
                    // bind id of product to be updated
                    $stmt->bindParam(1, $this->payment_mode);
                    $stmt->bindParam(2, $this->status);
                    $stmt->bindParam(3, $this->start_date);
                    $stmt->bindParam(4, $this->end_date);
         
         
                    // execute query
                    $stmt->execute();
                    return $stmt;
                       }

                       

        //       else if ($this->payment_mode !== "All" && $this->order_status == "All" && $this->start_date !== "All"  && $this->end_date !== "All") {
        //         $query = "SELECT  * FROM orders  WHERE payment_mode = ?  AND  order_status  LIKE '%'   AND created_date BETWEEN  ?  AND  ? ";
        //         // prepare query statement
        //         $stmt = $this->conn->prepare( $query );

        //         // bind id of product to be updated
        //         $stmt->bindParam(1, $this->payment_mode);
        //         $stmt->bindParam(2, $this->start_date);
        //         $stmt->bindParam(3, $this->end_date);
        //         // $stmt->bindParam(4, $this->end_date);


        //         // execute query
        //         $stmt->execute();
        //         return $stmt;
        //     }
        //     else if ($this->payment_mode !== "All" && $this->order_status !== "All" && $this->start_date !== "All"  && $this->end_date !== "All") {
        //       $query = "SELECT  * FROM orders  WHERE payment_mode = ?  AND  order_status  = ?   AND created_date BETWEEN  ?  AND  ? ";
        //       // prepare query statement
        //       $stmt = $this->conn->prepare( $query );

        //       // bind id of product to be updated
        //       $stmt->bindParam(1, $this->payment_mode);
        //       $stmt->bindParam(2, $this->start_date);
        //       $stmt->bindParam(3, $this->end_date);
        //       $stmt->bindParam(4, $this->order_status);


        //       // execute query
        //       $stmt->execute();
        //       return $stmt;
        //   }

        //   else if ($this->payment_mode == "All" && $this->order_status !== "All" && $this->start_date !== "All"  && $this->end_date !== "All") {
        //     $query = "SELECT  * FROM orders  WHERE payment_mode LIKE '%'  AND  order_status  = ?   AND created_date BETWEEN  ?  AND  ? ";
        //     // prepare query statement
        //     $stmt = $this->conn->prepare( $query );

        //     // bind id of product to be updated
        //     // $stmt->bindParam(1, $this->payment_mode);
        //     $stmt->bindParam(1, $this->order_status);
            
        //     $stmt->bindParam(2, $this->start_date);
        //     $stmt->bindParam(3, $this->end_date);



        //     // execute query
        //     $stmt->execute();
        //     return $stmt;
        // }
      }
  }

 ?>
