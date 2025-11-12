@extends('templates.layoutlogin')

@section('title', 'Infinity Cars')

@section('conteudoLogin')

<div>
    <h2 class="login-title">Área Restrita</h2>
    <form method="POST" action="#" class="login-form">
        @csrf

        <div class="form-floating mb-3">
            <input class="form-control"  id="floatingInput" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
            <label for="floatingInput">Email</label>
            @error('email')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input class="form-control" id="floatingPassword" type="password" name="password" placeholder="Senha" required>
            <label for="floatingPassword">Senha</label>
            @error('password')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        <div>
          <a class="link-login" href="#">Esqueci minha senha</a>
          <a class="link-login" href="{{ route('register') }}">Criar novo usuário</a>
        </div>
        <div class="row">
        <button type="submit" class="btn-login btn btn-primary">Entrar</button>
        <a href="{{ route('veiculos.index') }}" class="btn-voltar btn">Voltar</a>
        </div>
    </form>
</div>
@endsection