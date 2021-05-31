<?php

  class Branches
  {
      // databse connection and table names
      private $conn;
      private $table_name = "branches";

      // Object properties
      public $branch_id;
      public $branch_name;
      public $branch_code;
      public $status;
      public $branch_phone;


      // constructor with $db as database connection
      public function __construct($db)
      {
        $this->conn = $db;
      }

      // read productss
      function read(){
        // Select all Query
        $query = "SELECT * FROM ".$this->table_name."  ORDER BY branch_name ASC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute Query
        $stmt->execute();

        return $stmt;
      }

      function create(){
        $query = "SELECT  * FROM ".$this->table_name." WHERE branch_name=:branch_name";
        $stmt1 = $this->conn->prepare($query);
        $stmt1->bindParam(":branch_name", $this->branch_name);
        $stmt1->execute();

        if($stmt1->rowCount() > 0){
            return false;
        } else {
            $this->insert();
            return true;
        }
      }

      // Create products
      function insert(){

        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    branch_name=:branch_name, branch_code=:branch_code,status=:status, branch_phone=:branch_phone";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->branch_name=htmlspecialchars(strip_tags($this->branch_name));
        $this->branch_code=htmlspecialchars(strip_tags($this->branch_code));
        $this->branch_phone=htmlspecialchars(strip_tags($this->branch_phone));
        $this->status=htmlspecialchars(strip_tags($this->status));


        // bind values
        $stmt->bindParam(":branch_name", $this->branch_name);
        $stmt->bindParam(":branch_code", $this->branch_code);
        $stmt->bindParam(":branch_phone", $this->branch_phone);
        $stmt->bindParam(":status", $this->status);


        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
      }

      // read one
      function readOne(){

        // query to read single record
        $query = "SELECT * FROM " . $this->table_name . "  WHERE   branch_id = ? ";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of product to be updated
        $stmt->bindParam(1, $this->branch_id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->branch_name = $row['branch_name'];
        $this->branch_code = $row['branch_code'];
        $this->branch_phone = $row['branch_phone'];
        $this->status = $row['status'];

      }

      // update the product
      function update(){

          // update query
          $query = "UPDATE
                      " . $this->table_name . "
                  SET
                      branch_name = :branch_name,
                      branch_code = :branch_code,
                      status = :status,
                      branch_phone = :branch_phone
                  WHERE
                      branch_id = :branch_id";

          // prepare query statement
          $stmt = $this->conn->prepare($query);

          // sanitize
          $this->branch_name=htmlspecialchars(strip_tags($this->branch_name));
          $this->branch_code=htmlspecialchars(strip_tags($this->branch_code));
          $this->branch_phone=htmlspecialchars(strip_tags($this->branch_phone));
          $this->status=htmlspecialchars(strip_tags($this->status));
          $this->branch_id=htmlspecialchars(strip_tags($this->branch_id));



          // bind new values
          $stmt->bindParam(':branch_name', $this->branch_name);
          $stmt->bindParam(':branch_code', $this->branch_code);
          $stmt->bindParam(':branch_phone', $this->branch_phone);
          $stmt->bindParam(':status', $this->status);
          $stmt->bindParam(':branch_id', $this->branch_id);



          // execute the query
          if($stmt->execute()){
              return true;
          }

          return false;
      }


      function delete_branch(){

        // update query
        $query ="DELETE FROM " . $this->table_name . " WHERE   branch_id = :branch_id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->branch_id=htmlspecialchars(strip_tags($this->branch_id));

        // bind new values
        $stmt->bindParam(':branch_id', $this->branch_id);

        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }
  }

 ?>
