<?php

    namespace App\Models;
    use App\Db\Sql;

    class User{

        private $sql;
        
        public function __construct()
        {
            $this->sql = new Sql();            
        }

        public function insert($params){
            $data = (object)$params;
            $response = $this->sql->query("insert into user (name, phone, email) values (:name, :phone, :email);", 
            [
                ":name" => $data->name,
                ":phone" => $data->phone,
                ":email" => $data->email,
            ]);

            if($response)
                return "Usuário Cadastrado com sucesso!";
            else
                throw new \Exception("Failed to insert");
                
        }

        public function find(?int $id = null){
            if(isset($id)){                

                $response = $this->sql->select("select * from user where idUser = :id",[
                    ":id" => $id
                ]);

                if($response) return $response;                    
                else throw new \Exception("Nenhum registro encontrado");       

            }              
            
            return $this->sql->select("select * from user");
        }

    }