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

    public function save(string $id, string $name, string $typeId, float $price)
    {
        $query = 'INSERT INTO products (id, name, type_id, price) VALUES (?, ?, ?, ?)';
        $params = [$id, $name, $typeId, $price];

        $this->db->executeQuery($query, $params);

        return 'success';
    }
}
