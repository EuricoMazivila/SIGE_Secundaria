<?php

namespace App\Http\Controllers\Modulo_Matricula;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    function teste(){
        return view('admin.aluno.Home_Page_Aluno');
    }
}
