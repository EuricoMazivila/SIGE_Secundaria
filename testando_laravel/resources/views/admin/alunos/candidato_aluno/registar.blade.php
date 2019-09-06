<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <script src="{{ asset('js/jquery.js')}}"></script>
    <script src="{{ asset('js/bootstrap.js')}}"></script>

    <title>Registar candidato</title>
</head>
<body>
<div class="container mt-5">
    <form method="POST" role="form" action="{{ route('salvar') }}">
        {{ csrf_field() }}

        <div class="form-row">
            <div class="form-group col-sm-5">
                <label for="digitNome">Nome</label>
                <input type="text" name="nome" id="digitNome" class="form-control" required
                    placeholder="Introduza o Apelido">
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group col-sm-5 offset-sm-2">
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
            <div class="form-group col-sm-5">
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
            <div class="form-group col-sm-5 offset-sm-2">
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
            <div class="form-group col-sm-5">
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
            <div class="form-group col-sm-5 offset-sm-2">
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
            <div class="form-group col-sm-5 ">
                <label>Escola de origem</label>
                <select class="form-control" name="escola">
                    <option>Escola Secundaria Joaquim Chissano</option>
                    <option>Escola Secundaria Herois Mocambicanos</option>
                    <option>Escola Secundaria Quisse Mavota</option>
                    <option>Escola Secundaria Santa Montanha</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-2">
                <a class="btn btn-danger btn-block" href="{{ route('candidato') }}"> <i class="fa fa-window-close"></i>Cancelar</a>
            </div>
            <div class="form-group col-2 offset-1">
                <button class="btn btn-success btn-block" name="salvar"><i class="fa fa-save"></i>Salvar</button>
            </div>
        </div>
    </form>
</div>

</body>
</html>