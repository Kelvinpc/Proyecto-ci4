<?php


namespace App\Models;
use CodeIgniter\Model;



class Departamento extends Model{

  protected $table ='departamentos';

  protected $primarykey ="iddepartamento";

  protected $allowedFields =["departamento"];

}