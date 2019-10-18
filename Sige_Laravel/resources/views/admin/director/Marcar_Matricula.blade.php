@extends('Layouts.templete_director')
@section('titulo','Marcar Matricula')

@section('caminho')
    <li><a href="{{ route('director.home') }}">Home</a></li>
    <li><a href="{{ route('director.matricula') }}">Matriculas</a></li>
    <li><a href="{{ route('director.marcarmatricula') }}">Marcar Matriculas</a></li>
@endsection

@section('corpo')
    <div class="container">
        <div class="page-header" id="top">
            <h3 class="mt-2 offset-sm-1">Marcar Matrícula</h3>
            <hr>
        </div>
        <!--Deve-se Organizar este codigo -->
        <div class="offset-md-1 col-md-10">
            <form method="POST" action="">
                <input type="hidden" name="id_escola" value="<?php //echo $id_local;?>">
                <div class="form-row">
                    <div class="form-group col-sm-3 col-4 col-md-2">
                        <label for="dataInic">Data de início </label>
                    </div>
                    <div class="col-sm-3 col-8">
                        <input type="date" name="dataInic" min="<?php echo (date('Y')).'-10-01';?>" class="form-control" id="dataInic" required>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group col-4 col-sm-3 col-md-2 offset-md-2">
                        <label for="dataInic">Data de fim </label>
                    </div>
                    <div class="col-8 col-sm-3">
                        <input type="date" name="dataFim" max="<?php echo (date('Y')+1).'-03-30';?>" class="form-control" id="dataFim" required>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="row col-sm-4 col-md-4">
                    <label for="tipo">Tipo de Matricula</label>
                    <select class="form-control" name="tipo" id="tipo" required>
                        <option value="">Seleciona o tipo de Matricula</option>
                        <option>Normal</option>
                        <option>Renovacao</option>
                    </select>    
                </div>

                <div class="row">
                    <div class="table-responsive offset-md-1">
                        <table class="table table-hover col-sm-10 col-md-10 mt-5" id="tabela">
                            <thead>
                                <tr>
                                    <th>Classe</th>
                                    <th>Turno</th>
                                    <th>Total de vagas</th>
                                    <th>Seccao</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr>
                                    <td>8</td>
                                    <td>Diurno</td>
                                    <td><input type='number' min="0" class="borderless" name="tot_vagas_oita_d" value="0" required></td>
                                    <td>Geral</td>    
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>Nocturno</td>
                                    <td><input type='number' min="0" class="borderless" name="tot_vagas_oita_n" value="0" required></td>
                                    <td>Geral</td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>Diurno</td>
                                    <td><input type='number' min="0" class="borderless" name="tot_vagas_nona_d" value="0" required></td>
                                    <td>Geral</td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>Nocturno</td>
                                    <td><input type='number' min="0" class="borderless" name="tot_vagas_nona_n" value="0" required></td>
                                    <td>Geral</td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td>Diurno</td>
                                    <td><input type='number' min="0" class="borderless" name="tot_vagas_dec_d" value="0" required></td>
                                    <td>Geral</td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td>Nocturno</td>
                                    <td><input type='number' min="0" class="borderless" name="tot_vagas_dec_n" value="0" required></td>
                                    <td>Geral</td>
                                </tr>
                                <tr>
                                    <td>11</td>
                                    <td>Diurno</td>
                                    <td><input type='number' min="0" class="borderless" name="tot_vagas_decp_a_d" value="0" required></td>
                                    <td>Letras</td>
                                </tr>
                                <tr>
                                    <td>11</td>
                                    <td>Nocturno</td>
                                    <td><input type='number' min="0" class="borderless" name="tot_vagas_decp_a_n" value="0" required></td>
                                    <td>Letras</td>
                                </tr>

                                <tr>
                                    <td>11</td>
                                    <td>Diurno</td>
                                    <td><input type='number' min="0" class="borderless" name="tot_vagas_decp_bb_d" value="0" required></td>
                                    <td> Ciencias com Biologia</td>
                                </tr>
                                <tr>
                                    <td>11</td>
                                    <td>Nocturno</td>
                                    <td><input type='number' min="0" class="borderless" name="tot_vagas_decp_bb_n" value="0" required></td>
                                    <td>Ciencias com Biologia</td>
                                </tr>
                                <tr>
                                    <td>11</td>
                                    <td>Diurno</td>
                                    <td><input type='number' min="0" class="borderless" name="tot_vagas_decp_bg_d" value="0" required></td>
                                    <td>Ciencias com Geografia</td>
                                </tr>
                                <tr>
                                    <td>11</td>
                                    <td>Nocturno</td>
                                    <td><input type='number' min="0" class="borderless" name="tot_vagas_decp_bg_n" value="0" required></td>
                                    <td>Ciencias com Geografia</td>
                                </tr>
                                <tr>
                                    <td>11</td>
                                    <td>Diurno</td>
                                    <td><input type='number' min="0" class="borderless" name="tot_vagas_decp_c_d" value="0" required></td>
                                    <td>Ciencias com Desenho</td>
                                </tr>
                                <tr>
                                    <td>11</td>
                                    <td>Nocturno</td>
                                    <td><input type='number' min="0" class="borderless" name="tot_vagas_decp_c_n" value="0" required></td>
                                    <td>Ciencias com Desenho</td>
                                </tr>
                                
                                <tr>
                                    <td>12</td>
                                    <td>Diurno</td>
                                    <td><input type='number' min="0" class="borderless" name="tot_vagas_decs_a_d" value="0" required></td>
                                    <td>Letras</td>
                                </tr>
                                <tr>
                                    <td>12</td>
                                    <td>Nocturno</td>
                                    <td><input type='number' min="0" class="borderless" name="tot_vagas_decs_a_n" value="0" required></td>
                                    <td>Letras</td>
                                </tr>
                                <tr>
                                    <td>12</td>
                                    <td>Diurno</td>
                                    <td><input type='number' min="0" class="borderless" name="tot_vagas_decs_bb_d" value="0" required></td>
                                    <td>Ciencias com Biologia</td>
                                </tr>
                                <tr>
                                    <td>12</td>
                                    <td>Nocturno</td>
                                    <td><input type='number' min="0" class="borderless" name="tot_vagas_decs_bb_n" value="0" required></td>
                                    <td>Ciencias com Biologia</td>
                                </tr>
                                <tr>
                                    <td>12</td>
                                    <td>Diurno</td>
                                    <td><input type='number' min="0" class="borderless" name="tot_vagas_decs_bg_d" value="0" required></td>
                                    <td> Ciencias com Geografia</td>
                                </tr>
                                <tr>
                                    <td>12</td>
                                    <td>Nocturno</td>
                                    <td><input type='number' min="0" class="borderless" name="tot_vagas_decs_bg_n" value="0" required></td>
                                    <td> Ciencias com Geografia</td>
                                </tr>
                                <tr>
                                    <td>12</td>
                                    <td>Diurno</td>
                                    <td><input type='number' min="0" class="borderless" name="tot_vagas_decs_c_d" value="0" required></td>
                                    <td>Ciencias com Desenho</td>
                                </tr>
                                <tr>
                                    <td>12</td>
                                    <td>Nocturno</td>
                                    <td><input type='number' min="0" class="borderless" name="tot_vagas_decs_c_n" value="0" required></td>
                                    <td>Ciencias com Desenho</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row ">
                    <div class="form-group col-6 col-sm-5 col-md-4 mt-5 offset-md-1">
                    <a class="btn btn-danger text-left" href="{{ route('director.matricula') }}">
                        <span class="i-color-white"> <i class="fa fa-window-close fa-2x"></i>&nbsp; Cancelar</span>
                    </a>
                </div>
                <div class="form-group col-6 col-sm-5 mt-5 offset-sm-2 col-md-4">
                    <button class="btn btn-success text-left" type="submit" name="marcar_matricula"><span class="i-color-white"><i class="fa fa-save fa-2x"></i>&nbsp;Salvar</span></button>
                </div>
            </form>
        </div>
    </div>    
@endsection

@push('scripts')
    <script>
        var t = document.getElementById('tabela'), rIndex;
        var x;

        function popup() {
            var modal = document.getElementById("myModal");
            modal.style.display = "block";

            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        }

        function closed() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
            t.rows[x].cells[2].innerHTML = document.getElementById('inputVagas').value;
        }

        for (var i = 0; i < t.rows.length; i++) {
            t.rows[i].onclick = function () {
                rIndex = this.rowIndex;
                x = rIndex;
            }
        };
    </script>
    <script>
        $(function () {
            $('.size').styleddropdown();
        });
    </script>
@endpush
