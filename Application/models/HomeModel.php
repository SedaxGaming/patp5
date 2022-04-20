<?php

namespace Application\models;

use Application\core\DatabaseManager;

class HomeModel
{
    /**
     * @var DatabaseManager
     */
    private $conn;
    
    public function __construct()
    {
        $this->conn = new DatabaseManager();
    }
}
