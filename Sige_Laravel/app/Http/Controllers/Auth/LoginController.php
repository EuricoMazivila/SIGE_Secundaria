<?php

namespace App\Http\Controllers\Auth;
<<<<<<< HEAD
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;

=======
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
>>>>>>> 395f8dcc32f55721a95262455dcf2a1f9c2e47c4
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    
    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo ="/home";
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');        
    }
<<<<<<< HEAD
=======

    function redirectTo(){
        $userId=Auth::id();
        if(User::where($userId)->where('Nivel_Acesso','Candidato')){
            $redirectTo = '/Candidato';
        }elseif(User::where($userId)->where('Nivel_Acesso','Aluno')){
            $redirectTo = '/Aluno';
        }elseif(User::where($userId)->where('Nivel_Acesso','Secretaria')){
            $redirectTo = '/Secretaria';
        }elseif(User::where($userId)->where('Nivel_Acesso','Directoria')){
            $redirectTo = '/Director';
        }
    }
>>>>>>> 395f8dcc32f55721a95262455dcf2a1f9c2e47c4
    
}
