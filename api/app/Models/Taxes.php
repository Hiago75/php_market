<?php
namespace App\Models;

use App\Providers\DatabaseConnectionProvider;

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

  public function getById(string $id)
  {
      $query = 'SELECT * FROM taxes WHERE id = ?';
      $params = [$id];
      $taxes = $this->db->executeQuery($query, $params);
  
      if (empty($taxes)) {
          throw new \Exception('Taxes not found');
      }
  
      return $taxes;
  }

  public function save(string $id, string $typeId, int $percentage)
  {
    $query = 'INSERT INTO taxes (id, type_id, percentage) VALUES (?, ?, ?)';
    $params = [$id, $typeId, $percentage];

    $this->db->executeQuery($query, $params);

    return 'success';
  }
}

