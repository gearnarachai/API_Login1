<?php
class Database {
private $host="localhost";
private $dbname="inventory";
private $username="root";
private $password="12345678";

public $conn;
public function getConnection(){
    try{

        $this->conn =new PDO("mysql:host=".$this->host.";dbname=".$this->dbname,$this->username,$this->password);
         $this->conn->exec("set names utf8");
    }catch(PDOException $e)
    {
        echo "Connection eroor :" .$e->getMessage();

    }
   return $this->conn;
   
}
}
?>