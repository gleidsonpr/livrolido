@extends('site.index')
@section('content_site')
<div class="container" style="margin-top:15px;">

    <div class="col-sm-6">
        <div class="cp-headline-single">
            <div class="media">
                <div class="media">
                    <img class="img-responsive media-object"  style="max-height: 500px;" src="{{$livro->capa}}" alt="{{$livro->titulo}}">
                </div>

            </div>

        </div>
    </div>

    <div class="col-sm-6">
        <div class="cp-headline-single">
            <div class="media">

                <div class="media-body" style="color:#000;">
                    <h4>{{$livro->titulo}}</h4>
                    <p>{{$livro->sinopse}}</p>
                    <h4>Páginas: {{$livro->paginas}}</h4>
                    <h4>Isbn: {{$livro->isbn}}</h4>
                    <h4>Ano: {{$livro->ano_lancamento}}</h4>
                    <h4>Autor(es): @forelse($livro->getAutor()->get() as $autor ){{$autor->nome}}@empty Sem autor @endforelse</h4>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection