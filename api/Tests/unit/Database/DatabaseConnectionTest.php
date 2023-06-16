<?php

use PHPUnit\Framework\TestCase;
use App\Database\DatabaseConnection;

class DatabaseConnectionTest extends TestCase
{
    private $dbConnection;

    protected function setUp(): void
    {
        $this->dbConnection = new DatabaseConnection(DB_NAME);
    }

    public function testConnect()
    {
        $this->dbConnection->connect();

        $this->assertInstanceOf(PDO::class, $this->dbConnection->getPDO());
    }

    public function testExecuteQuery()
    {
        $this->dbConnection->connect();
        $testTable = 'product_types';

        $query = "SELECT * FROM " . $testTable;
        $result = $this->dbConnection->executeQuery($query);

        $this->assertIsArray($result);
    }
}
