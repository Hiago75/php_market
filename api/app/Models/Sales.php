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

    public function save(string $id, $subtotal, $taxes, $total, $saleDate)
    {
        $query = 'INSERT INTO sales (id, subtotal, taxes, total, sale_date) VALUES (?, ?, ?, ?, ?) RETURNING id';
        $params = [$id, $subtotal, $taxes, $total, $saleDate];
    
        $pdo = $this->db->getPDO();
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);

        $newSaleId = $stmt->fetchColumn();
    
        return ['id' => $newSaleId];
    }
}
