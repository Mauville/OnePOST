@extends('layouts.main')

@section('content')
    <h1>OnePOST</h1>
    @auth
        <p>
            <a href="{{ route('auth.logout') }}" class="btn btn-primary">
                Logout
            </a>
        </p>
    @endauth
    @guest
        <p>
            <a href="{{ route('auth.register') }}" class="btn btn-primary">
                Registrate
            </a>
        </p>
        <p>
            <a href="{{ route('auth.login') }}" class="btn btn-primary">
                Inicio de sesión
            </a>
        </p>
    @endguest
@endsection
