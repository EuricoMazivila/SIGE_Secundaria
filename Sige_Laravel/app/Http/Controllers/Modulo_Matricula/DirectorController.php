<?php

namespace App\Http\Controllers\Modulo_Matricula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DirectorController extends Controller
{
    public function __construct(){
        //obriga a estar logado
        $this->middleware('auth');
    }

    public function home(){
        return view('admin.director.Home_Page_Director');
    }

    public function matricula(){
        return view('admin.director.Matricula');
    }

    public function marcarmatricula(){
        return view('admin.director.Marcar_Matricula');
    }

    public function listamatriculados(){
        return view('admin.director.Lista_Matriculados');
    }

}
