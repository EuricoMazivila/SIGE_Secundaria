<?php

namespace App\Http\Controllers\Modulo_Matricula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pessoa;
use App\Models\Aluno;
use App\Models\Candidato_Aluno;
use App\Models\Distrito;

class SecretariaController extends Controller
{
    public function __construct(){
        //obriga a estar logado
        $this->middleware('auth');
    } 

    public function home(){
        return view('admin.secretaria.Home_Page_Secretaria');
    }

    public function listacandidatos(){  
        $candidatos=Aluno::with('pessoa')->with('candidato')->get();   
        return view('admin.secretaria.Lista_Candidatos',compact('candidatos'));
    }

    public function registarcandidato(){
        $distritos=Distrito::all();
        return view('admin.secretaria.Registar_Candidato',compact('distritos'));
    }
 
    public function store(Request $request){
        
        $request->validate([
            'nome' => 'required',
            'apelido' => 'required',
            'datanasc' => 'required',
            'sexo' => 'required',
            'classe_matr' => 'required',
            'regime' => 'required',
            'distrito' => 'required',
            'escola' => 'required'
        ]);

        $pessoa=new Pessoa([
            'id_Pessoa' => '2019C0014',
            'nome' => $request->get('nome'),
            'apelido' => $request->get('apelido'),
            'sexo' => $request->get('sexo'),
            'estado_civil' => 'Solteiro',
            'data_nascimento' => $request->get('datanasc')
        ]);
        $pessoa->save();
        
        $aluno=$pessoa->aluno()->create([
            'Tipo'=>'Candidato'
        ]);
        $aluno->save();
        
        $candidato=$aluno->candidato()->create([
            'id_escola' => $request->get('escola'),
            'classe_matricular' => $request->get('classe_matr'),
            'regime' => $request->get('regime'),
            'ano' => 2019,
            'estado' =>'Candidato'
        ]);
        $candidato->save();
        return redirect('/Secretaria/ListaCandidatos')->with('success', 'Candidato Registado!');
    }

    public function matricular_step0(){
        return view('admin.secretaria.Matricular_Step_0');
    }

    public function matricular_step1(){
        return view('admin.secretaria.Matricular_Step_1');
    }

    public function matricular_step2(){    
        return view('admin.secretaria.Matricular_Step_2');
    }

    public function matricular_step3(){
        return view('admin.secretaria.Matricular_Step_3');
    }
}
