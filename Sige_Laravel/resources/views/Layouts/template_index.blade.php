<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo') &mdash;</title>

    <link href="{{ asset('https://fonts.googleapis.com/css?family=Raleway:300,400,500,700|Open+Sans')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('index/css/styles-merged.css')}}">
    <link rel="stylesheet" href="{{ asset('index/css/style.min.css')}}">
    <link rel="stylesheet" href="{{ asset('index/css/custom.css')}}">
</head>

<body>
    <div class="probootstrap-search" id="probootstrap-search">
        <a href="#" class="probootstrap-close js-probootstrap-close"><i class="icon-cross"></i></a>
        <form action="#">
            <input type="search" name="s" id="search" placeholder="Pesquisar">
        </form>
    </div>

    <div class="probootstrap-page-wrapper">
        <!-- Fixed navbar -->
        <div class="probootstrap-header-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-9 probootstrap-top-quick-contact-info">
                        <span><i class="icon-location2"></i>Endereço da escola</span>
                        <span><i class="icon-phone2"></i>Telefone da escola</span>
                        <span><i class="icon-mail"></i>Email da escola</span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 probootstrap-top-social">
                        <ul>
                            <li><a href="#"><i class="icon-twitter"></i></a></li>
                            <li><a href="#"><i class="icon-facebook2"></i></a></li>
                            <li><a href="#"><i class="icon-instagram2"></i></a></li>
                            <li><a href="#"><i class="icon-youtube"></i></a></li>
                            <li><a href="#" class="probootstrap-search-icon js-probootstrap-search"><i
                                        class="icon-search"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-default probootstrap-navbar">
            <div class="container">
                <div class="navbar-header">
                    <!--<h3>SIGE</h3> -->
                    <img src="img/logo1.jpg" width="18%; height:2%;">
                </div>

                <div id="navbar-collapse" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="{{route('index')}}">Página Inicial</a></li>
                        <li><a href="{{route('index.events')}}">Eventos</a></li>
                        <li><a href="{{route('login')}}">SIGE</a></li>
                        <!--
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle">SIGE</a>
                            <ul class="dropdown-menu">
                                <li><a href="Autenticacao/Login/Login_Principal.php">Login</a></li>
                                <li><a href="Autenticacao/Login/Login_Principal.php">Pré-matrícula</a></li>
                            </ul>
                        </li>
                        -->

                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle">Páginas</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('index.about')}}">Sobre nós</a></li>
                                <li><a href="{{route('index.gallery')}}">Galeria</a></li>
                                <li><a href="{{route('index.news')}}">Notícias</a></li>
                            </ul>
                        </li>
                        <li><a href="{{route('index.contact')}}">Contacte-nos</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div>
            @yield('corpo')
        </div>

        <section class="probootstrap-cta" style="background:  #126b7b">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="probootstrap-animate" data-animate-effect="fadeInRight">Faça já a sua pré-matrícula!
                        </h2>
                        <a href="{{route('login')}}" role="button"
                            class="btn btn-primary btn-lg btn-ghost probootstrap-animate"
                            data-animate-effect="fadeInLeft">Pré-matrícula</a>
                    </div>
                </div>
            </div>
        </section>
        <footer class="probootstrap-footer probootstrap-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="probootstrap-footer-widget">
                            <h3>Sobre a escola</h3>
                            <p>Escola é uma instituição que fornece o processo de ensino para discentes (alunos), com o
                                objectivo de formar e desenvolver cada indivíduo em seus aspectos cultural, social e
                                cognitivo.</p>
                            <h3>Social</h3>
                            <ul class="probootstrap-footer-social">
                                <li><a href="#"><i class="icon-twitter"></i></a></li>
                                <li><a href="#"><i class="icon-facebook"></i></a></li>
                                <li><a href="#"><i class="icon-github"></i></a></li>
                                <li><a href="#"><i class="icon-dribbble"></i></a></li>
                                <li><a href="#"><i class="icon-linkedin"></i></a></li>
                                <li><a href="#"><i class="icon-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-md-push-1">
                        <div class="probootstrap-footer-widget">
                            <h3>Links</h3>
                            <ul>
                                <li><a href="#">Página Inicial</a></li>
                                <li><a href="{{route('login')}}">Login</a></li>
                                <li><a href="{{route('index.news')}}">Notícias</a></li>
                                <li><a href="{{route('index.contact')}}">Contacte-nos</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="probootstrap-footer-widget">
                            <h3>Contactos</h3>
                            <ul class="probootstrap-contact-info">
                                <li><i class="icon-location2"></i> <span>Endereço da escola</span></li>
                                <li><i class="icon-mail"></i><span>Email da escola</span></li>
                                <li><i class="icon-phone2"></i><span>Telefone da escola</span></li>
                            </ul>
                        </div>
                    </div>

                </div>
                <!-- END row -->
            </div>

            <div class="probootstrap-copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 text-center">
                            <p>&copy;Copyright <?php echo date('Y');?> | SIGE </p>
                        </div>
                        <div class="col-md-4 probootstrap-back-to-top">
                            <p><a href="#" class="js-backtotop">Voltar para o topo<i class="icon-arrow-long-up"></i></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- END wrapper -->

    <script src="{{ asset('index/js/scripts.min.js')}}"></script>
    <script src="{{ asset('index/js/main.min.js')}}"></script>
    <script src="{{ asset('index/js/custom.js')}}"></script>
</body>
</html>
