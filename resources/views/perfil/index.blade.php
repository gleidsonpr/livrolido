<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Livro Lido | Perfil</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <style>    
            /* Set black background color, white text and some padding */
            footer {
                background-color: #555;
                color: white;
                padding: 15px;
            }
        </style>
    </head>
    <body>

        <nav class="navbar navbar-default">
            <div class="container-fluid">
                
                    <ul class="nav navbar-nav">
                        <li><a href="/">Home</a></li>
                        <li><a href="/painel">Painel</a></li>
                    </ul>
            </div>
        </nav>

        <div class="container text-center">    
            <div class="row">
                <div class="col-sm-2 well">
                    {{$usuario_atual->name }}
                    <div class="well">
                        <a href="" class="btn-cadastrar" data-toggle="modal" data-target="#modalGestaoFoto">
                            <img src="{{url( $usuario_atual->foto) }}" class="img-circle" height="100" width="100" alt="Trocar foto"></a>
                            </div>
                            <div class="well">
                                <p><a href="#">Assuntos</a></p>
                                <p>
                                    <a href="#"><span class="label label-default">Lendo</span></a>
                                    <a href="#"><span class="label label-primary">Suspense</span></a>
                                    <a href="#"><span class="label label-success">Terror</span></a>
                                    <a href="#"><span class="label label-info">Comédia</span></a>
                                    <a href="#"><span class="label label-warning">Bibliografia</span></a>
                                    <a href="#"><span class="label label-danger">Infantil</span></a>
                                </p>
                            </div>
                            @if($errors->any())
                        <div class="alert alert-danger fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p><strong>Erros encontrados</strong></p>
                            {{$errors->first()}}
                        </div>
                        @endif
<!--                            <div class="alert alert-success fade in">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <p><strong>Olá!</strong></p>
                                Essa mensagem vai aparecer quando você tiver alguma novidade.
                            </div>-->
                            <p><a href="#">Facebook</a></p>
                    </div>
                    <div class="col-sm-8">
<!--                        <div class="row">
                            <div class="col-sm-12">
                                <div class="panel panel-default text-left">
                                    <div class="panel-body">
                                        <p contenteditable="true">Status: Feeling Blue</p>
                                        <button type="button" class="btn btn-default btn-sm">
                                            <span class="glyphicon glyphicon-thumbs-up"></span> Like
                                        </button>     
                                    </div>
                                </div>
                            </div>
                        </div>-->

                        @forelse($meusLivros as $livro)
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="well">
                                    <p>{{$livro->titulo}}</p>
                                    <img src="{{$livro->capa}}" class="img-responsive" max-height="55px" max-width="55px" alt="Avatar">
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="well">
                                    <p>{{$livro->sinopse}}</p>
                                </div>
                            </div>
                        </div>
                        @empty
                        Nenhum livro cadastrado ainda!
                        @endforelse
                        {!!$meusLivros->render()!!}
                    </div>
                    <div class="col-sm-2 well">
                        @forelse($leituras as $livro)
                        <div class="thumbnail">
                            <p>Estou lendo</p>
                            <img src="{{$livro->capa}}" alt="{{$livro->titulo}}" width="400" height="300">
                            <p><strong>{{$livro->titulo}}</strong></p>
                            <p>{{$livro->paginas}} páginas</p>
                            <button class="btn btn-primary">Info</button>
                        </div>
                        @empty
                        Nenhuma leitura iniciada
                        @endforelse
                        
                    </div>
                </div>
            </div>
            <nav>
                <nav>
                    
                </nav>
            </nav>
            <footer class="container-fluid text-center">
                <p>Leia sempre e conquiste o mundo!</p>
            </footer>
        <!-- Modal -->
            <div class="modal fade" id="modalGestaoFoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-padrao4">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Trocar foto</h4>
                        </div>
                        <div class="modal-body" style = "overflow: hidden;">
                            <div class="alert alert-warning msg-war" role="alert" style="display: none"></div>
                            <form  class="form-padrao form-gestao" method="post" action="/perfil/{{$usuario_atual->user}}/upload-foto-perfil" send="/perfil/{{$usuario_atual->user}}/upload-foto-perfil" enctype="multipart/form-data">
                                <fieldset>
                                    <div class="form-group">
                                        {!!csrf_field()!!}
                                        <input  name="user" type="hidden" value="{{$usuario_atual->user}}">
                                        <input type="file" name="image" class="form-control">
                                    </div>

                                </fieldset>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </body>
</html>
