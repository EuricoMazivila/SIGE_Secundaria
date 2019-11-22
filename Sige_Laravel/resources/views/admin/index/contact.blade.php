@extends('Layouts.template_index')
@section('titulo','Index')

@section('corpo')
    <section class="probootstrap-section probootstrap-section-colored">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-left section-heading probootstrap-animate">
                    <h1 class="mb0">Contacte-nos</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="probootstrap-section probootstrap-section-sm">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row probootstrap-gutter0">
                        <div class="col-md-4" id="probootstrap-sidebar">
                            <div class="probootstrap-sidebar-inner probootstrap-overlap probootstrap-animate">
                                <h3>Páginas</h3>
                                <ul class="probootstrap-side-menu">

                                    <li><a href="{{route('index')}}">Página Inicial</a></li>
                                    <li><a href="{{route('login')}}">Login</a></li>
                                    <li><a href="{{route('index.events')}}">Eventos</a></li>
                                    <li><a href="{{route('index.about')}}">Sobre nós</a></li>
                                    <li class="active"><a>Contacte-nos</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-7 col-md-push-1  probootstrap-animate" id="probootstrap-content">
                            <h2>Entre em contato</h2>
                            <p>Entre em contato usando o formulário abaixo</p>
                            <form action="#" method="post" class="probootstrap-form">
                                <div class="form-group">
                                    <label for="name">Nome completo</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="subject">Disciplina</label>
                                    <input type="text" class="form-control" id="subject" name="subject">
                                </div>
                                <div class="form-group">
                                    <label for="message">Mensagem</label>
                                    <textarea cols="30" rows="10" class="form-control" id="message"
                                        name="message"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary btn-lg" id="submit" name="submit"
                                        value="Enviar mensagem">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
