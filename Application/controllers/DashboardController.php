<?php

use Application\core\MainController;

class DashboardController extends MainController
{
    
    /**
     * @var mixed
     */
    private $model;
    
    public function __construct()
    {
        $this->model = $this->load_model("DashboardModel");
    }
    
    public function index()
    {
        // verifyLogin();
        
        $this->view('home/dashboard');
    }
    
    
}