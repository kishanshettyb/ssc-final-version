<?php

  class Policy
  {
      // databse connection and table names
      private $conn;
      private $table_name = "policy";

      // Object properties
      public $policy_id;
      public $policy_name;

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
        $query = "INSERT INTO " . $this->table_name . " SET
                    policy_name=:policy_name";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->policy_name=htmlspecialchars(strip_tags($this->policy_name));

        // bind values
        $stmt->bindParam(":policy_name", $this->policy_name);

        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
      }

      // read one
      function readOne(){

        // query to read single record
        $query = "SELECT *  FROM
                  " . $this->table_name . " p

              WHERE
                  policy_id = ? ";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of product to be updated
        $stmt->bindParam(1, $this->policy_id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->policy_name = $row['policy_name'];
      }

      // update the product
      function update(){

          // update query
          $query = "UPDATE
                      " . $this->table_name . "
                  SET
                      policy_name = :policy_name
                  WHERE
                      policy_id = :policy_id";

          // prepare query statement
          $stmt = $this->conn->prepare($query);

          // sanitize
          $this->policy_name=htmlspecialchars(strip_tags($this->policy_name));
          $this->policy_id=htmlspecialchars(strip_tags($this->policy_id));

          // bind new values
          $stmt->bindParam(':policy_name', $this->policy_name);
          $stmt->bindParam(':policy_id', $this->policy_id);

          // execute the query
          if($stmt->execute()){
              return true;
          }

          return false;
      }
  }

 ?>
