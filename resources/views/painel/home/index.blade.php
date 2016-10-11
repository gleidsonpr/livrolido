@extends('painel.templates.index')
@section('content')

<h1 class="titulo-pg-painel">Dashboard</h1>

    <div class="divider"></div>

    <div class="conteudo-listagens">
            <div class="relatorio col-md-3">
                <a href="{{url('/painel/meus-livros')}}">  <i class="fa fa-book bg-padrao2 icone-relario"></i></a> <p class="relatorio">Total de livros <br> {{Auth::user()->getlivros()->count()}}</p>
            </div>
            <div class="relatorio col-md-3">
                <a href="{{url('/painel/leitura')}}">  <i class="fa fa-book bg-padrao2 icone-relario"></i></a> <p class="relatorio">Total de Leituras <br> {{Auth::user()->leituras()->count()}}</p>
            </div>
    </div>
				


@endsection