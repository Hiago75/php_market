<?php

use App\Providers\DatabaseConnectionProvider;
use PHPUnit\Framework\TestCase;

class DatabaseConnectionProviderTest extends TestCase
{
    private static $provider;

    public static function setUpBeforeClass(): void
    {
        self::$provider = new DatabaseConnectionProvider(DB_NAME);
    }

    public function testConnectThrowsExceptionWhenDatabaseConnectionFails()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Error connecting to the database');

        $customProvider = new DatabaseConnectionProvider('invalid_database');
        $customProvider->connect();
    }

    public function testGetPdoReturnsInstanceOfPdo()
    {
        $pdo = self::$provider->getPDO();

        $this->assertInstanceOf(\PDO::class, $pdo);
    }

    public function testExecuteQueryReturnsQueryResult()
    {
        $result = self::$provider->executeQuery('SELECT * FROM taxes');

        $this->assertIsArray($result);
    }
}
