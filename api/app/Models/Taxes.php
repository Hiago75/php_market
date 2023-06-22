<?php
namespace App\Models;

use App\Providers\DatabaseConnectionProvider;
use App\Exceptions\DatabaseException;

class Taxes
{
  private $db;

  public function __construct(DatabaseConnectionProvider $db)
  {
    $this->db = $db;
  }

  public function getAll()
  {
    return $this->db->executeQuery('SELECT * FROM taxes');
  }

  public function save(string $id, string $typeId, int $percentage)
  {
    $this->db->checkIfExists('taxes', 'id', $id, 'Esse produto já possui impostos atrelados');

    try{
      $query = 'INSERT INTO taxes (id, type_id, percentage) VALUES (?, ?, ?)';
      $params = [$id, $typeId, $percentage];

      $this->db->executeQuery($query, $params);
    }catch(Exception $e) {
      throw new DatabaseException();
    }
  }
}

