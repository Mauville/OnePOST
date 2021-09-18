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
        <div class="column left has-text-centered">
          <h1 class="title is-4">Crea tu cuenta aquí </h1>
          <form method="post" action="{{ route('auth.save-user') }}">
            @csrf
            <div class="field">
              <div class="control">
                <input class="input is-medium" type="text" name="name" placeholder="Nombre">
              </div>
            </div>
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
            <div class="field">
              <div class="control">
                <input class="input is-medium" type="password" name="password_confirmation" placeholder="Confirma la contraseña">
              </div>
            </div>
            <button class="button is-block is-primary is-fullwidth is-medium mb-2" type="submit">Registrate</button>
            <br />
            <a href="{{ route('auth.login') }}" class="button is-text">
                Inicia sesión
            </a>
          </form>
        </div>
          <div class="column right is-hidden-mobile">
              <h1 class="title is-1">Registrate</h1>
              <h2 class="subtitle colored is-4">Comienza la aventura con nosotros</h2>
              <p>Estamos muy contentos de tenerte aquí.</p>
          </div>
      </div>
    </div>
  </div>
</section>
@endsection

