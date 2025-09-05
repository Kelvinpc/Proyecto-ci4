<?php


namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\Distrito;

class DistritoController extends BaseController{

public function getDistritoByProvincia($idprovincia="") {
  $this->response->setContentType('application/json');
  $distrito = new Distrito();

  // Verificar que $idprovincia no esté vacío
  if (empty($idprovincia)) {
    return $this->response->setJSON(['error' => 'ID de departamento no válido']);
  }

  $listaDistrito = $distrito->where('idprovincia',$idprovincia)->findAll();
  return $this->response->setJSON($listaDistrito);
}


}