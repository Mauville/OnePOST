@extends('layouts.main')
@section('content')
@if ($errors->any())
    <div class="notification is-primary">
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
<section class="container">
  <div class="columns is-multiline">
    <div class="column is-8 is-offset-2 register">
      <div class="columns">
        <div class="column left is-hidden-mobile">
          <h1 class="title is-1">¡Bienvenido de vuelta!</h1>
          <h2 class="subtitle colored is-4">Entra a tu cuenta</h2>
          <p>Estamos muy contento de que sigas eligiendo trabajar con nosotros</p>
        </div>
        <div class="column right has-text-centered">
          <h1 class="title is-4">Inicia sesión en tu cuenta</h1>
          <form method="post" action="{{ route('auth.login-user') }}">
            @csrf
            <div class="field">
              <div class="control">
                <input class="input is-medium" type="text" name="email" placeholder="Email">
              </div>
            </div>

            <div class="field">
              <div class="control">
                <input class="input is-medium" type="password" name="password" placeholder="Contraseña">
              </div>
            </div>
            <button class="button is-block is-primary is-fullwidth is-medium mb-2" type="submit">Iniciar sesión</button>
            <a class="button is-block is-fullwidth is-medium" href="{{ route('auth.google') }}">
                <span class="icon">
                    <i class="fab fa-google"></i>
                </span>
                <span>Iniciar sesión con google</span>
            </a>
            <br />
            <a href="{{ route('auth.register') }}" class="button is-text">
                Registrate
            </a>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

