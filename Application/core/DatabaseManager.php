<?php

namespace Application\core;

use PDO;
use PDOException;
use PDOStatement;

class DatabaseManager extends PDO
{
    private $db_name;
    private $db_user;
    private $db_password;
    private $db_host;
    private $db_port;
    private $db_charset = 'utf8';
    private $pdo = null;
    private $debug = false;
    private $error = null;
    private $last_id = null;
    
    public function __construct()
    {
        $this->db_name = DB_NAME;
        $this->db_host = DB_HOST;
        $this->db_port = DB_PORT;
        $this->db_user = DB_USER;
        $this->db_password = DB_PASSWORD;
        $this->debug;
    
        //Chama a conexao.
        $this->connect();
    }
    
    final private function connect()
    {
        $pdo_dsn = "mysql:host={$this->db_host};dbname={$this->db_name};port={$this->db_port};charset={$this->db_charset};";
    
        try {
            $this->pdo = new PDO($pdo_dsn, $this->db_user, $this->db_password);
            $this->pdo->setAttribute(PDO::ATTR_TIMEOUT, 10);
            
            if ($this->debug === true) {
               $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            }
            
            $this->pdo->setAttribute(PDO::ATTR_TIMEOUT, 10);
        } catch (PDOException $error) {
            if ($this->debug === true) {
                echo "Erro: " . $error->getMessage();
            }
            
            die();
        }
    }
    
    /**
     * @param string $stmt
     * @param null $data
     * @return bool|false|PDOStatement
     */
    public function query($stmt, $data = null)
    {
        $query = $this->pdo->prepare($stmt);
        $exec = $query->execute($data);
        
        if ($exec) {
            return $query;
            
        } else {
            $error = $query->errorInfo();
            $this->error = $error[2];
            
            return false;
        }
    }
    
    public function insert($table)
    {
        $cols = [];
        $place_holders = '(';
        $values = [];
        $j = 1;
        $data = func_get_args();
        
        if (!isset($data[1]) || !is_array($data[1])) {
            return;
        }
        
        for ($i = 1; $i < count($data); $i++) {
            foreach ($data[$i] as $col => $val) {
                if ($i === 1) {
                    $cols[] = "`$col`";
                }
                
                if ($j <> $i) {
                    $place_holders .= '), (';
                }
                
                $place_holders .= '?, ';
                
                $values[] = $val;
                
                $j = $i;
            }
            
            $place_holders = substr($place_holders, 0, strlen($place_holders) - 2);
        }
        
        $cols = implode(', ', $cols);
        
        $stmt = "INSERT INTO `$table`($cols) VALUES $place_holders) ";
        
        $insert = $this->query($stmt, $values);
        
        if ($insert) {
            if (method_exists($this->pdo, 'lastInsertId') && $this->pdo->lastInsertId()) {
                $this->last_id = $this->pdo->lastInsertId();
            }
            
            return $insert;
        }
        
        return;
    }
    
    public function update($table, $where_field, $where_field_value, $values)
    {
        if (empty($table) || empty($where_field) || empty($where_field_value)) {
            return;
        }
        
        $stmt = "UPDATE `$table` SET ";
        
        $set = [];
        
        $where = " WHERE `$where_field` = ? ";
        
        if (!is_array($values)) {
            return;
        }
        
        foreach ($values as $column => $value) {
            $set[] = " `$column` = ?";
        }
    
        $set = implode(', ', $set);
        
        $stmt .= $set . $where;
        
        $values[] = $where_field_value;
        
        $values = array_values($values);
        
        $update = $this->query($stmt, $values);
        
        if ($update) {
            return $update;
        }
        
        return;
    }
    
    public function delete($table, $where_field, $where_field_value)
    {
        if (empty($table) || empty($where_field) || empty($where_field_value)) {
            return;
        }
        
        $stmt = " DELETE FROM `$table` ";
        
        $where = " WHERE `$where_field` = ? ";
        
        $stmt .= $where;
        
        $values = array($where_field_value);
        
        $delete = $this->query($stmt, $values);
        
        if ($delete) {
            return $delete;
        }
        
        return;
    }
    
    public function beginTransaction()
    {
        $this->pdo->beginTransaction();
    }
    
    public function commit()
    {
        $this->pdo->commit();
    }
    
    public function rollBack()
    {
        $this->pdo->rollBack();
    }
}
