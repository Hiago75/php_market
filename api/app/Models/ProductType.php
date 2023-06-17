<?php
namespace App\Models;

use App\Database\DatabaseConnection;

class ProductType
{
    private $db;

    public function __construct(DatabaseConnection $db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        return $this->db->executeQuery('SELECT id, name FROM product_types');
    }

    public function save(string $id, string $name)
    {
        $query = 'INSERT INTO product_types (id, name) VALUES (?, ?)';
        $params = [$id, $name];

        $this->db->executeQuery($query, $params);

        return 'success';
    }
}
