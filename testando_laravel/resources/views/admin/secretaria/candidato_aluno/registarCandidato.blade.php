@extends('Layouts.templete')
@section('titulo','Registar Candidato')

@section('menu')
    @include('includes.main_menu_Secretaria')
@endsection

@section('caminho')
    <li><a href="{{ route('secretaria.gestaocandidato') }}">Gestao de candidatos</a></li>
    <li><a href="{{ route('secretaria.registarcandidato') }}">Registo de candidato</a></li>
@endsection

@section('corpo')
    <div class="container">
        <div class="page-header" id="top">
            <h3 class="mt-2 offset-sm-1">Registar candidato</h3>
            <hr>
        </div>
        <div class="container">
            <form method="POST" role="form" action="">
                <div class="form-row">
                    <div class="col-sm-5">
                        <label for="digitNome">Nome</label>
                        <input type="text" name="nome" id="digitNome" class="form-control" required
                            placeholder="Introduza o Apelido">
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="col-sm-5 offset-sm-2">
                        <label for="pickClasse">Classe anterior</label>
                        <select class="form-control" id="pickClasse" name="classe_anter">
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
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
                        <label for="pickProv">Provincia da escola de origem</label>
                        <select class="form-control" id="pickProv" name="provincia">
                            <option>Cidade de Maputo</option>
                            <option>Gaza</option>
                            <option>Inhambane</option>
                            <option>Tete</option>
                            <option>Cabo Delgado</option>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm-5">
                        <label for="pickDist">Distrito da escola de origem</label>
                        <select class="form-control" id="pickDist" name="distrito">
                            <option>KaMavota</option>
                            <option>Kamubukwana</option>
                            <option>KaLhamankulo</option>
                            <option>KaTembe</option>
                            <option>KaNhaka</option>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="col-sm-5 offset-sm-2">
                        <label for="pickTurno">Regime</label>
                        <select class="form-control" id="pickTurno" name="regime">
                            <option>Diurno</option>
                            <option>Nocturno</option>
                            <option>A distancia</option>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm-5 ">
                        <label>Escola de origem</label>
                        <select class="form-control" name="escola">
                            <option>Escola Secundaria Joaquim Chissano</option>
                            <option>Escola Secundaria Herois Mocambicanos</option>
                            <option>Escola Secundaria Quisse Mavota</option>
                            <option>Escola Secundaria Santa Montanha</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="form-group col-6 col-sm-5 col-md-4 ">
                        <a class="btn btn-danger " href="{{ route('secretaria.gestaocandidato') }}">
                            <span class="i-color-white">
                                <i class="fa fa-window-close"></i>Cancelar </span></a>
                        </a>
                    </div>
                    <div class="form-group col-6 col-sm-5 col-md-4">
                        <a class="btn btn-success " name="registar">
                            <span class="i-color-white"><i class="fa fa-save"></i>Salvar</span>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    
@endpush