@extends('Layouts.templete_secretaria')
@section('titulo','Registar Candidato')

@section('caminho')
    <li><a href="{{ route('secretaria.home') }}">Home</a></li>
    <li><a href="{{ route('secretaria.listacandidatos') }}">Lista_Candidatos</a></li>
    <li><a href="{{ route('secretaria.registarcandidato') }}">Registar Candidato</a></li>
@endsection

@section('corpo')
    <div class="container">
        <div class="page-header" id="top">
            <h3 class="mt-2 offset-sm-1">Registar candidato</h3>
            <hr>
        </div>

        <div class="container">
            <form method="POST" role="form" action="{{route('secretaria.registarcandidato.store')}}">
                @csrf
                <input type="hidden" name="id_Escola" value='<?php  //echo $id_local;?>'>
                <div class="form-row">
                    <div class="col-sm-5">
                        <label for="digitNome">Nomes</label>
                        <input type="text" name="nome" id="digitNome" class="form-control" required
                            placeholder="Introduza os primeiros nomes">
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="col-sm-5 offset-sm-2">
                        <label for="digitApelido">Apelido</label>
                        <input type="text" name="apelido" id="digitApelido" class="form-control" required
                            placeholder="Introduza o apelido">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm-5">
                        <label for="digitdataNasc">Data de Nascimento</label>
                        <input type="date" name="datanasc" id="digitdataNasc" class="form-control" required>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="col-sm-5 offset-sm-2">
                        <label for="pickSexo">Sexo</label>
                        <select class="form-control" id="pickSexo" name="sexo">
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-sm-5">
                        <label for="pickClass">Classe a matricular</label>
                        <select class="form-control" id="pickClass" name="classe_matr">
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="col-sm-5 offset-sm-2">
                        <label for="pickTurno">Regime</label>
                        <select class="form-control" id="pickTurno" name="regime">
                            <option>Diurno</option>
                            <option>Nocturno</option>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm-5">
                        <label for="id_distrito">Distrito da escola de origem</label>
                        <select class="form-control" id="id_distrito" name="distrito" placeholder="Selecione o distrito da escola de origem">
                            <option value="">Selecione o distrito da escola de origem</option>
                            @foreach($distritos as $distrito)
                                <option value="{{ $distrito->id_distrito }}">{{ $distrito->Nome}}</option>
                            @endforeach
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="col-sm-5 offset-sm-2">
                        <label>Escola de origem</label>
                        <select class="form-control" name="escola" id="id_escola">    
                            <option value="">Selecione a escola de origem</option>
                            <option value="20190002">Malhazine</option>
                        </select>
                    </div>
                </div>
                
                <div class="row mt-5">
                    <div class="form-group col-6 col-sm-5 col-md-4 ">
                        <a class="btn btn-info " href="{{ route('secretaria.listacandidatos') }}">
                            <span class="i-color-white">
                            <i class="fa fa-arrow-left"></i>Voltar </span></a>
                        </a>
                    </div>
                    <div class="form-group col-6 col-sm-5 col-md-4">
                        <button type="submit" class="btn btn-success" name="registar">
                            <span class="i-color-white"><i class="fa fa-save"></i>Salvar</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

