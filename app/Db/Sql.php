<?php

    namespace App\Db;

    class Sql{

        private $stmt;
        private $conn;

        public function __construct()
        {
            $this->conn = ($this->conn == null) ? 
                new \PDO("mysql:host=".host.";dbname=".dbname."", user, password) 
            : $this->conn; 
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }

        private function setParams($stmt, $param = []){
            foreach ($param as $key => $value) {
                $this->bindParams($stmt, $key, $value);
            }
        }
        private function bindParams($stmt, $key, $value){
            $stmt->bindParam($key, $value);
        }

        public function select($stmt, $param = []): array{
            $this->stmt = $this->conn->prepare($stmt);
            $this->setParams($this->stmt, $param);
            $this->stmt->execute();
            return $this->stmt->fetchAll();
        }
        public function query($stmt, $param = []){
            $this->stmt = $this->conn->prepare($stmt);
            $this->setParams($this->stmt, $param);
            $this->stmt->execute();
            if($this->stmt->rowCount() > 0) return true;            
            else return false;
        }

    }