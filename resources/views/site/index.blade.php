<!DOCTYPE html> <!--INDEX DO LIVRO LIDO-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Livro Lido- Controle os seus livros</title>
    <!-- Bootstrap -->
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../assets/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
</head>
<style>

    .banner-728x90 { width:728px; height: 90px; margin:30px auto; } 

html,body {height:100%;}
.ft_livro_lido {
	position:absolute;
	bottom:0;
	width:100%;
}
.tudo {
	min-height:100%;
	position:relative;
	width:100%;
}
    .fixed-300x600 { position: fixed; top:0; }
    body.xs .banner-300x250 { width:300px; margin:0 auto; }



</style>
<style type="text/css">
    /* Extra small devices (phones, less than 768px) */
    @media screen and (orientation:portrait){
        /* Portrait styles */
        /*hide your main content and display message */

        .navbar-header {
            float: none;
        }
        .navbar-toggle {
            display: block;
        }
        .navbar-collapse {
            border-top: 1px solid transparent;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);
        }
        .navbar-collapse.collapse {
            display: none!important;
        }
        .navbar-nav {
            float: none!important;
            margin: 7.5px -15px;
        }
        .navbar-nav>li {
            float: none;
        }
        .navbar-nav>li>a {
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .navbar-collapse.collapse.in{
            display: block!important;}
    }
    /* Small devices (tablets, 768px and up) */
    @media (min-width: 768px) {

        .cp-top .navbar-toggle { margin-top: 20px; }
    }
</style>
<div class="tudo ">
<div class="container-fluid">

    <header class="cp-top row">

        <div class="container">

            <div class="hidden-xs col-sm-2">
                <a href="/" alt="#"><img class="logo" height="116" src="../../../assets/painel/img/logo/livro-lido.png" /></a>

            </div>

            <div class="col-sm-10">
                <h2> A sua rede de leituras </h2>
                @if($errors->any())
                <div class="alert alert-danger fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <p><strong>{{$errors->first()}}</strong></p>
                    Ahh não encontramos o usuário em nossos registros
                </div>
                @endif
                <div class="cp-menu">
                    <nav class="navbar navbar-default">

                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="hidden-sm hidden-md hidden-lg navbar-brand" href="/">Dicas de livros</a>
                        </div>
                        <div id="navbar" class="navbar-collapse collapse">
                            <ul class="nav navbar-nav">
                                <li><a href="/">início</a></li>
                                <li><a href="/login">Entrar</a></li>
                                <li><a href="/cadastrar">Cadastar</a></li>
                                <li><a href="/contato">Contato</a></li>
                            </ul>
                        </div><!--/.nav-collapse -->
                        <!--/.container-fluid -->
                    </nav>
                </div>
            </div>

        </div>
    </header>

</div>


<div class="col-sm-12">
    <div class="banner-area banner-728x90 hidden-xs" data-type='{"xs":"resp","sm":"resp","md":"728x90","lg":"728x90"}'></div>
</div>

 @yield('content_site')	
 <div id="fb-root"></div>
<div class="container-fluid ">   
    <footer class="cp-bottom row ft_livro_lido">
        <div class="col-sm-12 copyright">
            <p>2016 Livro lido</p>
        </div>
    </footer>
    </div> 
</div><!--fim tudo-->
<div class="banner-area" data-type='{"xs":"320x50","sm":"320x50","md":false,"lg":false}'></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="../../../assets/js/bootstrap.min.js" type="text/javascript"></script>


<script>(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id))
        return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=670296843082030";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script type="text/javascript" src="../../../assets/js/jquery-1.4.2.min.js"></script>