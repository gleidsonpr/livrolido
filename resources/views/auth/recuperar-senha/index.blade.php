@extends('auth.templates.index')
<!-- FORMULARIO DE RECUPERAR SENHA--RECUPERAR-SENHA.INDEX-->
@section('form') 
<form class="form-padrao form-login" method="POST" action="/resetar-senha">
    {!!csrf_field()!!}
    <div class="form-group">
        <input type="text" name="email" class="form-control" placeholder="Email">
    </div>
    <div class="form-group">
        <input type="hidden" name="token" value="{{$token}}">
    </div>
    <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="Senha">
    </div>
    <div class="form-group">
        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmar a senha">
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
    <input type="submit" name="btn-recuperar-senha" value="Alterar senha" class="btn btn-primary">
</form>
@endsection