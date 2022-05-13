<?php

namespace Application\models;

use Application\core\DatabaseManager;

class LoginModel
{
    /**
     * @var DatabaseManager
     */
    private $conn;
    
    public function __construct()
    {
        $this->conn = new DatabaseManager();
    }

    public function login($email,$senha)
    {   
        if (empty($email) || empty($senha)){
            $data = [
                "status" => "error",
                'message' => 'Verifique seu login e senha!'
                
            ];
            return $data;
        }
        
        $result = $this->conn->execute("SELECT * FROM usuarios WHERE email = ?",$email);    
       
    }
}
