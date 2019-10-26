<?php

namespace App\Http\Controllers\Modulo_Matricula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlunoController extends Controller
{
    public function __construct(){
        //obriga a estar logado
        $this->middleware('auth');
    }

    public function home(){
        return view('admin.aluno.Home_Page_Aluno');
    }
    
}
