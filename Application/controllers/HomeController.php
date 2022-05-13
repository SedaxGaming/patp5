<?php

use Application\core\MainController;

class HomeController extends MainController
{
    
    /**
     * @var mixed
     */
    private $model;
    
    public function __construct()
    {
       // $this->model = $this->load_model("HomeModel");
    }
    
    public function index()
    {
        // verifyLogin();
        
        $this->view('home/index');
    }
}