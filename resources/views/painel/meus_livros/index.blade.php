@extends('painel.templates.index')
@section('content')
<!--INDEX MEUS LIVROS-->
<h1 class="titulo-pg-painel">Listagem  dos meus livros</h1>

<div class="divider"></div>

<div class="col-md-12">

    <form class="form-padrao form-inline padding-20 form-pesquisa" method="POST" send="/painel/livro/pesquisar/">
        <a href="" class="btn-cadastrar" data-toggle="modal" data-target="#modalGestao"><i class="fa fa-plus-circle"></i> Cadastrar</a>
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
    @forelse($meus_livros as $livro)
    <tr>
       <td ><img class="img_lista" alt="" src="{{$livro->capa}}"> {{$livro->titulo}}</td>
        <td>
    <a class="lido" onclick="fimLeitura('/painel/leitura/fim-leitura/{{$livro->id}}')">
                <i>Lido</i>
        </a>
        <a class="emprestimo" onclick="cad_emprestimo('/painel/emprestimo/adcionar',{{$livro->id}},'{{$livro->capa}}','{{$livro->titulo}}')">
                <i>Emprestado</i>
            </a>
            <a class="lendo" onclick="cad_leitura('/painel/leitura/adcionar',{{$livro->id}},'{{$livro->capa}}','{{$livro->titulo}}')">
                <i >Lendo</i>
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
    {!!$meus_livros->render()!!}
</nav>

<!-- Modal -->
<div class="modal fade" id="modalGestaoEmprestimo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-backdrop="static" >
<div class="modal-dialog"  role="document" style="width:50%;">
        <div class="modal-content">
            <div class="modal-header bg-padrao4">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Gestão de empréstimo</h4>
            </div>
            <div class="modal-body">
                <h2 class="dados-emprestimo"></h2> 
                <form role="form" class="form-horizontal form-gestao " action="" send="">
                    {!!csrf_field()!!}
                    <div class="form-group">
                        <div class="col-sm-4"><input type="date" class="form-control" id="data_emprestimo" name="data_emprestimo" ><div class="help">Data do empréstimo</div></div>
                        <div class="col-sm-4"><input type="date" class="form-control" id="data_devolucao" name="data_devolucao" ><div class="help">Data da devolução</div></div>
                        <div class="col-sm-4">{!!Form::select('user_id',$usuarios,isset($emprestimo->user_id)? $emprestimo->user_id:null,['class'=>'form-control'])!!}<div class="help">Usuário</div></div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="observacoes" name="observacoes"><div class="help">Observações</div>
                            
                        </div>
                    </div>
                    <input  class="livro_id" name="livro_id" type="hidden" value="">
                    <input  class="dono_livro_id" name="dono_livro_id" type="hidden" value="{{Auth::user()->id}}">
                    <img name="capa_livro" class="capa_livro img-thumbnail img-responsive " width="100" height="131" src="" />
                    <div class="form-group">
                        <div class="col-sm-12">
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

</div>
<!--Modal cadastro de leituras-->
<div class="modal fade" id="modalGestaoLeitura" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-backdrop="static" >
    <div class="modal-dialog"  role="document" style="width:50%;">
        <div class="modal-content">
            <div class="modal-header bg-padrao4">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Cadastrar leituras</h4>
            </div>
            <div class="modal-body">
                <h2 class="dados-leitura"></h2>
                <form role="form" class="form-horizontal form-gestao " action="" send="">
                    {!!csrf_field()!!}
                    <div class="form-group">
                        <div class="col-sm-4"><input type="date" class="form-control" id="data_inicio" name="data_inicio" ><div class="help">Data de início</div></div>
                        <div class="col-sm-4"><input type="date" class="form-control" id="data_termino" name="data_termino" ><div class="help">Data de término</div></div>
                        <div class="col-sm-4"><input type="text" class="form-control" id="observacoes" name="observacoes"><div class="help">Observações</div></div>
                    </div>
                    <input  class="livro_id" name="livro_id" type="hidden" value="">
                    <input class="user_id" name="user_id" type="hidden" value="{{Auth::user()->id}}">
                    <img name="capa_livro" class="capa_livro img-thumbnail img-responsive " width="100" height="131" src="" />
                    <div class="form-group">
                        <div class="col-sm-12">
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

</div>
@endsection
<script>
    function cad_emprestimo(url, livro_id, capa_livro, titulo) {
    jQuery("#modalGestaoEmprestimo").modal();
    jQuery("form.form-gestao").attr("send", url);
    jQuery("form.form-gestao").attr("action", url);
    jQuery("input[name=livro_id]").attr("value", livro_id);
    jQuery("img[name=capa_livro]").attr("src", capa_livro);
    jQuery(".dados-emprestimo").html(titulo);
    }
    function cad_leitura(url, livro_id, capa_livro, titulo) {
    jQuery("#modalGestaoLeitura").modal();
    jQuery("form.form-gestao").attr("send", url);
    jQuery("form.form-gestao").attr("action", url);
    jQuery("input[name=livro_id]").attr("value", livro_id);
    jQuery("img[name=capa_livro]").attr("src", capa_livro);
    jQuery(".dados-leitura").html(titulo);
    }

</script>
