<?php
namespace App\Models;

use App\Providers\DatabaseConnectionProvider;
use App\Exceptions\DatabaseException;

class ProductType
{
    private $db;

    public function __construct(DatabaseConnectionProvider $db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        try{
            return $this->db->executeQuery('SELECT id, name FROM product_types');
        }catch(Exception $e) {
            throw new DatabaseException();
        }
    }

    public function save(string $id, string $name)
    {
        try{
            $query = 'INSERT INTO product_types (id, name) VALUES (?, ?) RETURNING id, name';
            $params = [$id, $name];
        
            $pdo = $this->db->getPDO();
            $stmt = $pdo->prepare($query);
            $stmt->execute($params);

            $newItemId = $stmt->fetchColumn();

            return ['id' => $newItemId];
        }catch(Exception $e) {
            throw new DatabaseException();
        }
    }
}
