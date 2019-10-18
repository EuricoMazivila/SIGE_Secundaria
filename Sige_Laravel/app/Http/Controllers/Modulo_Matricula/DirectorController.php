<?php

namespace App\Http\Controllers\Modulo_Matricula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DirectorController extends Controller
{
    function home(){
        return view('admin.director.Home_Page_Director');
    }

    function matricula(){
        return view('admin.director.Matricula');
    }

    function marcarmatricula(){
        return view('admin.director.Marcar_Matricula');
    }

    function listamatriculados(){
        return view('admin.director.Lista_Matriculados');
    }

}
