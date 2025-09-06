<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Subcategoria;

class SubcategoriaController extends BaseController
{
  public function getSubcategoriaByCategoria($idcategoria= "") {
    $this->response->setContentType('application/json');
    $subcategoria = new Subcategoria();

    // Verificar que $idcategoria no esté vacío
    if (empty($idcategoria)) {
      return $this->response->setJSON(['error' => 'ID de categoria no válido']);
    }

    $listaSubcategoria = $subcategoria->where('idcategoria',$idcategoria)->findAll();
    return $this->response->setJSON($listaSubcategoria);
  }
}
