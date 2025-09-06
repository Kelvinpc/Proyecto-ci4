<?php


namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\Recursos;
use App\Models\Categoria;

class RecursoController extends BaseController{

    public function index(): string
    {
        $recurso = new Recursos();

        $datos['recursos'] = $recurso->Vista_recursos();
        $datos['header'] = view('Layouts/header');
        $datos['footer'] = view('Layouts/footer');

        //return view('welcome_message'); //welcome_message HTML predeterminado
        return view('recursos/index', $datos); //HTML personalizado
    }
    


    public function crear(): string
    {

        $categoria = new Categoria();
        $datos['categorias'] = $categoria->orderBy('categoria','ASC')->findAll();


        $datos['header'] = view('Layouts/header');
        $datos['footer'] = view('Layouts/footer');

        return view('recursos/crear', $datos);
    }

}