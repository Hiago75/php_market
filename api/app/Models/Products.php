<?php

namespace App\Models;

use App\Providers\DatabaseConnectionProvider;
use App\Exceptions\DatabaseException;

class Products
{
    private $db;

    public function __construct(DatabaseConnectionProvider $db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        try{
            $query = 'SELECT products.*, product_types.name AS type_name, taxes.percentage AS tax_percentage
                FROM products
                JOIN product_types ON products.type_id = product_types.id
                JOIN taxes ON product_types.id = taxes.type_id';

            return $this->db->executeQuery($query);
        }catch(Exception $e) {
            throw new DatabaseException();
        }
    }

    public function save(string $id, string $name, string $typeId, float $price)
    {
        try{
            $query = 'INSERT INTO products (id, name, type_id, price) VALUES (?, ?, ?, ?)';
            $params = [$id, $name, $typeId, $price];

            $this->db->executeQuery($query, $params);

            return 'success';
        }catch(Exception $e) {
            throw new DatabaseException();
        }
    }
}
