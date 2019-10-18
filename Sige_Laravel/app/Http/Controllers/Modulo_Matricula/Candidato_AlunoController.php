<?php

namespace App\Http\Controllers\Modulo_Matricula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Candidato_AlunoController extends Controller
{
    function formulario(){
        return view('admin.candidato_aluno.Formulario');
    }
}
