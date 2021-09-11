@extends('layouts.main')

@push('styles')
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('bulma.js') }}"></script>
@endpush

@section('content')
    <body>
        <section class="hero is-info is-medium is-bold">
            <div class="hero-head">
                <nav class="navbar">
                    <div class="container">
                        <div class="navbar-brand">
                            <a class="navbar-item" href="../">
                                <h1 class="title">OnePOST</h1>
                            </a>
                            <span class="navbar-burger burger" data-target="navbarMenu">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </div>
                        <div id="navbarMenu" class="navbar-menu">
                            <div class="navbar-end">
                                @auth
                                <div class="tabs is-right">
                                    <span class="navbar-item">
                                        <a class="button is-white is-outlined" href="{{ route('auth.logout') }}">
                                            <span title="Hello from the other side">Cerrar sesión</span>
                                        </a>
                                    </span>
                                </div>
                                @endauth
                                @guest
                                <div class="tabs is-right">
                                    <span class="navbar-item">
                                        <a class="button is-white is-outlined" href="{{ route('auth.register') }}">
                                            <span title="Hello from the other side">Registrate</span>
                                        </a>
                                    </span>
                                    <span class="navbar-item">
                                        <a class="button is-white is-outlined" href="{{ route('auth.login') }}">
                                            <span title="Hello from the other side">Inicia sesión</span>
                                        </a>
                                    </span>
                                </div>
                                @endguest
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="hero-body">
                <div class="container has-text-centered">
                    <h1 class="title">
                    OnePOST
                    </h1>
                    <h2 class="subtitle">
                    OnePOST es una página donde podrás gestionar todas tus creaciones. Con este aplicación no tendrás que subir la misma imágen una por una a todas tus redes sociales. Gestiona tu tiempo, gestiona tus trabajos con OnePOST.
                    </h2>
                </div>
            </div>
        </section>
        <section class="container">
            <div class="columns features">
                <div class="column is-4">
                    <div class="card is-shady">
                        <div class="card-image has-text-centered">
                            <i class="fa fa-paw"></i>
                        </div>
                        <div class="card-content">
                            <div class="content">
                                <h4>Acerca de nosotros</h4>
                                <p>En OnePOST llevamos más de 10 años construyendo una plataforma de la que estamos orgullosos que permite a los artistas hacer que su arte se vea fácilmente en todo el mundo. Fundada en la tranquila campiña de TecNah, México en 2021, hemos crecido hasta convertirnos en el distribuidor de arte digital líder en todo México.</p>
                                <p><a href="#">Learn more</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="card is-shady">
                        <div class="card-image has-text-centered">
                            <i class="fa fa-empire"></i>
                        </div>
                        <div class="card-content">
                            <div class="content">
                                <h4>Valores</h4>
                                <p>En OnePOST llevamos más de 10 años construyendo una plataforma de la que estamos orgullosos que permite a los artistas hacer que su arte se vea fácilmente en todo el mundo. Fundada en la tranquila campiña de TecNah, México en 2021, hemos crecido hasta convertirnos en el distribuidor de arte digital líder en todo México.</p>
                                <p><a href="#">Learn more</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="card is-shady">
                        <div class="card-image has-text-centered">
                            <i class="fa fa-apple"></i>
                        </div>
                        <div class="card-content">
                            <div class="content">
                                <h4>Mision</h4>
                                <p>En OnePOST llevamos más de 10 años construyendo una plataforma de la que estamos orgullosos que permite a los artistas hacer que su arte se vea fácilmente en todo el mundo. Fundada en la tranquila campiña de TecNah, México en 2021, hemos crecido hasta convertirnos en el distribuidor de arte digital líder en todo México.</p>
                                <p><a href="#">Learn more</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="intro column is-8 is-offset-2">
                <h2 class="title">Perfecto para artistas!</h2><br>
            </div>
        </section>
        <footer class="footer">
            <div class="container">
                <div class="content has-text-centered">
                    <p>
                        Gracias!
                    </p>
                    <div class="control level-item">
                        <a href="https://github.com/BulmaTemplates/bulma-templates">
                            <div class="tags has-addons">
                                <span class="tag is-dark">Made with Bulma</span>
                                <span class="tag is-info">MIT license</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <script src="../js/bulma.js"></script>
        </footer>
@endsection
