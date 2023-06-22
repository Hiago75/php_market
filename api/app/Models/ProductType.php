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
        try {
            $query = 'SELECT product_types.id, product_types.name, taxes.percentage AS tax_percentage
                      FROM product_types
                      JOIN taxes ON product_types.id = taxes.type_id';
    
            return $this->db->executeQuery($query);
        } catch (PDOException $e) {
            throw new DatabaseException();
        }
    }

    public function save(string $id, string $name)
    {
        $this->db->checkIfExists('product_types', 'id', $id, 'Essa categoria já existe');

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
