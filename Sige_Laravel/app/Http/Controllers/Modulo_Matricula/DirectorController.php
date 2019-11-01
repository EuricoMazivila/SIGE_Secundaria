<?php

namespace App\Http\Controllers\Modulo_Matricula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\User;

class DirectorController extends Controller
{
    public function __construct(){
        //obriga a estar logado
        $this->middleware('auth');
    }

    public function home(){
<<<<<<< HEAD
        $s=$this->nivel_acesso();
        if($s){
            return redirect('/login');
        }
=======
>>>>>>> 395f8dcc32f55721a95262455dcf2a1f9c2e47c4
        return view('admin.director.Home_Page_Director');
    }

    public function matricula(){
<<<<<<< HEAD
        $s=$this->nivel_acesso();
        if($s){
            return redirect('/login');
        }
=======
>>>>>>> 395f8dcc32f55721a95262455dcf2a1f9c2e47c4
        return view('admin.director.Matricula');
    }

    public function marcarmatricula(){
<<<<<<< HEAD
        $s=$this->nivel_acesso();
        if($s){
            return redirect('/login');
        }
=======
>>>>>>> 395f8dcc32f55721a95262455dcf2a1f9c2e47c4
        return view('admin.director.Marcar_Matricula');
    }

    public function listamatriculados(){
<<<<<<< HEAD
        $s=$this->nivel_acesso();
        if($s){
            return redirect('/login');
        }
=======
>>>>>>> 395f8dcc32f55721a95262455dcf2a1f9c2e47c4
        return view('admin.director.Lista_Matriculados');
    }

    //Verifica o nivel de acesso do usuario
    public function nivel_acesso(){
        $nivel=false;
        $userId=Auth::id();
        $usuario=User::where('id',$userId)->get('Nivel_Acesso')->first();
        $nivel_acesso=$usuario->Nivel_Acesso;
        if($nivel_acesso!="Directoria"){
           $nivel=true;
        }
        return $nivel;
    }

}
