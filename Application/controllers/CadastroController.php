<?php

use Application\core\MainController;

class CadastroController extends MainController
{
    
    /**
     * @var mixed
     */
    private $model;
    
    public function __construct()
    {
        $this->model = $this->load_model("CadastroModel");
    }
    
    public function index()
    {
        // verifyLogin();
        
        $this->view('home/cadastro');
    }

    public function cadastrar(){

       // Defino variáveis e inicializo com valores vazios
       $email = $password = "";
       $email_err = $password_err = $login_err = "";
       
       // Processando dados do formulário quando o formulário é enviado
       if ($_SERVER["REQUEST_METHOD"] == "POST") {
           $dados = [
               $_POST["email"],
                $_POST["senha"],
                $_POST["nome"],
                $_POST["cpf"],
                $_POST["cnpj"],
                $_POST["endereco"]
            ];
           $data = $this->model->cadastro($dados);
           echo json_encode($data);
       } else {
           header("location: /cadastro");
       }
    }
}