<?php


namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\Recursos;

class RecursoController extends BaseController{

    public function index(): string
    {
        $recurso = new Recursos();

        $datos['recursos'] = $recurso->orderBy('idrecurso','DESC')->findAll();
        //Solicitar las secciones: HEADER+FOOTER
        $datos['header'] = view('Layouts/header');
        $datos['footer'] = view('Layouts/footer');

        //return view('welcome_message'); //welcome_message HTML predeterminado
        return view('recursos/index', $datos); //HTML personalizado
    }

}