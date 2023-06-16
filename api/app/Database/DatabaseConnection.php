<?php

namespace App\Database;

class DatabaseConnection
{
    private $pdo;

    public function __construct() 
    {
        $this->connect();
    }

    public function connect()
    {
        $dsn = "pgsql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME;
        
        try {
            $this->pdo = new \PDO($dsn, DB_USER, DB_PASS);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            throw new \Exception("Error connecting to the database: " . $e->getMessage());
        }
    }

    public function getPDO()
    {
        if (!$this->pdo) {
            $this->connect();
        }
        return $this->pdo;
    }

    public function executeQuery($query, $params = [])
    {
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \Exception("Error executing query: " . $e->getMessage());
        }
    }
}
