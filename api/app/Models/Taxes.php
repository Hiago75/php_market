<?php
namespace App\Models;

use App\Database\DatabaseConnection;

class Taxes
{
  private $db;

  public function __construct(DatabaseConnection $db)
  {
    $this->db = $db;
  }

  public function getAll()
  {
    return $this->db->executeQuery('SELECT * FROM taxes');
  }
}
