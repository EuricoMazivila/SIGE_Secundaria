<?php

namespace App\Http\Controllers\Modulo_Matricula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlunoController extends Controller
{
    function home(){
        return view('admin.aluno.Home_Page_Aluno');
    }
}
