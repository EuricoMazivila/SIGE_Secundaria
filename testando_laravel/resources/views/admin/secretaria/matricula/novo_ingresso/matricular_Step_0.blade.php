@extends('Layouts.templete')

@section('titulo','Matricular Passo 0')

@section('menu')
    @include('includes.menu_Secretaria')
@endsection
    
@section('caminho')
    <li><a href="{{ route('secretaria.gestaocandidato') }}">Gestao de candidatos</a></li>
@endsection

@section('corpo')
    <div class="container">
        <div class="page-header" id="top">
            <h3 class="mt-2 offset-sm-1">Matrícula de aluno</h3>
            <hr>
        </div>

        <div class="form-row">
            <div class="pesq row offset-sm-1 col-sm-6 mt-2">
                <i class="fa fa-search form-group col-1"></i>
                <input class="form-group col-11 pesquisa" id="pesquisar" name="nome_candidato" type="search" required placeholder="Pesquise nome do pré-matriculado">
            </div>

            <a class="btn btn-primary offset-sm-3 col-sm-1 mt-2" href="">
                <span class="i-color-white"> <i class="fas fa-print "></i>
                    Imprimir
                </span>
            </a>
        </div>

        <div class="form-row">

            <div class="table-responsive" id="result">
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
                        @foreach($candidatos as $candidato)
                            <tr>
                                <td>{{$candidato->codCand}}</td>
                                <td>{{$candidato->nome_completo}}</td>
                                <td>{{$candidato->turno}}</td>
                                <td>{{$candidato->classe_matricular}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

        <div class="size offset-6">
            <ul class="lista">
                <li role="button" id="myBtn" onclick="popup()"><a href="{{ route('secretaria.matricular_1') }}"><i class="fa fa-eraser fa-2x"></i><span>Matricular aluno</span></a> </li>
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

    <script>
        $('#pesquisar').focusin(function() {
        $('.pesq').css("box-shadow","0 0 0 0.2rem rgba(0, 123, 255, 0.25)");
            
        });

        $('#pesquisar').focusout(function() {
        $('.pesq').css("box-shadow","none");
        });
    </script>
@endpush
