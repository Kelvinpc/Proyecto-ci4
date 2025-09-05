<?php

namespace App\Controllers;

use App\Models\Persona;
use App\Models\Departamento;
use App\Controllers\BaseController;

class PersonaController extends BaseController{

  public function index(){

    $persona = new Persona();

    $datos['personas'] = $persona->orderBy('idpersona','DESC')->findAll();
    $datos['header'] = view('Layouts/header');
    $datos['footer'] = view('Layouts/footer');

    return view('personas/index',$datos);

  }
  
    public function crear(){

    $departamento = new Departamento();

    $datos['departamentos'] = $departamento->orderBy('departamento','ASC')->findAll();
    $datos['header'] = view('Layouts/header');
    $datos['footer'] = view('Layouts/footer');

    return view('personas/crear',$datos);

  }



    public function guardar() {
    $persona = new Persona();
    
    $nombres = $this ->request->getVar('nombres');
    $apellidos = $this ->request->getVar('apellidos');
    $dni = $this ->request->getVar('dni');
    $telefono = $this ->request->getVar('telefono');
    $iddistrito = $this ->request->getVar('iddistrito');
    $direccion = $this ->request->getVar('direccion');

    $registro =[
      'nombres' => $nombres,
      'apellidos' => $apellidos,
      'dni' => $dni,
      'telefono' => $telefono,
      'iddistrito' => $iddistrito,
      'direccion' => $direccion
    ];


    $persona ->insert($registro);

    return $this->response->redirect(base_url('/personas'));    
  
  }


  public function searchByDNI($dni= ""){
    // $dni = "74760662";

    $api_endpoint="https://api.decolecta.com/v1/reniec/dni?numero=" .$dni ;
    $api_token="sk_10066.jJRwyZ8WL9mCnmB0ZpjPtust0jao0rfw";
    $content_type="application/json";

    //Configuracion de cURL para realizacion petición
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$api_endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch, CURLOPT_HTTPHEADER,[
      'Content-type:' . $content_type,
      'Authorization: Bearer ' . $api_token
    ]);


    //Ejecutar la petición
    $api_response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if($api_response === false){
      return $this->response->setJSON([
        'success' => false,
        'message' => 'No se pudo realizar la consulta'
      ]);
    }

    // Decodifier la respuesta
    $decoded_response = json_decode($api_response,true);

    if($http_code ===404){
      return $this->response->setJSON([
        'success' => false,
        'message' => 'No encontramos la persona'
      ]);
    }

    return $this->response->setJSON([
      'success'           => true,
      'Apellidopaterno'  => $decoded_response['first_last_name'],
      'Apellidomaterno'  => $decoded_response['second_last_name'],
      'Nombres'           => $decoded_response['first_name']
    ]);

  }
  

}