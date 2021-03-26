<?php

    header("Content-Type: application/json");

    require_once dirname(__DIR__)."/vendor/autoload.php";
    
    if(isset($_GET["url"])){
        
        $url = explode('/', $_GET["url"]);
        
        if($url[0] === "api"){

            array_shift($url);            

            $service = 'App\Services\\'.ucfirst($url[0])."Service";

            array_shift($url);            

            $method = $_SERVER["REQUEST_METHOD"];

            try {
                
                $response = call_user_func_array([new $service, $method], $url);
                http_response_code(200);
                echo json_encode([
                    "status" => "200",
                    "data" => $response
                ], JSON_UNESCAPED_UNICODE);
                exit;

            } catch (\Exception $e) {
                http_response_code(404);
                echo json_encode([
                    "status" => "error",
                    "data" => $e->getMessage()
                ], JSON_UNESCAPED_UNICODE);
                exit;
            }
        }


        
    }
    