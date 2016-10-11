<!DOCTYPE html> 
<html lang="pt-br">
    <!--TEMPLATE DA GESTAO DE CONTEÚDO-->
    <head>
        <meta charset="UTF-8">
        <title>{{$titulo or 'Livro Lido'}}</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="{{url('assets/painel/css/livrolido.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('assets/painel/css/livrolido-responsivo.css')}}">

        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    </head>
    <body class="bg-padrao">

        <section class="painel">
            <h1 class="oculta">Painel | Livro-lido</h1>

            <div class="topo-painel col-md-12">
                <select class="acoes-painel">
                    <option value="logado">{{ Auth::user()->name }}</option>
                    <option value="sair" class="sair">Sair</option>
                </select>
            </div>
            <!--End Top-->

            <div class="clear"></div>

            <!--inicio menu-->
            @include('painel.includes.menu')
            <!--End menu-->

            <section class="conteudo col-md-10">
                <div class="cont">
                    @yield('content')	
                </div>
            </section>
            <!--End ConteÃºdo-->


        </section>
        <!-- Modal Para deletar-->
        <div class="modal fade" id="modalConfirmacaoDeletar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-padrao5">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Deletar</h4>
                    </div>
                    <div class="modal-body">
                        {!!Form::hidden('url-deletar',null,['class'=>'url-deletar'])!!}

                        <p>Deseja realmente deletar?</p>
                        <div class="preloader-deletar" style="display: none;"> <i class="fa fa-refresh fa-spin"></i> Deletando...</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger btn-confirmar-deletar">Deletar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fim Modal Para deletar-->
        <!-- Modal Para  termino leitura-->
        <div class="modal fade" id="modalConfirmacaoLeitura" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-padrao5">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Confirmar</h4>
                    </div>
                    <div class="modal-body">
                        {!!Form::hidden('url-confirmarleitura',null,['class'=>'url-confirmarleitura'])!!}

                        <p>Confirmar o término da leitura</p>
                        <div class="preloader-deletar" style="display: none;"> <i class="fa fa-refresh fa-spin"></i> Deletando...</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger btn-confirmar-leitura">Confirmar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fim Modal Para termino leitura-->

<!--<script src="assets/js/bootstrap.min.js"></script>-->
        {!!HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js')!!}

        @yield('scripts')
        <script>

    $(function () {

        jQuery("form.form-gestao").submit(function () {



            jQuery(".msg-war").hide();
            jQuery(".msg-suc").hide();

            var dadosForm = jQuery(this).serialize();
            jQuery.ajax({
                url: jQuery(this).attr("send"),
                data: dadosForm,
                type: "POST",
                beforeSend: iniciaPreloader()

            })

                    .done(function (data) {
                        finalizaPreloader();

                        if (data == 1) {

                            jQuery(".msg-suc").html("Sucesso");
                            jQuery(".msg-suc").show();
                            setTimeout("jQuery('.msg-suc').hide();jQuery('#modalGestao').modal('hide');location.reload();", 1500);
                            //ver depois se deixa fechando sozinho ou nao

                        } else {

                            jQuery(".msg-war").html(data);
                            jQuery(".msg-war").show();

                            setTimeout("jQuery('.msg-war').hide();", 9500);
                        }


                    }).fail(function () {

                finalizaPreloader();

                alert("Falha inesperada");
            });
            return false;

        });


    });

    function iniciaPreloader() {
        jQuery(".preloader").show();

    }
    function finalizaPreloader() {
        jQuery(".preloader").hide();
    }
    function edit(url) {
        jQuery(".campos_buscar").hide();
        jQuery.getJSON(url, function (data) {
            jQuery.each(data, function (key, val) {

                if (key == 'sinopse') {
                    jQuery(".sinopse").html(val);
                }
                if (key == 'sobre') {
                    jQuery(".sobre").html(val);
                }
                jQuery("input[name='" + key + "']").attr("value", val);

                if(key=='editora_id'){
                if (jQuery("#editora_id option[value='" + val + "']").val() == val) {
                    jQuery("#editora_id option[value='" + val + "']").attr("selected", true);
                }}
                if(key=='genero_id'){
                if (jQuery("#genero_id option[value='" + val + "']").val() == val) {
                    jQuery("#genero_id option[value='" + val + "']").attr("selected", true);
                }}
            });

        });

        jQuery("#modalGestao").modal();
        jQuery("form.form-gestao").attr("send", url);
        jQuery("form.form-gestao").attr("action", url);
    }

    

    function del(url) {
        jQuery(".url-deletar").val(url);
        jQuery("#modalConfirmacaoDeletar").modal();

    }
    function fimLeitura(url) {
        jQuery(".url-confirmarleitura").val(url);
        jQuery("#modalConfirmacaoLeitura").modal();

    }
    jQuery(".btn-confirmar-deletar").click(function () {
        var url = jQuery(".url-deletar").val();

        jQuery.ajax({
            url: url,
            type: "GET",
            beforeSend: iniciaPreloaderDeletar()


        }).done(function (data) {
            finalizaPreloaderDeletar();
            if (data == 1) {
                location.reload();
            } else {
                alert("Falha ao deletar");
            }


        }).fail(function () {
            finalizaPreloaderDeletar();
            alert("Falha inesperada ao tentar deletar");
        });
    });
    jQuery(".btn-confirmar-leitura").click(function () {
        
        var url = jQuery(".url-confirmarleitura").val();

        jQuery.ajax({
            url: url,
            type: "GET",
            beforeSend: iniciaPreloaderDeletar()


        }).done(function (data) {
            finalizaPreloaderDeletar();
            if (data == 1) {
                location.reload();
            } else {
                alert("Falha ao confirmar leitura");
            }


        }).fail(function () {
            finalizaPreloaderDeletar();
            alert("Falha inesperada ao confirmar leitura");
        });
    });


    function iniciaPreloaderDeletar() {
        jQuery(".preloader-deletar").show();
    }
    function finalizaPreloaderDeletar() {
        jQuery(".preloader-deletar").hide();
    }

    jQuery("form.form-pesquisa").submit(function () {

        var textoPesquisa = jQuery(".texto-pesquisa").val();
        var url = jQuery(this).attr("send");
        location.href = url + textoPesquisa;
        return false;
    });
    jQuery(".acoes-painel").change(function () {

    if(jQuery(this).val()=="sair")
    {
        location.href="{{url('/logout')}}";
    }
    });
//    jQuery(".btn-cadastrar").click(function(){
//       jQuery("form.form-gestao").attr("send",urlAdd);
//       jQuery("form.form-gestao").attr("action",urlAdd);
//       jQuery(":input[type='text']").attr("values",""); resetar os campos
//    });
$('#modalGestao').on('hidden.bs.modal', function (e) {
 location.reload();
})
        </script>
    </body>
</html>


