<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\User;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId=Auth::id();
        $usuario=User::where('id',$userId)->get('Nivel_Acesso')->first();
        $nivel_acesso=$usuario->Nivel_Acesso;
        if($nivel_acesso=="Candidato"){
            return redirect('/Candidato');
        }
        
        if($nivel_acesso=="Secretaria"){
            return redirect('/Secretaria');
        }

        if($nivel_acesso=="Directoria"){
           return redirect('/Director');
        }

        if($nivel_acesso=="Aluno"){
           return redirect('/Aluno');
        }

    }
}
