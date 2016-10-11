@extends('auth.templates.index')
<!-- FORMULARIO DE LOGIN--LOGIN.INDEX-->
@section('form') 
<form class="form-padrao form " method="POST" action="/login" send="/login">
    {!!csrf_field()!!}
    <div class="alert alert-danger msg-war" role="alert" style="display: none"></div>
    <div class="alert alert-success msg-suc" role="alert" style="display: none"></div>
    <div class="form-group">
        <input type="text" name="email" class="form-control" placeholder="Email">
    </div>
    <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="Senha">
    </div>    
    <input type="submit" name="btn-enviar" value="Entrar" class="btn btn-primary">
     <a href="/cadastrar" class="btn btn-primary" > Cadastrar</a>
     <a href="/recuperar-senha" class="btn btn-primary" > Nova senha</a>
     <a href="/" class="btn btn-primary" > Voltar</a>
    
</form>
@endsection



@section('scripts')
<script>

    $(function () {

        jQuery('form.form').submit(function () {
            jQuery(".msg-war").hide();

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
                            location.href = "/painel";

                        } else {

                            jQuery(".msg-war").html(data);
                            jQuery(".msg-war").show();
                        }


                    }).fail(function () {

                finalizaPreloader();

                alert("Falha ao enviar dados");
            });
            return false;

        });


    });

    function iniciaPreloader() {

        jQuery(".btn-enviar").attr("disabled");

    }
    function finalizaPreloader() {
        jQuery(".btn-enviar").removeAttr("disabled");
    }

</script>
@endsection