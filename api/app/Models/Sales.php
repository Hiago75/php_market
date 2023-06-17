<?php

namespace App\Models;

use App\Providers\DatabaseConnectionProvider;

class Sales
{
    private $db;

    public function __construct(DatabaseConnectionProvider $db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        return $this->db->executeQuery('SELECT * FROM sales');
    }

    public function save(string $id, string $productId, int $quantity, $saleDate)
    {
        $query = 'INSERT INTO sales (id, product_id, quantity, sale_date) VALUES (?, ?, ?, ?)';
        $params = [$id, $productId, $quantity, $saleDate];
    
        $this->db->executeQuery($query, $params);
    
        return 'success';
    }
}
