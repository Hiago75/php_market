<?php
namespace App\Models;

use App\Providers\DatabaseConnectionProvider;

class Products
{
    private $db;

    public function __construct(DatabaseConnectionProvider $db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        return $this->db->executeQuery('SELECT * FROM products');
    }
}
