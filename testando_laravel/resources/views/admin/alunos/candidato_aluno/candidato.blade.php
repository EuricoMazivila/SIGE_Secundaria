<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>

    <title>Candidato</title>
</head>
<body>
<div class="container mt-5">
    <div class="mt-3 table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Classe Anterior</th>
                    <th>Classe Matricular</th>
                    <th>Turno</th>
                    <th>CodEscola</th>
                    <th>Senha</th>
                    <th>Estado</th>
                    <th>Ano</th>
                </tr>
            </thead>
            <tbody>
                @foreach($candidatos as $candidato)
                <tr>
                    <td>{{$candidato->codCand}}</td>
                    <td>{{$candidato->nome_completo}}</td>
                    <td>{{$candidato->classe_anterior}}</td>
                    <td>{{$candidato->classe_matricular}}</td>
                    <td>{{$candidato->turno}}</td>
                    <td>{{$candidato->codEscola}}</td>
                    <td>{{$candidato->senha}}</td>
                    <td>{{$candidato->estado}}</td>
                    <td>{{$candidato->ano}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <a class="btn btn-success" href="{{ route('candidato.registar') }}">Adicionar</a>
</div>

</body>
</html>