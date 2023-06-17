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

  // TODO: validate if type exists
  // TODO: validate if type already have a tax entry;
  public function save(string $id, string $typeId, int $percentage)
  {
    $query = 'INSERT INTO taxes (id, type_id, percentage) VALUES (?, ?, ?)';
    $params = [$id, $typeId, $percentage];

    $this->db->executeQuery($query, $params);

    return 'success';
  }
}
