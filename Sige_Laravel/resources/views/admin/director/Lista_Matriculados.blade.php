@extends('Layouts.templete_director')
@section('titulo','Lista de Alunos Matriculados')

@section('caminho')
    <li><a href="{{ route('director.home') }}">Home</a></li>
    <li><a href="{{ route('director.matricula') }}">Matriculas</a></li>
    <li><a href="{{ route('director.lista_matriculados') }}">Lista Matriculados</a></li>
@endsection

@section('corpo')
    <div class="container">
        <div class="page-header" id="top">
            <h3 class="mt-2 offset-sm-1">Lista de Matriculados</h3>
            <hr>
        </div>
        <!--Deve-se Organizar este codigo -->
        <div class="offset-md-1 col-md-10">
            <form>
                <div class="form-row">
                    <div class="form-group col-2 col-md-1">
                        <label for="ano_mat">Ano </label>
                    </div>
                    <div class="col-4 col-md-3">
                        <select name="ano_mat" id="ano_mat" class="form-control">
                            <?php
                            //Completa os anos automaticamente
                            $ano=date('Y');
                            echo '<option value="'.($ano+1).'">'.($ano+1).'</option>';
                            echo '<option value="'.$ano.'" selected>'.$ano.'</option>';
                            
                            for ($i=1; $i <10 ; $i++) {
                            echo '<option value="'.($ano-$i).'">'.($ano-$i).'</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group col-2 col-md-1 offset-md-4">
                        <label for="classe">Classe </label>
                    </div>
                    <div class="col-4 col-md-3">
                        <select name="classe" id="classe" class="form-control">
                            <?php
                            //Completa as classe automaticamente
                            for ($i=8; $i <=12 ; $i++) {
                                echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="offset-sm-1 col-sm-10 mt-2">
                    <div class="pesq form-row">
                        <i class="fa fa-search form-group col-1"></i>
                        <input class="form-group col-11 pesquisa" id="nome_aluno" name="nome_aluno" type="search" 
                            placeholder="Pesquise nome do aluno">
                    </div>
                </div>
            </form>
            <div class="table-responsive mt-5" id="resultado">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Nome</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>linha['id_aluno']</td>
                            <td>linha['Nome_Completo']</td>
                            <td>linha['Data_R']</td>
                        </tr> 
                    </tbody>
                </table>
            </div>
            <div class="row ">
                <div class="form-group col-6 col-sm-5 col-md-4 offset-md-1">
                    <a class="btn btn-info text-left " href="{{ route('director.matricula') }}">
                        <span class="i-color-white"> <i class="fas fa-arrow-left"></i>&nbsp; Voltar </span>
                    </a>
                </div>
                <div class="form-group col-6 col-sm-5 offset-sm-2 col-md-4">
                    <a class="btn btn-info text-left " href="#">
                        <span class="i-color-white"><i class="fas fa-print"></i>&nbsp; Imprimir</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#nome_aluno').focusin(function() {
        $('.pesq').css("box-shadow","0 0 0 0.2rem rgba(0, 123, 255, 0.25)");
            
        });

        $('#nome_aluno').focusout(function() {
        $('.pesq').css("box-shadow","none");
        });
    </script>                            
@endpush
