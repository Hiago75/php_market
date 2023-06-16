<?php
namespace App\Models;

use App\Database\DatabaseConnection;

class ProductType
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllProductTypes()
    {
        return $this->db->executeQuery('SELECT id, name FROM product_types');
    }
}
