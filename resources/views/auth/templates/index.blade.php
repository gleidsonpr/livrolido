<!DOCTYPE html>
<!-- TEMPLATE PARA FORMULARIOSA DE LOGIN, RECUPERACAO DE SENHA E CADASTRO--TEMPLATES.INDEX-->
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
         <title>Livro Lido</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="{{url('assets/painel/css/livrolido.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('assets/painel/css/livrolido-responsivo.css')}}">

        <!--JQuery-->
        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    </head>
    <body class="bg-padrao">

        <header>
                <h1 class="oculta">Livro-lido</h1>
        </header>

        <section class="login">
            <div class="topo-login">
                    <h1 class="titulo-login">Livro Lido</h1>
            </div>
            <div class="conteudo-login">
                <!--inicio formulario de login-->
            @yield('form')
             <!--fim formulario de login-->
            </div>
        </section>


        {!!HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js')!!}
        @yield('scripts')	
    </body>
</html>