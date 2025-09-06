<?php

namespace App\Models;
use CodeIgniter\Model;

class Recursos extends Model{


  protected $table = 'recursos';
  protected $primaryKey = "idrecurso";
  protected $allowedFields = ["idsubcategoria, ideditorial, tipo, titulo, apublicacion, isbn, numpaginas, rutaportada, rutarecurso, estado, modificado"];

  public function Vista_recursos(){
    $query = $this->db->query("SELECT * FROM mostrar_recursos ORDER BY idrecurso ASC");
    return $query->getResultArray();
  }


}