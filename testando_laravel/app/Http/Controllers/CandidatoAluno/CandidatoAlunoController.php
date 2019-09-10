<?php

namespace App\Http\Controllers\CandidatoAluno;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Candidato_Aluno;

class CandidatoAlunoController extends Controller{

  
  public function gestaocandidato(){
    $candidatos=Candidato_Aluno::all();
    return view('admin.secretaria.candidato_aluno.listaCandidato',compact('candidatos'));   
  }

  public function registarcandidato(){
    return view('admin.secretaria.candidato_aluno.registarCandidato');   
  }
  
  public function prematricula(){
    return view('admin.alunos.candidato_aluno.formulario_prematricula');
  }
    
}
