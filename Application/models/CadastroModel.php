<?php

namespace Application\models;

use Application\core\DatabaseManager;

class CadastroModel
{
    /**
     * @var DatabaseManager
     */
    private $conn;
    
    public function __construct()
    {
        $this->conn = new DatabaseManager();
    }

    public function cadastro($dados)
    {

        if (empty($dados['email']) || (empty($dados['senha']))){
            $data = [
                "status" => "error",
                'message' => 'Por favor, verifique seus dados!'

            ];
            return $data;

        }else{

            $select = $this->conn->
            execute("SELECT email FROM usuarios WHERE email = ?", $dados['email'])->fetch(\PDO::FETCH_ASSOC);

            if($select !== false){

                $data = [
                    "status" => "error",
                    'message' => 'Este email já esta cadastrado, pro favor use outro.'

                ];

                return $data;
                
            }else{
                $this->conn->iniciarTransacao();
                try {
                    $this->conn->insert("usuarios",[$dados]);
                
                    $data = [
                        "status" => "ok",
                    ];

                    $this->conn->commitar();
                } catch (\Throwable $th) {
                    $this->conn->cancelarTransacao();

                    $data = [
                        "status" => "error",
                        'message' => 'Aconteceu um erro inesperado, tente novamente mais tarde.'
    
                    ];
                }
                
                return $data;
                
            }

        }       
            
    }
}
