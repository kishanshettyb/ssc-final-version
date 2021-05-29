<?php
session_start();
  
  class Admin
  {
      // databse connection and table names
      private $conn;
      private $table_name = "admin";

      // Object properties
      public $admin_id;
      public $username;
      public $password;
      public $name;
      public $email;
      public $phone;
      public $address;
      public $branch;
      public $profile;
      public $branch_id;
      // constructor with $db as database connection
      public function __construct($db)
      {
        $this->conn = $db;
      }

      // read productss
      function read(){
        // Select all Query
        $query = "SELECT
                  *
                  FROM
                  ".$this->table_name."  ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute Query
        $stmt->execute();

        return $stmt;
      }

      // Create products

      function create(){
        $query = "SELECT  * FROM ".$this->table_name." WHERE username=:username";
        $stmt1 = $this->conn->prepare($query);
        $stmt1->bindParam(":username", $this->username);
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
                    username=:username, password=:password, name=:name, email=:email, phone=:phone, address=:address, branch=:branch, profile=:profile, branch_id=:branch_id";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->username=htmlspecialchars(strip_tags($this->username));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->phone=htmlspecialchars(strip_tags($this->phone));
        $this->address=htmlspecialchars(strip_tags($this->address));
        $this->branch=htmlspecialchars(strip_tags($this->branch));
        $this->profile=htmlspecialchars(strip_tags($this->profile));
        $this->branch_id=htmlspecialchars(strip_tags($this->branch_id));


        // bind values
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":branch", $this->branch);
        $stmt->bindParam(":profile", $this->profile);
        $stmt->bindParam(":branch_id", $this->branch_id);


        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
      }

      // read one
      function readOne(){

        // query to read single record
        $query = "SELECT * FROM " . $this->table_name . " WHERE admin_id = ?";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of product to be updated
        $stmt->bindParam(1, $this->admin_id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->username = $row['username'];
        $this->password = $row['password'];
        $this->name = $row['name'];
        $this->email = $row['email'];
        $this->phone = $row['phone'];
        $this->address = $row['address'];
        $this->branch = $row['branch'];
        $this->profile = $row['profile'];
        $this->branch_id = $row['branch_id'];

      }

      function readOneAdmin(){

        // query to read single record
        $query = "SELECT * FROM " . $this->table_name . " 
        INNER JOIN branches ON branches.branch_id = admin.branch_id
        WHERE username = ? AND password = ?  ";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of product to be updated
        $stmt->bindParam(1, $this->username);
        $stmt->bindParam(2, $this->password);


        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->username = $row['username'];
        $this->password = $row['password'];
        $this->name = $row['name'];
        $this->email = $row['email'];
        $this->phone = $row['phone'];
        $this->address = $row['address'];
        $this->branch = $row['branch_name'];
        $this->profile = $row['profile'];
        $this->branch_id = $row['branch_id'];
        $this->branch_name = $row['branch_name'];

        $count = $stmt->rowCount();
        if ($count>0) {
          $_SESSION["session_admin_username"] = $row["username"];
          $_SESSION["session_admin_profile"] = $row["profile"];
          $_SESSION["session_admin_id"] = $row["admin_id"];
          $_SESSION["session_branch"] = $row["branch_name"];
          $_SESSION["session_phone"] = $row["phone"];
          $_SESSION["session_branch_id"] = $row["branch_id"];
          echo '{';
              echo '"message": "success"';
          echo '}';
        }
        else{
          echo '{';
            echo '"message": "user does not exist"';
          echo '}';

        }

      }

      // update the product
      function update(){

          // update query
          $query = "UPDATE
                      " . $this->table_name . "
                  SET
                      username = :username,
                      password = :password,
                      name = :name,
                      email = :email,
                      phone = :phone,
                      address = :address,
                      branch = :branch,
                      profile = :profile,
                      branch_id = :branch_id

                  WHERE
                      admin_id = :admin_id";

          // prepare query statement
          $stmt = $this->conn->prepare($query);

          // sanitize
          $this->username=htmlspecialchars(strip_tags($this->username));
          $this->password=htmlspecialchars(strip_tags($this->password));
          $this->name=htmlspecialchars(strip_tags($this->name));
          $this->email=htmlspecialchars(strip_tags($this->email));
          $this->phone=htmlspecialchars(strip_tags($this->phone));
          $this->address=htmlspecialchars(strip_tags($this->address));
          $this->branch=htmlspecialchars(strip_tags($this->branch));
          $this->profile=htmlspecialchars(strip_tags($this->profile));
          $this->branch_id=htmlspecialchars(strip_tags($this->branch_id));

          $this->admin_id=htmlspecialchars(strip_tags($this->admin_id));

          // bind new values
          $stmt->bindParam(':username', $this->username);
          $stmt->bindParam(':password', $this->password);
          $stmt->bindParam(':name', $this->name);
          $stmt->bindParam(':email', $this->email);
          $stmt->bindParam(':phone', $this->phone);
          $stmt->bindParam(':address', $this->address);
          $stmt->bindParam(':branch', $this->branch);
          $stmt->bindParam(':profile', $this->profile);
          $stmt->bindParam(':branch_id', $this->branch_id);

          $stmt->bindParam(':admin_id', $this->admin_id);

          // execute the query
          if($stmt->execute()){
              return true;
          }

          return false;
      }

      function delete_admin(){

        // update admin_id
        $query ="DELETE FROM " . $this->table_name . " WHERE   admin_id = :admin_id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->admin_id=htmlspecialchars(strip_tags($this->admin_id));

        // bind new values
        $stmt->bindParam(':admin_id', $this->admin_id);

        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }
  }

 ?>
