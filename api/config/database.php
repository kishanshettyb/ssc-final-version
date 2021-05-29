<?php

  class Database
  {
        // database credentials
        private $host = "localhost";
        private $username = "root";
        private $password ="";
        private $db_name = "skanda";

        // private $username = "skanda";
        // private $password ="Anjaneya!123";
        // private $db_name = "skanda";

        public $conn;

        //get the databse connection
        public function getConnection()
        {
            $this->conn = null;

            try {
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }
            catch (PDOException $e) {
                echo "connection error:".$e->getMessage();
            }
            return $this->conn;
        }
  }

 ?>
