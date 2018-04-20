<?php
class ExecSQL{
    private $conn;
    public function __construct($str_conn){

        $this->conn =$str_conn;
     }

     public function readAll($tablename){
         $stmt =$this->conn->prepare(" SELECT * FROM ".$tablename );
         $stmt ->execute();
         return $stmt;

    }
     public function rowCount($tablename){
        $stmt = $this->conn->prepare(" SELECT  COUNT(*) AS total_row FROM ".$tablename );
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_row'];
     }

     public function readOne($tablename,$condition){
        $stmt = $this->conn->prepare(" SELECT * FROM ".$tablename .$condition );
        $stmt->execute();
        return $stmt;
     }

     public function rowCount1($tablename,$condition){
        $stmt = $this->conn->prepare(" SELECT  COUNT(*) AS total_row FROM ".$tablename .$condition );
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_row'];
     }

     public function insert($tablename,$field,$value){
        $stmt = $this->conn->prepare(" INSERT INTO $tablename ($field) VALUES ($value) ");
        //$stmt->execute();
        if($stmt->execute())
        {
            return true;
        }else{
            return false;
        }
     }

     public function delete($tablename,$condition,$id){
        //$stmt = $this->conn->prepare(" DELETE FROM ".$tablename.$condition);
        $stmt = $this->conn->prepare(" DELETE FROM $tablename WHERE $condition = ".$id);
        return $this->checkExe($stmt);
     }

     public function update($tablename,$condition){
        $stmt= $this->conn->prepare(" UPDATE ".$tablename.$condition);
        return $this->checkExe($stmt);
     }

     public function login($tablename,$condition){
        $stmt= $this->conn->prepare(" SELECT ".$tablename.$condition);
        return $this->checkExe($stmt);
     }

     private function checkExe($stmt){

        if($stmt->execute())
        {
            return true;
        }else{
            return false;
        }

     }



}


?>
