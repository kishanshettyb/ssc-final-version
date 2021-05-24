<?php

  class SCCharges
  {
      // databse connection and table names
      private $conn;
      private $table_name = "sc_charges";

      // Object properties
      public $sc_charge_id;
      public $consignment_value;
      public $sc_charge;


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
                    consignment_value=:consignment_value, sc_charge=:sc_charge";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->consignment_value=htmlspecialchars(strip_tags($this->consignment_value));
        $this->sc_charge=htmlspecialchars(strip_tags($this->sc_charge));

        // bind values
        $stmt->bindParam(":consignment_value", $this->consignment_value);
        $stmt->bindParam(":sc_charge", $this->sc_charge);

        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
      }

      // read one
      function readOne(){

        // query to read single record
        $query = "SELECT *  FROM " . $this->table_name . " WHERE sc_charge_id = ? ";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of product to be updated
        $stmt->bindParam(1, $this->sc_charge_id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->sc_charge_id = $row['sc_charge_id'];
        $this->consignment_value = $row['consignment_value'];
        $this->sc_charge = $row['sc_charge'];

      }

      // update the product
      function update(){

          // update query
          $query = "UPDATE
                      " . $this->table_name . "
                  SET
                      consignment_value = :consignment_value,
                      sc_charge = :sc_charge
                  WHERE
                      sc_charge_id = :sc_charge_id";

          // prepare query statement
          $stmt = $this->conn->prepare($query);

          // sanitize
          $this->consignment_value=htmlspecialchars(strip_tags($this->consignment_value));
          $this->sc_charge=htmlspecialchars(strip_tags($this->sc_charge));
          $this->sc_charge_id=htmlspecialchars(strip_tags($this->sc_charge_id));

          // bind new values
          $stmt->bindParam(':consignment_value', $this->consignment_value);
          $stmt->bindParam(':sc_charge', $this->sc_charge);
          $stmt->bindParam(':sc_charge_id', $this->sc_charge_id); 

          // execute the query
          if($stmt->execute()){
              return true;
          }

          return false;
      }
  }

 ?>
