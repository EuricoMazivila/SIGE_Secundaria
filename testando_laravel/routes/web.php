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
/*
Auth::routes();
*/
/*
Route::group (['middleware' => 'auth'], function(){
    Route::get('exemplo','Controller@exemplo');
});
*/

Route::get('/',function(){
    return view('loading');
});

/*Route::get('/',function(){
    return view('admin.secretaria.listaCandidato');
});
*/
//Rotas de Gestao de Candidato
Route::get('secretaria/gestao/candidato','CandidatoAluno\\CandidatoAlunoController@gestaocandidato')->name('secretaria.gestaocandidato');
Route::get('secretaria/registar/candidato','CandidatoAluno\\CandidatoAlunoController@registarcandidato')->name('secretaria.registarcandidato');
Route::get('candidato/prematricula','CandidatoAluno\\CandidatoAlunoController@prematricula')->name('candidato.prematricula');
//Route::post('');

//Matricular um Candidato
Route::get('secretaria/matricular/candidato','Matricula\\MatriculaController@matricular_0')->name('secretaria.matricular_0');
Route::get('secretaria/matricular/candidato/passo1','Matricula\\MatriculaController@matricular_1')->name('secretaria.matricular_1');
Route::get('secretaria/matricular/candidato/passo2','Matricula\\MatriculaController@matricular_2')->name('secretaria.matricular_2');
Route::get('secretaria/matricular/candidato/passo3','Matricula\\MatriculaController@matricular_3')->name('secretaria.matricular_3');

//Gestao de Matriculas (director)
Route::get('director/matricula','Matricula\\MatriculaController@matricula')->name('director.matricula');
Route::get('director/matricula/marcar','Matricula\\MatriculaController@marcarmatricula')->name('director.marcarmatricula');
//Route::post('');
Route::get('director/matricula/listamatriculados','Matricula\\MatriculaController@listamatriculados')->name('director.listamatriculados');


//Exemplos Rotas Para o candidato Candidato
/*
Route::get('candidato','CandidatoAluno\\CandidatoAlunoController@candidato')->name('candidato');
Route::get('candidato/registar','CandidatoAluno\\CandidatoAlunoController@registar')->name('candidato.registar');
Route::post('candidato/salvar','CandidatoAluno\\CandidatoAlunoController@salvar')->name('salvar');
*/


