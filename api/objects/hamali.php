<?php

  class Hamali
  {
      // databse connection and table names
      private $conn;
      private $table_name = "hamali_charges";

      // Object properties
      public $hamali_charge_id;
      public $no_of_packages;
      public $hamali_charge;


      // constructor with $db as database connection
      public function __construct($db)
      {
        $this->conn = $db;
      }

      // read productss
      function read(){
        // Select all Query
        $query = "SELECT *  FROM ".$this->table_name."  ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute Query
        $stmt->execute();

        return $stmt;
      }

      // Create products
      // Create products
      function create(){

        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    no_of_packages=:no_of_packages, hamali_charge=:hamali_charge";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->no_of_packages=htmlspecialchars(strip_tags($this->no_of_packages));
        $this->hamali_charge=htmlspecialchars(strip_tags($this->hamali_charge));

        // bind values
        $stmt->bindParam(":no_of_packages", $this->no_of_packages);
        $stmt->bindParam(":hamali_charge", $this->hamali_charge); 

        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
      }

      // read one
      function readOne(){

        // query to read single record
        $query = "SELECT *  FROM   " . $this->table_name . "   WHERE hamali_charge_id = ? ";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of product to be updated
        $stmt->bindParam(1, $this->hamali_charge_id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->no_of_packages = $row['no_of_packages'];
        $this->hamali_charge = $row['hamali_charge'];

      }

      // update the product
      function update(){

          // update query
          $query = "UPDATE
                      " . $this->table_name . "
                  SET
                      no_of_packages = :no_of_packages,
                      hamali_charge = :hamali_charge
                  WHERE
                      hamali_charge_id = :hamali_charge_id";

          // prepare query statement
          $stmt = $this->conn->prepare($query);

          // sanitize

          $this->no_of_packages=htmlspecialchars(strip_tags($this->no_of_packages));
          $this->hamali_charge=htmlspecialchars(strip_tags($this->hamali_charge));
          $this->hamali_charge_id=htmlspecialchars(strip_tags($this->hamali_charge_id));

          // bind new values

          $stmt->bindParam(':no_of_packages', $this->no_of_packages);
          $stmt->bindParam(':hamali_charge', $this->hamali_charge);
          $stmt->bindParam(':hamali_charge_id', $this->hamali_charge_id);

          // execute the query
          if($stmt->execute()){
              return true;
          }

          return false;
      }
  }

 ?>
