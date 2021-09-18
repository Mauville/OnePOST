<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>
            @hasSection('title')
                @yield('title') - OnePOST
            @else
                OnePOST - Dashboard
            @endif
        </title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.0/css/bulma.min.css" />
        <link rel="stylesheet" href="https://unpkg.com/bulma-modal-fx/dist/css/modal-fx.min.css" />
        <meta name="robots" content="noindex">
        <link rel="stylesheet" href="{{ asset('css/dash.css') }}">
        @stack('styles')
    </head>
    <body>
         <!-- START NAV -->
        <nav class="navbar is-primary">
            <div class="container">
                <div class="navbar-brand">
                    <a class="navbar-item brand-text" href="{{ route('homepage') }}">
                       OnePOST Dash
                    </a>
                    <div class="navbar-burger burger" data-target="navMenu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
                <div id="navMenu" class="navbar-menu">
                    <div class="navbar-start is-hidden-tablet">
                        <a class="navbar-item" href="{{ route('dashboard.works.history') }}">
                            Mis trabajos
                        </a>
                        <a class="navbar-item" href="{{ route('dashboard.providers.show') }}">
                            Mis proveedores
                        </a>
                        <a class="navbar-item" href="{{ route('dashboard.works.post') }}">
                           Difundir trabajo
                        </a>
                    </div>
                    <div class="navbar-end">
                        <span class="navbar-item">
                            <a class="button is-white is-outlined" href="{{ route('auth.logout') }}">
                                <span title="Botton de cerrar sesion">Salir</span>
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </nav>
        <!-- END NAV -->
        <div class="container mt-3">
            <div class="columns">
                <div class="column is-3 ">
                    <aside class="menu is-hidden-mobile">
                        <section class="hero is-info welcome is-small">
                            <div class="hero-body">
                                <div class="container">
                                    <h1 class="title is-size-4">
                                        Hola, {{ auth()->user()->name }}
                                    </h1>
                                    <h2 class="subtitle is-size-4">
                                        {{ request()->route()->getName() === 'dashboard.works.history' ? 'Checa tus ultimas actualizaciones' : '' }}
                                        {{ request()->route()->getName() === 'dashboard.providers.show' ? 'Administra tus cuentas de redes sociales' : '' }}
                                        {{ request()->route()->getName() === 'dashboard.providers.register' ? 'Agrega una nueva red social' : '' }}
                                        {{ request()->route()->getName() === 'dashboard.works.post' ? 'Difunde tus trabajo en tus redes' : '' }}
                                    </h2>
                                </div>
                            </div>
                        </section>
                        <p class="menu-label">
                            General
                        </p>
                        <ul class="menu-list">
                            <li><a {{ request()->route()->getName() === 'dashboard.works.history' ? ' class=is-active' : '' }} href="{{ route('dashboard.works.history') }}">Mis trabajos</a></li>
                            <li><a {{ request()->route()->getName() === 'dashboard.providers.show' ? ' class=is-active' : '' }} href="{{ route('dashboard.providers.show') }}">Mis proveedores</a></li>
                            <li><a {{ request()->route()->getName() === 'dashboard.works.post' ? ' class=is-active' : '' }} href="{{ route('dashboard.works.post') }}">Difundir trabajo</a></li>
                        </ul>
                        <!--
                        <p class="menu-label">
                            Administracion
                        </p>
                        <ul class="menu-list">
                            <li><a class="is-active">Dashboard</a></li>
                            <li><a>Reportes</a></li>
                        </ul>
                        -->
                    </aside>
                </div>
                <div class="column is-9">
                    <section class="hero is-info welcome is-small is-hidden-tablet">
                        <div class="hero-body">
                            <div class="container">
                                <h1 class="title is-size-4">
                                    Hola, {{ auth()->user()->name }}
                                </h1>
                                <h2 class="subtitle is-size-4">
                                    {{ request()->route()->getName() === 'dashboard.works.history' ? 'Checa tus ultimas actualizaciones' : '' }}
                                    {{ request()->route()->getName() === 'dashboard.providers.show' ? 'Administra tus cuentas de redes sociales' : '' }}
                                    {{ request()->route()->getName() === 'dashboard.works.post' ? 'Difunde tus trabajo en tus redes' : '' }}
                                </h2>
                            </div>
                        </div>
                    </section>
                    <div class="container">
                    @yield('content')
</div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.0.0/dist/js/coreui.bundle.min.js" integrity="sha384-caJEC8fMoc6Q3cPepbgNz8nEv350Wy42/1qEtfZnUn6NGNTJWLkzCzXXz08CVs/B" crossorigin="anonymous"></script>
        <script src="{{ asset('js/bulma.js') }}"></script>
        @stack('scripts')
    </body>
</html>

