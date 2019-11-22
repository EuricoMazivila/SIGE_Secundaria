@extends('Layouts.template_index')
@section('titulo','Index')

@section('corpo')
    <section class="probootstrap-section probootstrap-section-colored">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-left section-heading probootstrap-animate mb0">
                    <h1 class="mb0">Galeria da escola</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="probootstrap-section probootstrap-bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="portfolio-feed three-cols">
                        <div class="grid-sizer"></div>
                        <div class="gutter-sizer"></div>
                        <div class="probootstrap-gallery">
                            <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"
                                class="grid-item probootstrap-animate">
                                <a href="img/ep.jpg" itemprop="contentUrl" data-size="1000x632">
                                    <img src="img/ep.jpg" itemprop="thumbnail"
                                        alt="Free Bootstrap Template by ProBootstrap.com" />
                                </a>
                                <figcaption itemprop="caption description">Alunos no pátio da escola</figcaption>
                            </figure>
                            <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"
                                class="grid-item probootstrap-animate">
                                <a href="img/mawa.jpg" itemprop="contentUrl" data-size="1000x632">
                                    <img src="img/mawa.jpg" itemprop="thumbnail"
                                        alt="Free Bootstrap Template by ProBootstrap.com" />
                                </a>
                                <figcaption itemprop="caption description">Alunos desenvolvendo actividades
                                    extra-curriculares</figcaption>
                            </figure>
                            <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"
                                class="grid-item probootstrap-animate">
                                <a href="img/maths.jpg" itemprop="contentUrl" data-size="1000x632">
                                    <img src="img/maths.jpg" itemprop="thumbnail"
                                        alt="Free Bootstrap Template by ProBootstrap.com" />
                                </a>
                                <figcaption itemprop="caption description">Concurso de matemática para alunos da 10ª e 12ª
                                    classes</figcaption>
                            </figure>
                            <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"
                                class="grid-item probootstrap-animate">
                                <a href="img/slider_2.jpg" itemprop="contentUrl" data-size="1000x667">
                                    <img src="img/slider_2.jpg" itemprop="thumbnail"
                                        alt="Free Bootstrap Template by ProBootstrap.com" />
                                </a>
                                <figcaption itemprop="caption description">Educação é vida</figcaption>
                            </figure>
                            <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"
                                class="grid-item probootstrap-animate">
                                <a href="img/sda.jpg" itemprop="contentUrl" data-size="1000x632">
                                    <img src="img/sda.jpg" itemprop="thumbnail"
                                        alt="Free Bootstrap Template by ProBootstrap.com" />
                                </a>
                                <figcaption itemprop="caption description">Nossas salas de aula</figcaption>
                            </figure>
                            <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"
                                class="grid-item probootstrap-animate">
                                <a href="img/jc.jpg" itemprop="contentUrl" data-size="1000x632">
                                    <img src="img/jc.jpg" itemprop="thumbnail"
                                        alt="Free Bootstrap Template by ProBootstrap.com" />
                                </a>
                                <figcaption itemprop="caption description">Apresentações: Jornadas cientificas 2019
                                </figcaption>
                            </figure>
                            <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"
                                class="grid-item probootstrap-animate">
                                <a href="img/2t.jpeg" itemprop="contentUrl" data-size="1000x632">
                                    <img src="img/2t.jpeg" itemprop="thumbnail" />
                                </a>
                                <figcaption itemprop="caption description">Image caption here</figcaption>
                            </figure>
                            <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"
                                class="grid-item probootstrap-animate">
                                <a href="img/slider_3.jpg" itemprop="contentUrl" data-size="1000x667">
                                    <img src="img/slider_3.jpg" itemprop="thumbnail" />
                                </a>
                                <figcaption itemprop="caption description">Ajudamos cada um dos nossos alunos a aumentar o
                                    seu potencial</figcaption>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
