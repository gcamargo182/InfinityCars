@extends('templates.layoutregister')

@section('title', 'Infinity Cars')

@section('conteudoRegister')

<form method="POST" action="{{ route('register') }}">
    @csrf
    <h2 class="register-title"> Registrar Usuário</h2>
        <div class="form-floating mb-3">
        <input class="form-control" id="floatingInput" type="text" name="name" value="{{ old('name') }}" autofocus>
        <label for="floatingInput">Nome</label>
        </div>
        <div class="form-floating mb-3">
        <input class="form-control" id="floatingInput" type="email" name="email" value="{{ old('email') }}">
        <label for="floatingInput">Email</label>
        </div>
        <div class="form-floating mb-3">
        <input class="form-control" id="floatingPassword" type="password" name="password">
        <label for="floatingPassword">Senha</label>
        </div>
        <div class="form-floating mb-3">
        <input class="form-control" id="floatingPasswordConfirmation" type="password" name="password_confirmation">
        <label for="floatingPasswordConfirmation">Confirmar Senha</label>
        </div>
        <div class="row">
        <input class="btn-register" type="submit" value="Registrar">
        <a href="{{ route('login') }}" class="btn-voltar btn btn-secondary">Voltar</a>
        </div>
</form>

@endsection