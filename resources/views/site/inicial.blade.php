@extends('site.index')
@section('content_site')
<div class="container" style="margin-top:15px;">
    <div class="row">

        <div class="col-sm-12 col-md-12">

            <div class="col-sm-8">
                <div class="cp-headline-single">
                    <div class="media">
                        <div class="media">
                            <a href="#">
                                <img class="img-responsive media-object" src="http://ecx.images-amazon.com/images/I/516GOU8snHL._SX379_BO1,204,203,200_.jpg" alt="Livro">
                            </a>
                        </div>
                        <div class="media-body" style="color:#000;">
                            <h4>O caderno de viagens de o código da vince</h4>
                            <p>Seguindo os passos de Robert Langdon e Sophie Neveu pela Europa, você pode desvendar os mistérios apresentados no livro que já vendeu mais de 45 milhões 
                                de exemplares em todo o mundo. Este charmoso guia traz um roteiro detalhado de ruas, igrejas, museus e monumentos que os protagonistas 
                                percorre</p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-sm-4">
                <div class="cp-simple-post-items">
                    <h4>+ Recentes</h4>
                    <ul class="media-list">

                        <!--Melhorar essa lógica depois para exibir somente os ultimos cadastrados-->
                        @forelse($livros->slice(0,15) as $livro)
                        <li class="media">
                            <h5>
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <a href="/detalhes/{{$livro->id}}"  >
                                    {{$livro->titulo}}</a>
                            </h5>
                        </li>                              
                        @empty
                        Sem livros cadastrados
                        @endforelse

                    </ul>
                </div>	
            </div>

            <div class="col-sm-3">
                <div class="cp-post-items">
                    <h4>+ Populares</h4>
                    <ul class="media-list">
                        @forelse($livros->slice(0,5) as $livro)
                        <li class="media" style="height: 200px;">
                            <div class="media-left"   >
                                <a href="/detalhes/{{$livro->id}}"  >
                                    <img class="lazy media-object" style="margin-top:30px !important;box-shadow: 0px 1px 10px #000;" src="{{$livro->capa}}" data-original="{{$livro->capa}}" alt="{{$livro->titulo}}">
                                </a>
                            </div>
                            <div class="media-body">
                                <h5>
                                    <a href="/detalhes/{{$livro->id}}">
                                        {{substr($livro->sinopse,0,300)}}
                                    </a>
                                </h5>
                            </div>
                        </li>
                        @empty
                        Sem livros cadastrados
                        @endforelse

                    </ul>
                </div>	
            </div>
            <div class="col-sm-3">
                <div class="cp-post-items">
                    <h4>+ Populares</h4>
                    <ul class="media-list">
                        @forelse($livros->slice(5,5) as $livro)
                        <li class="media" style="height: 200px;">
                            <div class="media-left"   >
                                <a href="/detalhes/{{$livro->id}}"  >
                                    <img class="lazy media-object" style="margin-top:30px !important;box-shadow: 0px 1px 10px #000;" src="{{$livro->capa}}" data-original="{{$livro->capa}}" alt="{{$livro->titulo}}">
                                </a>
                            </div>
                            <div class="media-body">
                                <h5>
                                    <a href="/detalhes/{{$livro->id}}"  >
                                        {{substr($livro->sinopse,0,300)}}
                                    </a>
                                </h5>
                            </div>
                        </li>
                        @empty
                        Sem livros cadastrados
                        @endforelse

                    </ul>
                </div>	
            </div>
            <div class="col-sm-3">
                <div class="cp-post-items">
                    <h4>+ Populares</h4>
                    <ul class="media-list">
                        @forelse($livros->slice(10,5) as $livro)
                        <li class="media" style="height: 200px;">
                            <div class="media-left">
                                <a href="/detalhes/{{$livro->id}}"  >
                                    <img class="lazy media-object" style="margin-top:25px !important; box-shadow: 0px 1px 10px #000;" src="{{$livro->capa}}" data-original="{{$livro->capa}}" alt="{{$livro->titulo}}">
                                </a>
                            </div>
                            <div class="media-body">
                                <h5>
                                    <a href="/detalhes/{{$livro->id}}"  >
                                        {{substr($livro->sinopse,0,300)}}
                                    </a>
                                </h5>
                            </div>
                        </li>
                        @empty
                        Sem livros cadastrados
                        @endforelse

                    </ul>
                </div>	
            </div>
            <div class="col-sm-3">
                <div class="cp-post-items">
                    <h4>+ Populares</h4>
                    <ul class="media-list">
                        @forelse($livros->slice(15,5) as $livro)
                        <li class="media" style="height: 200px;">
                            <div class="media-left">
                               <a href="/detalhes/{{$livro->id}}"  >
                                    <img class="lazy media-object" style="margin-top:25px !important; box-shadow: 0px 1px 10px #000;" src="{{$livro->capa}}" data-original="{{$livro->capa}}" alt="{{$livro->titulo}}">
                                </a>
                            </div>
                            <div class="media-body">
                                <h5>
                                   <a href="/detalhes/{{$livro->id}}"  >
                                        {{substr($livro->sinopse,0,300)}}
                                    </a>
                                </h5>
                            </div>
                        </li>
                        @empty
                        Sem livros cadastrados
                        @endforelse

                    </ul>
                </div>	
            </div>
            <div class="col-sm-12">

                <div class="banner-area" data-type='{"xs":false,"sm":false,"md":"728x90","lg":"728x90"}'></div>

                <div class="cp-post-items">

                    <h4>MAIS LIDOS</h4>

                    <ul class="media-list">
                        @forelse($livros->slice(5,16) as $livro)
                        <li class="media col-sm-6" style="height: 200px;">
                            <div class="media-left">
                               <a href="/detalhes/{{$livro->id}}"  >
                                    <img class="media-object" style="margin-top:25px !important; box-shadow: 0px 1px 10px #000;" src="{{$livro->capa}}" alt="{{$livro->titulo}}">
                                </a>
                            </div>
                            <div class="media-body">
                                <h5>
                                    <a href="/detalhes/{{$livro->id}}"  >
                                        {{substr($livro->sinopse,0,300)}}	
                                    </a>
                                </h5>
                            </div>
                        </li>
                        @empty
                        Sem livros cadastrados
                        @endforelse

                    </ul>
                </div>
            </div>

        </div>

        <div class="hidden-xs hidden-sm col-md-2">
            <style type="text/css">
                .cp-facebook-fanbox { margin-bottom:40px; }

            </style>

            <div class="cp-facebook-fanbox">
                <div class="fb-page" data-href="https://www.facebook.com/livrolido" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"></div>
            </div>
            <div class="banner-area" data-type='{"xs":false,"sm":false,"md":"300x600","lg":"300x600"}'></div>

        </div>

    </div>
</div>
@endsection