<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $userId=Auth::id();
            if(User::where($userId)->where('Nivel_Acesso','Candidato')){
                return redirect('/Candidato');
            }elseif(User::where($userId)->where('Nivel_Acesso','Aluno')){
                return redirect('/Aluno');
            }elseif(User::where($userId)->where('Nivel_Acesso','Secretaria')){
                return redirect('/Secretaria');
            }elseif(User::where($userId)->where('Nivel_Acesso','Directoria')){
                return redirect('/Director');
            } 
        }

        return $next($request);
    }
}
