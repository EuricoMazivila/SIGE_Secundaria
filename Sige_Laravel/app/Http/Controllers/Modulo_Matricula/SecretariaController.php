<?php

namespace App\Http\Controllers\Modulo_Matricula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SecretariaController extends Controller
{
    function home(){
        return view('admin.secretaria.Home_Page_Secretaria');
    }

    function listacandidatos(){
        return view('admin.secretaria.Lista_Candidatos');
    }

    function registarcandidato(){
        return view('admin.secretaria.Registar_Candidato');
    }

    function matricular_step0(){
        return view('admin.secretaria.Matricular_Step_0');
    }

    function matricular_step1(){
        return view('admin.secretaria.Matricular_Step_1');
    }

    function matricular_step2(){
        return view('admin.secretaria.Matricular_Step_2');
    }

    function matricular_step3(){
        return view('admin.secretaria.Matricular_Step_3');
    }


}
