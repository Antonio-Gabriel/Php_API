<?php

    namespace App\Services;
    
    use App\Models\User;    

    class UserService{

        public function get(?int $id = null){
            
            $user = new User();
            return $user->find($id);

        }

        public function post(){
            $user = new User();
            return $user->insert($_POST);
        }


    }