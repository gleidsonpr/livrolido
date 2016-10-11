@extends('painel.templates.index')
@section('content')
<!--INDEX EMPRESTIMOS-->
<h1 class="titulo-pg-painel">Listagem  dos emprestimos</h1>

<div class="divider"></div>

<div class="col-md-12">

    <form class="form-padrao form-inline padding-20 form-pesquisa" method="POST" send="/painel/emprestimo/pesquisar/">
        <a href="" class="btn-cadastrar" data-toggle="modal" data-target="#modalGestao"><i class="fa fa-plus-circle"></i> Cadastrar</a>
        <input type="text" placeholder="Pesquisa" class="texto-pesquisa">
    </form>
    @if(isset($palavraPesquisa))
    <p>Resultados para a busca por: <b>{{$palavraPesquisa}}</b></p>
    @endif
</div>

<table class="table table-hover">
    <tr>
        <th>Livro</th>
        <th>Usuário</th>        
        <th>Data do Emprestimo</th>
        <th class="botoes_acoes">Ações</th>
    </tr>
    @forelse($data as $emprestimo)
    <tr>
        <td ><img class="img_lista" alt="" src="{{$emprestimo->livro->capa}}"> {{$emprestimo->livro->titulo}}</td>
        <td>{{$emprestimo->user->name}}</td>       
        <td>{{$emprestimo->data_emprestimo}}</td>

        <td>
           

            <a class="info" onclick="#">
                <i>Devolução</i>
            </a>
            
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="500">
            Nenhum emprestimo cadastrado ainda!
        </td>
    </tr>

    @endforelse

</table>

<nav>
    {!!$data->render()!!}
</nav>
<!-- Modal -->


@endsection