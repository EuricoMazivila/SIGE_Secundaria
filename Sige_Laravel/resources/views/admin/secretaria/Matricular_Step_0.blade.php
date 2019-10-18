@extends('Layouts.templete_secretaria')
@section('titulo','Matricular Aluno')

@section('caminho')
    <li><a href="{{ route('secretaria.home') }}">Home</a></li>
    <li><a href="{{ route('secretaria.matricularstep0') }}">Matricular Aluno</a></li>
@endsection

@section('corpo')
<div class="container">
    <div class="page-header" id="top">
        <h3 class="mt-2 offset-sm-1">Matrícula de aluno</h3>
        <hr>
    </div>
    <form>
        <div class="form-row">
            <div class="pesq row offset-sm-1 col-sm-6 mt-2">
                <i class="fa fa-search form-group col-1"></i>
                <input class="form-group col-11 pesquisa" id="nome_candidato" name="nome_candidato_m" type="search" required placeholder="Pesquise nome do pré-matriculado">
            </div>
            <input type="hidden" name="id_escola" value=<?php //echo $id_local;?>>

            <a class="btn btn-primary offset-sm-3 col-sm-1 mt-2" href="">
                <span class="i-color-white"> <i class="fas fa-print "></i>
                    Imprimir
                </span>
            </a>
        </div>
    </form>    

    <div class="form-row mt-5">
    	<div class="table-responsive" id="resultado">
            <table class="table table-hover offset-md-1 col-md-10" id="table">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Turno</th>
                        <th>Classe</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>linha['id_candidato']</td>
                        <td>linha['nome_completo']</td>
                        <td>linha['regime']</td>
                        <td>linha['classe_matricular']</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    <div class="size offset-6">
        <ul class="listaa">
           <li role="button" id="myBtn"><a href="{{ route('secretaria.matricularstep1') }}"><i class="fa fa-eraser fa-2x"></i><span>Matricular aluno</span></a> </li> 
        </ul>
    </div>
</div>    
@endsection

@push('scripts')
    <script>
        $(function () {
            $('.size').styleddropdown();
        });
    </script>
@endpush

