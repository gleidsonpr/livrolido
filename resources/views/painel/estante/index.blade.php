@extends('painel.templates.index')<!--Index Estante-->
@section('content')
<h1 class="titulo-pg-painel">Livros para adicionar na minha estante</h1>

<div class="divider"></div>

<div class="col-md-12">

    <form class="form-padrao form-inline padding-20 form-pesquisa" method="POST" send="/painel/estante/pesquisar/">
        <input type="text" placeholder="Pesquisa" class="texto-pesquisa">
    </form>
    @if(isset($palavraPesquisa))
    <p>Resultados para a busca por: <b>{{$palavraPesquisa}}</b></p>
    @endif
</div>


<table class="table table-hover">
    <tr>
        <th>Título</th>
        <th class="botoes_acoes">Ações</th>
    </tr>
    @forelse($livros as $livro)
    <tr>
        <td ><img class="img_lista" alt="" src="{{$livro->capa}}"> {{$livro->titulo}}</td>
        
        <td>
            <a class="tenho" onclick="cad_estante('/painel/estante/adcionar-livro-estante','{{$livro->id}}','{{$livro->capa}}','{{$livro->titulo}}')">
                <i>Eu tenho</i>
            </a>
        </td>
    </tr>

    @empty
    <tr>
        <td colspan="500">
            Nenhum livro cadastrado ainda!
        </td>
    </tr>

    @endforelse

</table>

<nav>
    {!!$livros->render()!!}
</nav>

<!-- Modal cadastro na minha estante-->
<div class="modal fade" id="modalCadastroEstante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-backdrop="static" >


    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-padrao4">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Cadastrar o livro na estante</h4>
            </div>
            <div class="modal-body">
                <h2 class="dados-compra"></h2>
                <form role="form" class="form-horizontal form-gestao " action="" send="">
                    {!!csrf_field()!!}
                    <div class="form-group">
                        <label class="col-sm-1" for="loja">Loja</label>
                        <div class="col-sm-5"> {!!Form::select('loja_id',$lojas,isset($estante->livro_id)? $estante->livro_id:null,['class'=>'form-control ',])!!}</div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12">Detalhes da compra</label>
                        <div class="col-sm-3"><input type="text" class="form-control" id="preco" name="preco" placeholder="00.00"><div class="help">Preço</div></div>
                        <div class="col-sm-3"><input type="text" class="form-control" id="nota_fiscal" name="nota_fiscal" placeholder="000"><div class="help">Nota fiscal</div></div>
                        <div class="col-sm-4"><input type="date" class="form-control" id="data_compra" name="data_compra" placeholder="1111"><div class="help">Data de compra</div></div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-12" for="Observações">Observações</label>
                        <div class="col-sm-12"><textarea class="form-control" id="observacoes" name="observacoes"></textarea></div>
                    </div>
                    <input  class="livro_id" name="livro_id" type="hidden" value="">
                    <input  name="user_id" type="hidden" value="{{Auth::user()->id}}">
                    <div class="form-group">
                        <div class="col-sm-6">
                            @include('painel.includes.preloader')
                            <div class="alert alert-danger msg-war" role="alert" style="display: none"></div>
                            <div class="alert alert-success msg-suc" role="alert" style="display: none"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div><!-- /Modal cadastro na minha estante-->
<script>
    function cad_estante(url, livro_id, capa_livro, titulo) {
    jQuery("#modalCadastroEstante").modal();
    jQuery("form.form-gestao").attr("send", url);
    jQuery("form.form-gestao").attr("action", url);
    jQuery("input[name=livro_id]").attr("value", livro_id);
    jQuery("img[name=capa_livro]").attr("src", capa_livro);
    jQuery(".dados-compra").html(titulo);
    }
</script>


@endsection

