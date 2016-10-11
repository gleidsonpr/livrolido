@extends('painel.templates.index')
@section('content')
<!--Index Livros-->
<h1 class="titulo-pg-painel">Listagem  dos livros</h1>

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
        <th>Isbn</th>
        <th>Autores</th>
        <th class="botoes_acoes">Ações</th>
    </tr>
    @forelse($livros as $livro)
    <tr>
        <td ><img class="img_lista" alt="" src="{{$livro->capa}}"> {{$livro->titulo}}</td>
        <td>{{$livro->isbn}}</td>
        <td>

            @forelse($livro->getAutor()->get() as $autor )
            {{$autor->nome}} | 

            @empty

            Nenhum autor cadastrado ainda!
        </td>
        @endforelse

        </td>
        <td>
            <a class="edit " onclick="edit('/painel/livro/editar-livro/{{$livro->id}}')">
                <i>Editar</i>
            </a>
            <a class="info " onclick="livro_view('{{$livro->capa}}','{{$livro->titulo}}','{{$livro->paginas}}','{{$livro->isbn}}')">
                <i>Visualizar</i>
            </a>
            <a class="delete " onclick="del('/painel/livro/deletar-livro/{{$livro->id}}')">
                <i >Deletar</i>
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

<!-- Modal -->

<div class="modal fade" id="modalGestao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-backdrop="static" >

    <div class="modal-dialog" role="document" style="width:75%;">
        <div class="modal-content">
            <div class="modal-header bg-padrao4">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Gestão de livros</h4>
            </div>
            <div class="modal-body" style = "overflow: hidden;">
                <form  class="form-horizontal form-gestao" action="/painel/livro/adcionar-livro" send="/painel/livro/adcionar-livro" enctype= "multipart/form-data">
                    {!!csrf_field()!!}
                    <div class="form-group campos_buscar">
                        <label class="col-sm-1">ISBN buscar</label>
                        <div class="col-sm-6"><input type="text" name="isbn_buscar" class="form-control" placeholder="Digite o ISBN para buscar"></div>
                        <div class="col-sm-5"><button type="button" id="btn_buscar_isbn" class="btn btn-default btn_buscar_isbn" >Buscar</button></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-1">Título</label>
                        <div class="col-sm-11"><input type="text" name="titulo" class="form-control" placeholder="Título"></div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2"><input type="text" class="form-control" id="isbn" name="isbn" placeholder="ISBN"><div class="help">ISBN</div></div>
                        <div class="col-sm-2"><input type="text" class="form-control" id="paginas" name="paginas" placeholder="Pág."><div class="help">Páginas</div></div>
                        <div class="col-sm-2"><input type="text" class="form-control" id="ano_lancamento" name="ano_lancamento"><div class="help">Ano de lançamento</div></div>
                        <div class="col-sm-3">{!!Form::select('editora_id',$editoras,null,['class'=>'form-control', 'id'=>'editora_id'])!!}<div class="help">Editora</div></div>
                        <div class="col-sm-3">{!!Form::select('genero_id',$generos,null,['class'=>'form-control', 'id'=>'genero_id'])!!}<div class="help">Gênero</div></div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-1">Link capa</label>
                        <div class="col-sm-11"><input type="text" name="capa" class="form-control" placeholder="Link para a capa do livro"></div>
                    </div>
                    <h5 class="editora-exibir"></h5>
                    <h5 class="autor-exibir"></h5>
                    <div class="form-group">
                        <label class="col-sm-1">Autor(es)</label>
                        <div class="col-sm-5">{!!Form::select('autor_id[]',$autores,null,['class'=>'form-control','multiple', 'id'=>'autor_id','style'=>'height:130px; width:500px;'])!!}</div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-1">Sinópse</label>
                        <div class="col-sm-8"><textarea class="form-control sinopse" rows="5" id="sinopse" name="sinopse"></textarea></div>
                    </div>
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
<div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-backdrop="static" > <!-- Modal view-->

    <div class="modal-dialog" role="document" style="width:45%;">
        <div class="modal-content">
            <div class="modal-header bg-padrao4">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-view-title" id="myModalLabel"></h4>
            </div>

            <div class="modal-body" style = "overflow: hidden;">
                <img name="capa_livro" class="capa_livro img-thumbnail img-responsive " width="204" height="155.484" src="" />
            </div>
            <h4>Páginas:</h4>
            <h4 class="modal-view-paginas"></h4>
            <h4>Isbn:</h4>
            <h4 class="modal-view-isbn"></h4>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div><!-- /Modal view -->
<script>
    function livro_view(capa_livro, titulo, paginas, isbn) {
    jQuery("#modalView").modal();
    jQuery("img[name=capa_livro]").attr("src", capa_livro);
    jQuery(".modal-view-title").html(titulo);
    jQuery(".modal-view-sinopse").html(sinopse);
    jQuery(".modal-view-paginas").html(paginas);
    jQuery(".modal-view-isbn").html(isbn);
    }

    jQuery(".btn_buscar_isbn").click(function () {

    var url = "https://www.googleapis.com/books/v1/volumes?q=isbn:";
    var isbn_buscar = jQuery("input[name='isbn_buscar']").val();
    var url3 = "&fields=items(volumeInfo)&Key=AIzaSyBwuFfWXjlbbJPKk7ZgdkJaeFxQCGFDYkY";
    var url4 = url + isbn_buscar + url3;
    if (isbn_buscar == "")
    { alert("Não foi digitado o ISBN para a consulta"); }
    else{
    jQuery.getJSON(url4, function (data){
    jQuery.each(data.items, function (key, val) {
    jQuery("input[name='titulo']").attr("value", val.volumeInfo.title);
    jQuery("input[name='paginas']").attr("value", val.volumeInfo.pageCount);
    jQuery("input[name='ano_lancamento']").attr("value", val.volumeInfo.publishedDate);
    jQuery("input[name='isbn']").attr("value", isbn_buscar);
    jQuery(".sinopse").html(val.volumeInfo.description);
    jQuery(".editora-exibir").html('<strong>Editora desse livro, valor escolher na lista abaixo: </strong>' + val.volumeInfo.publisher);
    jQuery(".genero-exibir").html('<strong>Gênero desse livro, valor escolher na lista abaixo: </strong>' + val.volumeInfo.categories);
    jQuery(".autor-exibir").html('<strong>Autores desse livro, valor escolher na lista abaixo: </strong>' + val.volumeInfo.authors[0] + '-' + val.volumeInfo.authors[1] + '-' + val.volumeInfo.authors[2]);
    });
    });
    }});


</script>

@endsection

