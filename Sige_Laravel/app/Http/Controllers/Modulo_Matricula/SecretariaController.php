<?php

namespace App\Http\Controllers\Modulo_Matricula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pessoa;
use App\Models\Aluno;
use App\Models\Candidato_Aluno;
use App\Models\Distrito;

use Illuminate\Support\Facades\Auth;
use App\User;


class SecretariaController extends Controller
{
    public function __construct(){
        //obriga a estar logado
        $this->middleware('auth');

    }

    public function home(){
        $s=$this->nivel_acesso();
        if($s){
            return redirect('/login');
        }
        return view('admin.secretaria.Home_Page_Secretaria');
    }

    public function listacandidatos(){  
        $s=$this->nivel_acesso();
        if($s){
            return redirect('/login');
        }
        $candidatos=Aluno::with('pessoa')->with('candidato')->get();   
        return view('admin.secretaria.Lista_Candidatos',compact('candidatos'));
    }
 
    public function registarcandidato(){
        $s=$this->nivel_acesso();
        if($s){
            return redirect('/login');
        }
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
        $s=$this->nivel_acesso();
        if($s){
            return redirect('/login');
        }
        return view('admin.secretaria.Matricular_Step_0');
    }

    public function matricular_step1(){
        $s=$this->nivel_acesso();
        if($s){
            return redirect('/login');
        }
        return view('admin.secretaria.Matricular_Step_1');
    }

    public function matricular_step2(){    
        $s=$this->nivel_acesso();
        if($s){
            return redirect('/login');
        }
        return view('admin.secretaria.Matricular_Step_2');
    }

    public function matricular_step3(){
        $s=$this->nivel_acesso();
        if($s){
            return redirect('/login');
        }
        return view('admin.secretaria.Matricular_Step_3');
    }

    //Verifica o nivel de acesso do usuario
    public function nivel_acesso(){
        $nivel=false;
        $userId=Auth::id();
        $usuario=User::where('id',$userId)->get('Nivel_Acesso')->first();
        $nivel_acesso=$usuario->Nivel_Acesso;
        if($nivel_acesso!="Secretaria"){
           $nivel=true;
        }
        return $nivel;
    }
}
