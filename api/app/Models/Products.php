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
        $query = 'SELECT products.*, product_types.name AS type_name, taxes.percentage AS tax_percentage
            FROM products
            JOIN product_types ON products.type_id = product_types.id
            JOIN taxes ON product_types.id = taxes.type_id';

        return $this->db->executeQuery($query);;
    }

    public function getById(string $id)
    {
        $query = 'SELECT * FROM products WHERE id = ?';
        $params = [$id];
        $product = $this->db->executeQuery($query, $params);
    
        if (empty($product)) {
            throw new \Exception('Product not found');
        }
    
        return $product;
    }

    public function save(string $id, string $name, string $typeId, float $price)
    {
        $query = 'INSERT INTO products (id, name, type_id, price) VALUES (?, ?, ?, ?)';
        $params = [$id, $name, $typeId, $price];

        $this->db->executeQuery($query, $params);

        return 'success';
    }
}
