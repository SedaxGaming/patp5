<?php

namespace Application\models;

use Application\core\DatabaseManager;

class DashboardModel
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
