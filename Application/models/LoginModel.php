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

        
        $senha_md5 = md5($senha);
        
        $result = $this->conn->execute
        ("SELECT idusuario,email,nome,cpf,cnpj,endereco FROM usuarios WHERE email = ? AND senha = ?",[$email,$senha_md5])
        ->fetch(\PDO::FETCH_ASSOC);

        if (empty($result) || (is_null($result))){
            $data = [
                "status" => "error",
                'message' => 'Esta conta não está cadastrada!'
                
            ];
            return $data;
        }
        
        //session_start(); aonde que ja iniciou?
        
        // variaveis de sessão
        $_SESSION['Id'] = $result['idusuario'];
        $_SESSION['Email'] = $result['email'];
        $_SESSION['Nome'] = $result['nome'];
        $_SESSION['CPF'] = $result['cpf'];
        $_SESSION['CNPJ'] = $result['cnpj'];
        $_SESSION['Endereco'] = $result['endereco'];
        
        //header("location: /dashboard"); Preciso redicionar.

        $data = [
            "status" => "ok",
                        
        ];
        return $data;
        
    }
}
