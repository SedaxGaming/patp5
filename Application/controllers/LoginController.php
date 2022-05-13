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
        $this->model = $this->load_model("LoginModel");
    }
    
    public function index()
    {
        // verifyLogin();
        
        $this->view('home/login');
    }
    
    public function login()
    {
        // Defino variáveis e inicializo com valores vazios
        $email = $password = "";
        $email_err = $password_err = $login_err = "";
        
        // Processando dados do formulário quando o formulário é enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = $this->model->login($_POST["email"], $_POST["password"]);
            echo json_encode($data);
        } else {
            header("location: /login");
        }
        
    }
}