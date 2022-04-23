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
}