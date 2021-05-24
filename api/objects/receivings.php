<?php

  class Receivings
  {
      // databse connection and table names
      private $conn;
      private $table_name = "receivings";

      // Object properties
      public $receiving_id;
      public $receiving_name;
      public $receiving_phone;
      public $booking_id;
      public $delivery_charges;
      public $receiving_date_time;

      // constructor with $db as database connection
      public function __construct($db)
      {
        $this->conn = $db;
      }

      // read productss
      function read(){
        // Select all Query
        $query = "SELECT * FROM ".$this->table_name." ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute Query
        $stmt->execute();

        return $stmt;
      }

      // Create products
      function create(){

        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    receiving_name=:receiving_name, receiving_phone=:receiving_phone, booking_id=:booking_id, delivery_charges=:delivery_charges, receiving_date_time=:receiving_date_time";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->receiving_name=htmlspecialchars(strip_tags($this->receiving_name));
        $this->receiving_phone=htmlspecialchars(strip_tags($this->receiving_phone));
        $this->booking_id=htmlspecialchars(strip_tags($this->booking_id));
        $this->delivery_charges=htmlspecialchars(strip_tags($this->delivery_charges));
        $this->receiving_date_time=htmlspecialchars(strip_tags($this->receiving_date_time));

        // bind values
        $stmt->bindParam(":receiving_name", $this->receiving_name);
        $stmt->bindParam(":receiving_phone", $this->receiving_phone);
        $stmt->bindParam(":booking_id", $this->booking_id);
        $stmt->bindParam(":delivery_charges", $this->delivery_charges);
        $stmt->bindParam(":receiving_date_time", $this->receiving_date_time);

        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
      }

      // read one
      function readOne(){

        // query to read single record
        $query = "SELECT * FROM
                  " . $this->table_name . "   WHERE booking_id = ? ";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of product to be updated
        $stmt->bindParam(1, $this->booking_id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->receiving_name = $row['receiving_name'];
        $this->receiving_phone = $row['receiving_phone'];
        $this->booking_id = $row['booking_id'];
        $this->delivery_charges = $row['delivery_charges'];
        $this->receiving_date_time = $row['receiving_date_time'];
      }

       // update the product
      function update(){

        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    receiving_name = :receiving_name,
                    receiving_phone = :receiving_phone,
                    booking_id = :booking_id,
                    delivery_charges = :delivery_charges,
                    receiving_date_time = :receiving_date_time
                WHERE
                    receiving_id = :receiving_id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->receiving_name=htmlspecialchars(strip_tags($this->receiving_name));
        $this->receiving_phone=htmlspecialchars(strip_tags($this->receiving_phone));
        $this->booking_id=htmlspecialchars(strip_tags($this->booking_id));
        $this->delivery_charges=htmlspecialchars(strip_tags($this->delivery_charges));
        $this->receiving_date_time=htmlspecialchars(strip_tags($this->receiving_date_time));
        $this->receiving_id=htmlspecialchars(strip_tags($this->receiving_id));

        // bind new values
        $stmt->bindParam(':receiving_name', $this->receiving_name);
        $stmt->bindParam(':receiving_phone', $this->receiving_phone);
        $stmt->bindParam(':booking_id', $this->booking_id);
        $stmt->bindParam(':delivery_charges', $this->delivery_charges);
        $stmt->bindParam(':receiving_date_time', $this->receiving_date_time);
        $stmt->bindParam(':receiving_id', $this->receiving_id);

        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }
  }

 ?>
