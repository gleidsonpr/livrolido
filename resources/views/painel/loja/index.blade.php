@extends('painel.templates.index')
@section('content')
<!--INDEX LOJAS-->
<h1 class="titulo-pg-painel">Listagem  das lojas</h1>

<div class="divider"></div>

<div class="col-md-12">

    <form class="form-padrao form-inline padding-20 form-pesquisa" method="POST" send="/painel/loja/pesquisar/">
        <a href="" class="btn-cadastrar" data-toggle="modal" data-target="#modalGestao"><i class="fa fa-plus-circle"></i> Cadastrar</a>
        <input type="text" placeholder="Pesquisa" class="texto-pesquisa">
    </form>
    @if(isset($palavraPesquisa))
    <p>Resultados para a busca por: <b>{{$palavraPesquisa}}</b></p>
    @endif
</div>

<table class="table table-hover">
    <tr>
        <th>Nome</th>
        <th>Site</th>
        <th class="botoes_acoes">Ações</th>
    </tr>
    @forelse($data as $loja)
    <tr>
        <td>{{$loja->nome}}</td>
        <td>{{$loja->site}}</td>

        <td>
            <a class="edit" onclick="edit('/painel/loja/editar/{{$loja->id}}')">
                <i>Editar</i>
            </a>
            <a class="info" onclick="edit('/painel/loja/editar/{{$loja->id}}')">
                <i>Visualizar</i>
            </a>
            <a class="delete" onclick="del('/painel/loja/deletar/{{$loja->id}}')">
                <i >Deletar</i>
            </a>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="500">
            Nenhuma loja cadastrado ainda!
        </td>
    </tr>

    @endforelse

</table>

<nav>
    {!!$data->render()!!}
</nav>
<!-- Modal -->
<div class="modal fade" id="modalGestao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-padrao4">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Gestão de lojas</h4>
            </div>
            <div class="modal-body">
                <form class="form-padrao form-gestao " action="/painel/loja/adcionar" send="/painel/loja/adcionar" enctype= "multipart/form-data">
                    <div class="form-group">
                        {!!csrf_field()!!}
                        Nome:<input type="text" name="nome" class="form-control" placeholder="Nome">
                    </div>
                    <div class="form-group">
                        Site:<input type="text" name="site" class="form-control" placeholder="Site">
                    </div>
                    @include('painel.includes.preloader')
                    <div class="alert alert-danger msg-war" role="alert" style="display: none"></div>
                    <div class="alert alert-success msg-suc" role="alert" style="display: none"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection