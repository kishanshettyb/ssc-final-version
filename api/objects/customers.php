<?php

  class Customers
  {
      // databse connection and table names
      private $conn;
      private $table_name = "customers";

      // Object properties
      public $consignor_name;
      public $consignor_phone;
      public $consignee_name;
      public $consignee_phone;
      public $customer_id;
       
      // constructor with $db as database connection
      public function __construct($db)
      {
        $this->conn = $db;
      }

      // read productss
      function read(){
        // Select all Query
        $query = "SELECT * FROM
                  ".$this->table_name." ORDER BY consignor_name ASC ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute Query
        $stmt->execute();

        return $stmt;
      }

      // Create products
       // Create products
       function create(){
        $query = "SELECT  consignor_name,consignor_phone,consignee_name,consignee_phone FROM ".$this->table_name." WHERE consignor_name=:consignor_name AND consignor_phone=:consignor_phone AND consignee_name=:consignee_name AND consignee_phone=:consignee_phone";
        $stmt1 = $this->conn->prepare($query);
        $stmt1->bindParam(":consignor_name", $this->consignor_name);
        $stmt1->bindParam(":consignor_phone", $this->consignor_phone);
        $stmt1->bindParam(":consignee_name", $this->consignee_name);
        $stmt1->bindParam(":consignee_phone", $this->consignee_phone);
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
                    consignor_name=:consignor_name, consignor_phone=:consignor_phone, consignee_name=:consignee_name, consignee_phone=:consignee_phone";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->consignor_name=htmlspecialchars(strip_tags($this->consignor_name));
        $this->consignor_phone=htmlspecialchars(strip_tags($this->consignor_phone));
        $this->consignee_name=htmlspecialchars(strip_tags($this->consignee_name));
        $this->consignee_phone=htmlspecialchars(strip_tags($this->consignee_phone));
      

        // bind values
        $stmt->bindParam(":consignor_name", $this->consignor_name);
        $stmt->bindParam(":consignor_phone", $this->consignor_phone);
        $stmt->bindParam(":consignee_name", $this->consignee_name);
        $stmt->bindParam(":consignee_phone", $this->consignee_phone);
         
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
                  " . $this->table_name . " p
                  
              WHERE
                  customer_id = ?
              ";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of product to be updated
        $stmt->bindParam(1, $this->customer_id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->consignor_name = $row['consignor_name'];
        $this->consignor_phone = $row['consignor_phone'];
        $this->consignee_name = $row['consignee_name'];
        $this->consignee_phone = $row['consignee_phone'];
         
      }

      // update the product
      function update(){

          // update query
          $query = "UPDATE
                      " . $this->table_name . "
                  SET
                      consignor_name = :consignor_name,
                      consignor_phone = :consignor_phone,
                      consignee_name = :consignee_name,
                      consignee_phone = :consignee_phone
                  WHERE
                      customer_id = :customer_id";

          // prepare query statement
          $stmt = $this->conn->prepare($query);

          // sanitize
          $this->consignor_name=htmlspecialchars(strip_tags($this->consignor_name));
          $this->consignor_phone=htmlspecialchars(strip_tags($this->consignor_phone));
          $this->consignee_name=htmlspecialchars(strip_tags($this->consignee_name));
          $this->consignee_phone=htmlspecialchars(strip_tags($this->consignee_phone));
          $this->customer_id=htmlspecialchars(strip_tags($this->customer_id));

          // bind new values
          $stmt->bindParam(':consignor_name', $this->consignor_name);
          $stmt->bindParam(':consignor_phone', $this->consignor_phone);
          $stmt->bindParam(':consignee_name', $this->consignee_name);
          $stmt->bindParam(':consignee_phone', $this->consignee_phone);
          $stmt->bindParam(':customer_id', $this->customer_id);

          // execute the query
          if($stmt->execute()){
              return true;
          }

          return false;
      }

      function searchConsignee($keywords){

        $query  = "SELECT b.* FROM " . $this->table_name . " b
        WHERE b.consignee_phone LIKE ?  GROUP BY consignee_name
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

    function searchConsignor($keywords){

      $query  = "SELECT b.* FROM " . $this->table_name . " b
      WHERE b.consignor_phone LIKE ?  GROUP BY consignor_name   
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
  function delete_customer(){

    // update query
    $query ="DELETE FROM " . $this->table_name . " WHERE   customer_id = :customer_id";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->customer_id=htmlspecialchars(strip_tags($this->customer_id));

    // bind new values
    $stmt->bindParam(':customer_id', $this->customer_id);

    // execute the query
    if($stmt->execute()){
        return true;
    }

    return false;
}
  }

 ?>
