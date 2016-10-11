@extends('painel.templates.index')
@section('content')
<!--INDEX EDITORAS-->
<h1 class="titulo-pg-painel">Listagem  das editoras</h1>

<div class="divider"></div>

<div class="col-md-12">

    <form class="form-padrao form-inline padding-20 form-pesquisa" method="POST" send="/painel/editora/pesquisar/">
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
    @forelse($data as $editora)
    <tr>
        <td>{{$editora->nome}}</td>
        <td>{{$editora->site}}</td>

        <td>
            <a class="edit" onclick="edit('/painel/editora/editar/{{$editora->id}}')">
                <i>Editar</i>
            </a>

            <a class="info" onclick="edit('/painel/editora/editar/{{$editora->id}}')">
                <i>Visualizar</i>
            </a>
            <a class="delete" onclick="del('/painel/editora/deletar/{{$editora->id}}')">
                <i >Deletar</i>
            </a>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="500">
            Nenhum editora cadastrado ainda!
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
                <h4 class="modal-title" id="myModalLabel">Gestão de editoras</h4>
            </div>
            <div class="modal-body">
                <form class="form-padrao form-gestao " action="/painel/editora/adcionar" send="/painel/editora/adcionar" enctype= "multipart/form-data">
                    <div class="form-group">
                        {!!csrf_field()!!}
                        Nome: <input type="text" name="nome" class="form-control" placeholder="Nome">
                    </div>
                    <div class="form-group">
                        Site:  <input type="text" name="site" class="form-control" placeholder="Site">
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