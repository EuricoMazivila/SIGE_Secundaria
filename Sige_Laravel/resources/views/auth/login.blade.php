@extends('Layouts.templete_login')
@section('titulo','Login')

@section('corpo')
    <div class="centro_login">
        <div class="modal-dialog text-center c">
            <div class="col-sm-11 main-section">
                <div class="modal-content form-input" id="principal">
                    <div class="col-12">
                        <div class="col-12 bemVindo">
                            <h2>Bem Vindo</h2>
                            <hr>
                        </div>

                        <form class="col-sm-12" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="us form-row mt-2">
                                <i class="fa fa-user form-group col-1"></i>
                                <input class="form-group col-11 log w-50 @error('email') is-invalid @enderror" id="usuario" type="text" name="email" value="{{ old('email') }}" required placeholder="Insira o Email" >
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="pass form-row mt-4">
                                <i class="fa fa-key form-group col-1"></i>
                                <input class="form-group col-11 log w-50 @error('password') is-invalid @enderror" type ="password" id="password" name="password" required placeholder="Insira a Senha">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                            <button type="submit" id ="entrar" class="btn btn-primary" name="loginPrincipal">Entrar</button>
                        </form> 
                    </div>
                    <div class="col-12 esqueceu">
                        <a href="">Esqueceu Password?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection