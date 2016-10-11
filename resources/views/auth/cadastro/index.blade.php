@extends('auth.templates.index')

@section('form') 
<!-- FORMULARIO DE CADASTRO DO USUARIO--CADASTRO.INDEX-->
<div class="cadastro">
    <div class="alert alert-warning msg-war" role="alert" style="display: none"></div>
    <div class="alert alert-success msg-suc" role="alert" style="display: none"></div>
    <form class="form-padrao form-cadastro-usuario" method="POST" action="/cadastrar">
        {!!csrf_field()!!}
        <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Nome">
        </div>
        <div class="form-group">
            <input type="text" name="user" class="form-control" placeholder="Usuário">
        </div>
        <div class="form-group">
            <input type="text" name="email" class="form-control" placeholder="Email">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Senha">
        </div>
        <div class="form-group">
            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmar a senha">
        </div>
        <input type="submit" name="btn-cadastrar-usuario" value="Cadastrar" class="btn btn-primary">
        <a href="/login" class="btn btn-primary" > Entrar</a>
        <a href="/" class="btn btn-primary" > Voltar</a>
        
    </form>
</div>
@endsection
@section('scripts')
<script>
    $(function () {

        jQuery("form.form-cadastro-usuario").submit(function () {



            jQuery(".msg-war").hide();
            jQuery(".msg-suc").hide();

            var dadosForm = jQuery(this).serialize();
            jQuery.ajax({
                url: jQuery(this).attr("send"),
                data: dadosForm,           type: "POST",
            })

                    .done(function (data) {


                        if (data == 1) {

                            jQuery(".msg-suc").html("Sucesso");
                            jQuery(".msg-suc").show();
                            setTimeout("jQuery('.msg-suc').hide();location.reload();", 1500);
                            //ver depois se deixa fechando sozinho ou nao

                        } else {

                            jQuery(".msg-war").html(data);
                            jQuery(".msg-war").show();

                            setTimeout("jQuery('.msg-war').hide();", 9500);
                        }


                    }).fail(function () {



                alert("Falha inesperada");
            });
            return false;

        });


    });
</script>
@endsection