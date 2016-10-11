@extends('painel.templates.index')
@section('content')
<!--Index Autores-->
<h1 class="titulo-pg-painel">Listagem  dos autores</h1>

<div class="divider"></div>

<div class="col-md-12">

    <form class="form-padrao form-inline padding-20 form-pesquisa" method="POST" send="/painel/autor/pesquisar/">
        <a href="" class="btn-cadastrar" data-toggle="modal" data-target="#modalGestao"><i class="fa fa-plus-circle"></i> Cadastrar</a>
        <input type="text" placeholder="Pesquisa" class="texto-pesquisa">
    </form>
    @if(isset($palavraPesquisa))
    <p>Resultados para a busca por: <b>{{$palavraPesquisa}}</b></p>
    @endif
</div>




<table class="table table-hover">
    <tr>
        <th style="width: 250px;">Nome</th>
        <th>Sobre</th>
        <th class="botoes_acoes">Ações</th>
    </tr>
    @forelse($data as $autor)
    <tr>
        <td>{{$autor->nome}}</td>
        <td>{{$autor->sobre}}</td>

        <td>
            <a class="edit" onclick="edit('/painel/autor/editar/{{$autor->id}}')">
                <i>Editar</i>
            </a>
            <a class="info" onclick="edit('/painel/autor/editar/{{$autor->id}}')">
                <i>Visualizar</i>
            </a>
            <a class="delete" onclick="del('/painel/autor/deletar/{{$autor->id}}')">
                <i >Deletar</i>
            </a>

        </td>
    </tr>
    @empty
    <tr>
        <td colspan="500">
            Nenhum autor cadastrado ainda!
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
                <h4 class="modal-title" id="myModalLabel">Gestão de autores</h4>
            </div>
            <div class="modal-body">
                <form class="form-padrao form-gestao " action="/painel/autor/adcionar" send="/painel/autor/adcionar" enctype= "multipart/form-data">
                    <div class="form-group">
                        {!!csrf_field()!!}
                        Nome: <input type="text" name="nome" class="form-control" placeholder="Nome">
                    </div>
                    <div class="form-group">
                        Sobre: <textarea class="form-control sobre" rows="5" id="sobre" name="sobre"></textarea>
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


 
