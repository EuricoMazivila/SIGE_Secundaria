<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style/estilo_login.css') }}" rel="stylesheet">
    <link href="fontawesome-free-5.8.2-web/css/all.css" rel="stylesheet">

    <title>Login</title>
</head>
<body>
    <div class="modal-dialog text-center c">
        <div class="col-sm-9 main-section">
            <div class="modal-content form-input" id="principal">
                <div class="col-12">
                    <div class="col-12 bemVindo">
                        <h2>Bem Vindo</h2>
                    </div>
                    <form class="col-12" method="POST" action="">
                        <div class="form-group form-group_pr">
                            <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Usuario" name="inputUsuario">
                            
                            @error('email') <!--Para acessar a aplicacao ira-se usar o email ou usuario-->
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group form-group_pr">
                            <input type="password" class="form-control @error('senha') is-invalid @enderror" placeholder="Senha" name="inputSenha">
                            
                            <!--Para mensagem de erro (falha de password ou senha)-->
                            @error('senha')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">
                         {{ __('Login') }}
                        </button>
                    </form> 
                </div>

                <div class="col-12 esqueceu">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Esqueceu Password?') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
<!--
    Deve-se Analisar
    <footer class="fixed-bottom col-md-12"> 
        <div class="container rodape" >
            <div class="row">
                <div class="col-xs-6">
                    <p>2019| &copy SIGA-SECUNDARIA | STUDENTS</p>
                </div>
            </div>
        </div>
    </footer>
-->
<i class="fa fa-save fa-2x"></i>
</body>
</html>