<?php
namespace App\Services;

use App\Models\ProductType;

class ProductTypeService
{
    public function getAllProductTypes()
    {
        return 'It worked';
    }

    public function getProductTypeById($id)
    {
      return 'It worked + ' . $id;
    }
}