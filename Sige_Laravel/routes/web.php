<?php

/*
Route::get('/', function () {
    return view('loading');
});
*/

Auth::routes();


Route::get('/',function(){
    return view('auth.login');
});

/*
Route::get('/',function(){
    return view('loading');
});
*/

//Candidato
Route::group (['middleware' => 'auth'], function(){
    Route::get('/Candidato','Modulo_Matricula\\Candidato_AlunoController@formulario')->name('candidato_aluno.formulario');
}); 

//Aluno
Route::group(['middleware' => 'auth','prefix' => 'Aluno','namespace' => 'Modulo_Matricula'], function(){
    Route::get('/','AlunoController@home')->name('aluno.home'); //Para home page de do aluno
});

//Secretaria 
Route::group(['middleware' => 'auth','prefix' => 'Secretaria','namespace' => 'Modulo_Matricula'], function(){
    Route::get('/','SecretariaController@home')->name('secretaria.home');//Para home page de secretaria
    Route::get('/ListaCandidatos','SecretariaController@listacandidatos')->name('secretaria.listacandidatos');
    Route::get('/ListaCandidatos/RegistarCandidato','SecretariaController@registarcandidato')->name('secretaria.registarcandidato');
    Route::post('/ListaCandidatos/RegistarCandidato/store','SecretariaController@store')->name('secretaria.registarcandidato.store');

    Route::get('/MatricularAluno','SecretariaController@matricular_step0')->name('secretaria.matricularstep0');
    Route::get('/MatricularAluno/Passo_1','SecretariaController@matricular_step1')->name('secretaria.matricularstep1');
    Route::get('/MatricularAluno/Passo_2','SecretariaController@matricular_step2')->name('secretaria.matricularstep2');
    Route::get('/MatricularAluno/Passo_3','SecretariaController@matricular_step3')->name('secretaria.matricularstep3');
});

//Director
Route::group(['middleware' => 'auth','prefix' => 'Director','namespace' => 'Modulo_Matricula'], function(){
    Route::get('/','DirectorController@home')->name('director.home'); //Para home page do director
    Route::get('/Matricula','DirectorController@matricula')->name('director.matricula');
    Route::get('/Matricula/Marcar','DirectorController@marcarmatricula')->name('director.marcarmatricula');
    Route::get('/Matricula/ListaMatriculados','DirectorController@listamatriculados')->name('director.lista_matriculados');    
});



//Auth::routes();

/*
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
*/