<?php

namespace App\Http\Controllers\Modulo_Matricula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\User;

class Candidato_AlunoController extends Controller
{
    public function __construct(){
        //obriga a estar logado
        $this->middleware('auth');
    }

    public function formulario(){
<<<<<<< HEAD
        $s=$this->nivel_acesso();
        if($s){
            return redirect('/login');
        }
=======
>>>>>>> 395f8dcc32f55721a95262455dcf2a1f9c2e47c4
        return view('admin.candidato_aluno.Formulario');
    }

    //Verifica o nivel de acesso do usuario
    public function nivel_acesso(){
        $nivel=false;
        $userId=Auth::id();
        $usuario=User::where('id',$userId)->get('Nivel_Acesso')->first();
        $nivel_acesso=$usuario->Nivel_Acesso;
        if($nivel_acesso!="Candidato"){
           $nivel=true;
        }
        return $nivel;
    }

}
