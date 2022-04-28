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

    public function login($email,$senha){

        $data = [$email,$senha];
        $table = "usuarios";
        $where = "email = :email AND senha = :senha";

        $conn->iniciarTransacao();
        try {
            $conn::select($data,$table,$where);
            // Tente executar a declaração preparada
            if($conn->execute()){
                // Verifique se o nome de usuário existe, se sim, verifique a senha
                if($conn->rowCount() == 1){
                    if($row = $conn->fetch()){
                        $id = $row["idusuario"];
                        $usuario = $row["usuario"];
                        $email = $row["email"];
                        $hashed_password = $row["senha"];
                        if(password_verify($password, $hashed_password)){
                            // A senha está correta, então inicie uma nova sessão
                            session_start();
                            
                            // Armazene dados em variáveis de sessão
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;                       
                            $_SESSION["usuario"] = $usuario;            
                        }           
                    }
                }
            }   
            $conn::commitar();
        } catch (\Throwable $th) {
            //throw $th;
            echo("Algo de errado não deu certo! Tente novamente mais tarde!");
            $conn::cancelarTransacao();
        }
        // Redirecionar o usuário para a página de boas-vindas
        header("location: /home");
    }
}
