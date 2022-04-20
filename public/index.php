<?php
    require_once '../Application/autoload.php';
    require_once '../vendor/autoload.php';
    require_once '../enviroment.php';
    require_once '../Application/helper/helper.php';


// Verifica o modo para debugar
    if (!defined('DEBUG') || DEBUG === false) {
        // Esconde todos os erros
        error_reporting(0);
        ini_set("display_errors", 0);
    } else {
        // Mostra todos os erros
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
    }
    
    session_start();
    
    use Application\core\App;
    
    $app = new App();
    