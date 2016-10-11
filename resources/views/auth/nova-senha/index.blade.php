@extends('auth.templates.index')
<!-- FORMULARIO DE RECUPERAR SENHA--NOVA-SENHA.INDEX-->
@section('form') 
<form class="form-padrao form-login" method="POST" action="/recuperar-senha">
    {!!csrf_field()!!}
    <div class="form-group">
        <input type="text" name="email" class="form-control" placeholder="Email">
    </div>
    

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Algo deu errado.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <input type="submit" name="btn-recuperar-senha" value="Solicitar nova senha" class="btn btn-primary">
</form>
@endsection