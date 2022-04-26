<?php

use Application\core\MainController;

class LoginController extends MainController
{
    
    /**
     * @var mixed
     */
    private $model;
    
    public function __construct()
    {
        //$this->model = $this->load_model("LoginModel");
    }
    
    public function index()
    {
        // verifyLogin();
        
        $this->view('home/login');
    }

    public function login(){

        // Defino variáveis e inicializo com valores vazios
        $email = $password = "";
        $email_err = $password_err = $login_err = "";
 
        // Processando dados do formulário quando o formulário é enviado
        if($_SERVER["REQUEST_METHOD"] == "POST"){
 
            // Verifique se o nome de usuário está vazio
            if(empty(trim($_POST["email"]))){
                $email_err = "Por favor, insira um email.";
                } else{
                $email = trim($_POST["email"]);
                }
    
            // Verifique se a senha está vazia
            if(empty(trim($_POST["password"]))){
                $password_err = "Por favor, insira sua senha.";
            } else{
                $password = trim($_POST["password"]);
            }
            // Validar credenciais
            if(empty($email_err) && empty($password_err)){
            $model::login($email,$password);
            }
        }
    }
}