@extends('layouts.dashboard')
@section('content')
    <div class="columns">
        <div class="column">
            <p class="title is-1">Nuevo Proveedor</p>
        </div>
    </div>

    <div class="flex-row">
        {{--    Twitter ButtonCard--}}
        <div class="column is-2 is-one-third-mobile">
            <a class="flex-card" href={{ route("auth.twitterRedirect") }}>
                <img class="provider-logo" alt="twitter" src="{{ asset('img/twitter.png') }}">
                <h3 class="center-text">
                    Twitter
                </h3>
            </a>
        </div>

        {{--    ig ButtonCard--}}
        <div class="column is-2 is-one-third-mobile">
            <a class="flex-card inactive" href="#">
                <img class="provider-logo" alt="instagram" src="{{ asset('img/instagram.png') }}">
                <h3 class="center-text">
                    Instagram
                </h3>
            </a>
        </div>

        {{--    Patreon ButtonCard--}}
        <div class="column is-2 is-one-third-mobile">
            <a class="flex-card inactive" href="#">
                <img class="provider-logo" alt="patreon" src="{{ asset('img/patreon.png') }}">
                <h3 class="center-text">
                    Patreon
                </h3>
            </a>
        </div>
        {{--    Fantia ButtonCard--}}
        <div class="column is-2 is-one-third-mobile">
            <a class="flex-card inactive" href="#">
                <img class="provider-logo" alt="fantia" src="{{ asset('img/fantia.png') }}">
                <h3 class="center-text">
                    Fantia
                </h3>
            </a>
        </div>
        {{--    DeviantArt ButtonCard--}}
        <div class="column is-2 is-one-third-mobile">
            <a class="flex-card inactive" href="#">
                <img class="provider-logo" alt="DeviantArt" src="{{ asset('img/da.png') }}">
                <h3 class="center-text">
                    DeviantArt
                </h3>
            </a>
        </div>
    </div>

    <style>
        .inactive {
            filter: saturate(0);
            box-shadow: none !important;
            cursor: default;
        }

        .inactive:hover {
            cursor: default;
        }

        .inactive h3 {
            color: #bfbfbf !important;
        }

        .flex-row {
            display: flex;
        }

        .center-text {
            text-align: center;
        }

        .provider-logo {
            height: 70%;
            margin: 0 auto;
        }

        .flex-card {
            display: flex;
            background-color: #f4f4f4;
            border-radius: 10px;
            padding: 1.5em;
            flex-direction: column;
            justify-content: space-around;
            align-content: baseline;
            gap: 25px;
            max-height: 90%;
            box-shadow: rgba(10, 10, 10, 0.1) 0 8px 16px -2px, rgba(10, 10, 10, 0.02) 0 0 1px
        }

        .flex-card a {
            text-decoration: none;
        }

        .flex-card h3 {
            font-size: 1.5em;
            color: #1a202c;
        }
    </style>
@endsection
