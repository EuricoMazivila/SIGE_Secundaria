<?php

namespace App\Http\Controllers\Matricula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Candidato_Aluno;

class MatriculaController extends Controller
{
    //Funcoes de matricula que tem a ver com o director da escola
    //Matriculas Marcadas
    public function matricula(){
        return view('admin.director.matricula');   
    }
    
    //Marcar Matricula
    public function marcarmatricula(){
        return view('admin.director.marcarmatricula');   
    }

    // Listar Alunos Matriculados
    public function listamatriculados(){
        return view('admin.director.listamatriculados');   
    }

    //Funcoes de matricula que tem a ver com a secretaria da escola (novo ingresso)
    public function matricular_0(){
        $candidatos=Candidato_Aluno::all();
        return view('admin.secretaria.matricula.novo_ingresso.matricular_step_0',compact('candidatos'));
    }

    public function matricular_1(){
        return view('admin.secretaria.matricula.novo_ingresso.matricular_step_1');
    }

    public function matricular_2(){
        return view('admin.secretaria.matricula.novo_ingresso.matricular_step_2');
    }

    public function matricular_3(){
        return view('admin.secretaria.matricula.novo_ingresso.matricular_step_3');
    }

}
