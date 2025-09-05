<?php


namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\Provincia;

class ProvinciaController extends BaseController{

public function getProvinciasByDepartamento($iddepartamento= "") {
  $this->response->setContentType('application/json');
  $provincia = new Provincia();

  // Verificar que $iddepartamento no esté vacío
  if (empty($iddepartamento)) {
    return $this->response->setJSON(['error' => 'ID de departamento no válido']);
  }

  $listaProvincias = $provincia->where('iddepartamento',$iddepartamento)->findAll();
  return $this->response->setJSON($listaProvincias);
}


}