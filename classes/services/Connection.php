<?php

namespace dummy\services;

 class Connection
{
       public $conn;
       public function __construct()
       {
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "project";
        $this->conn = new \PDO("mysql:host=$host;dbname=$dbname", $username, $password);
       }
       public function getConnection()
       {
        return  $this->conn;
       }

}
?>