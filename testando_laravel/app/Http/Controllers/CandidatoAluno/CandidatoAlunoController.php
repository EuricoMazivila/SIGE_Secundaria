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
  
  /*
  public function candidato(){
    //$candidatos=Candidato_Aluno::all();
    $candidatos=Candidato_Aluno::where([
      'turno' => 'nocturno'
    ])->get();
    return view('admin.alunos.candidato_aluno.candidato',compact('candidatos'));   
  }

  public function registar(){
    return view('admin.alunos.candidato_aluno.registar');   
  }

  public function salvar(){
    echo "Salvo com sucesso";
  }
  */
  
}
