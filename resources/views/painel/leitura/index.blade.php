@extends('painel.templates.index')
@section('content')
<!--INDEX LEITURAS-->
<h1 class="titulo-pg-painel">Listagem  de minhas leituras</h1>

<div class="divider"></div>

<div class="col-md-12">

    <form class="form-padrao form-inline padding-20 form-pesquisa" method="POST" send="/painel/leitura/pesquisar/">
        <input type="text" placeholder="Pesquisa" class="texto-pesquisa">
    </form>
    @if(isset($palavraPesquisa))
    <p>Resultados para a busca por: <b>{{$palavraPesquisa}}</b></p>
    @endif
</div>

<table class="table table-hover">
    <tr>
        <th>Livro</th>
        <th>Início</th>
        <th>Páginas</th>
        <th class="botoes_acoes">Ações</th>
    </tr>
    @forelse($data as $leitura)
    <tr>
        <td ><img class="img_lista" alt="" src="{{$leitura->livro->capa}}"> {{$leitura->livro->titulo}}</td>
        <td>{{$leitura->data_inicio}}</td>
        <td>{{$leitura->livro->paginas}}</td>

        <td>
            @if($leitura->lido=="n")
             <a class="lido" onclick="#">
                <i>Lido</i>
            </a>
            @endif
           
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="500">
            Nenhuma leitura!
        </td>
    </tr>

    @endforelse

</table>

<nav>
     {!!$data->render()!!}
</nav>
@endsection