<?php

namespace App\Models;

use App\Providers\DatabaseConnectionProvider;
use App\Providers\HashProvider;
use App\Exceptions\DatabaseException;

class Sales
{
    private $db;

    public function __construct(DatabaseConnectionProvider $db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        try{
            return $this->db->executeQuery('
            SELECT sales.*, sale_items.*, products.*
            FROM sales
            JOIN sale_items ON sales.id = sale_items.sale_id
            JOIN products ON sale_items.product_id = products.id
        ');
        }catch(Exception $e) {
            throw new DatabaseException();
        }
    }

    public function save($products, $saleId, $subtotal, $taxes, $total, $saleDate)
    {
        $pdo = $this->db->getPDO();
        $pdo->beginTransaction();
    
        try {
            $query = 'INSERT INTO sales (id, subtotal, taxes, total, sale_date) VALUES (?, ?, ?, ?, ?) RETURNING id';
            $params = [$saleId, $subtotal, $taxes, $total, $saleDate];
    
            $stmt = $pdo->prepare($query);
            $stmt->execute($params);
    
            $newSaleId = $stmt->fetchColumn();
    
            foreach ($products as $product) {
                $id = HashProvider::generateHash($saleId . $product['id'] . $product['quantity']);
                $query = 'INSERT INTO sale_items (id, sale_id, product_id, quantity) VALUES (?, ?, ?, ?)';
                $params = [$id, $saleId, $product['id'], $product['quantity']];
                $stmt = $pdo->prepare($query);
                $stmt->execute($params);
            }
    
            $pdo->commit();
    
            return ['id' => $newSaleId];
        } catch (PDOException $e) {
            $pdo->rollback();
            throw new DatabaseException();
        }
    }        
}
