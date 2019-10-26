<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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

   // protected $redirectTo = '/Aluno';
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

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
    
}
