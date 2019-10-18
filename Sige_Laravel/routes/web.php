<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Aluno
Route::group(['prefix' => 'Aluno','namespace' => 'Modulo_Matricula'], function(){
    Route::get('/','AlunoController@home')->name('aluno.home'); //Para home page de do aluno
});

//Secretaria 
Route::group(['prefix' => 'Secretaria','namespace' => 'Modulo_Matricula'], function(){
    Route::get('/','SecretariaController@home')->name('secretaria.home');//Para home page de secretaria
    Route::get('/ListaCandidatos','SecretariaController@listacandidatos')->name('secretaria.listacandidatos');
    Route::get('/ListaCandidatos/RegistarCandidato','SecretariaController@registarcandidato')->name('secretaria.registarcandidato');

    Route::get('/MatricularAluno','SecretariaController@matricular_step0')->name('secretaria.matricularstep0');
    Route::get('/MatricularAluno/Passo_1','SecretariaController@matricular_step1')->name('secretaria.matricularstep1');
    Route::get('/MatricularAluno/Passo_2','SecretariaController@matricular_step2')->name('secretaria.matricularstep2');
    Route::get('/MatricularAluno/Passo_3','SecretariaController@matricular_step3')->name('secretaria.matricularstep3');
});

//Director
Route::group(['prefix' => 'Director','namespace' => 'Modulo_Matricula'], function(){
    Route::get('/','DirectorController@home')->name('director.home'); //Para home page do director
    Route::get('/Matricula','DirectorController@matricula')->name('director.matricula');
    Route::get('/Matricula/Marcar','DirectorController@marcarmatricula')->name('director.marcarmatricula');
    Route::get('/Matricula/ListaMatriculados','DirectorController@listamatriculados')->name('director.lista_matriculados');    
});

//Candidato
Route::get('/Candidato','Modulo_Matricula\\Candidato_AlunoController@formulario')->name('candidato_aluno.formulario');




