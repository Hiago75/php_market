<?php

namespace App\Providers;
use App\Exceptions\DatabaseException;
use App\Exceptions\BadRequest;

class DatabaseConnectionProvider
{
    private $pdo;
    private string $dbName;

    public function __construct(string $dbName)
    {
        $this->dbName = $dbName;
        $this->connect($dbName);
    }

    public function connect()
    {
        $dsn = "pgsql:host=".DB_HOST.";port=".DB_PORT.";dbname=". $this->dbName;
        
        try {
            $this->pdo = new \PDO($dsn, DB_USER, DB_PASS);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            throw new DatabaseException("Error connecting to the database");
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
            echo $e;
            throw new DatabaseException();
        }
    }

    public function checkIfExists(string $table, string $column, $value, $errMessage)
    {   
        $query = "SELECT COUNT(*) AS count FROM $table WHERE $column = ?";
        $params = [$value];

        $result = $this->executeQuery($query, $params);
        $count = $result[0]['count'];

        if ($count > 0) {
            throw new BadRequest($errMessage);
        }
    }
}
