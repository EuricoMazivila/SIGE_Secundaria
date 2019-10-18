@extends('Layouts.templete_director')
@section('titulo','Matricula')

@section('caminho')
    <li><a href="{{ route('director.home') }}">Home</a></li>
    <li><a href="{{ route('director.matricula') }}">Matriculas</a></li>
@endsection

@section('corpo')
    <div class="container">
        <div class="page-header" id="top">
            <h3 class="mt-2 offset-sm-1">Matrículas</h3>
            <hr>
        </div>
        <!--Deve-se Organizar este codigo -->
        <div class="offset-md-1 col-md-10">
            <form>
                <div class="form-row">
                    <div class="form-group col-2 col-sm-1">
                        <label for="selecAnoo">Ano </label>
                    </div>
                    <div class="col-4 col-sm-3">
                        <select name="ano" id="selecAnoo" class="form-control">
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

                    <div class="form-group offset-sm-2 offset-md-5  col-6 col-sm-5 col-md-3">
                        <a class="btn btn-default text-left btn-block   btn-primary" href="{{route('director.lista_matriculados')}}">
                            <span class="i-color-white">
                                <i class="fas fa-list-alt"></i>
                                Listar matriculados
                            </span>
                        </a>
                    </div>
                </div>

            </form>
            <div class="table-responsive" id="resultado">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Classe</th>
                            <th>Seccao</th>
                            <th>Turno</th>
                            <th>Total de vagas</th>
                            <th>Vagas preenchidas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>linha['classe']</td>
                            <td>linha['seccao']</td>
                            <td>linha['turno']</td>
                            <td>linha['total_vagas']</td>
                            <td>linha['vagas_preenchidas']</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row ">
                <div class="form-group col-6 col-sm-5 col-md-4 offset-md-1">
                    <a class="btn btn-info text-left btn-block" href="">
                    <span class="i-color-white"> <i class="fas fa-marker"></i>&nbsp; Editar Matricula</span>
                    </a>
                </div>
                <div class="form-group col-6 col-sm-5 offset-sm-2 col-md-4">
                    <a class="btn btn-info text-left btn-block" href="{{ route('director.marcarmatricula') }}">
                    <span class="i-color-white"><i class="fas fa-highlighter"></i>&nbsp;Marcar Matricula</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script >
        $(function(){
            $('.size').styleddropdown();
        });
    </script>                        
@endpush