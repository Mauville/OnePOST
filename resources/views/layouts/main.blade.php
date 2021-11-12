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
                OnePOST
            @endif
        </title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.0/css/bulma.min.css" />
        <link rel="stylesheet" href="https://unpkg.com/bulma-modal-fx/dist/css/modal-fx.min.css" />
        <meta name="robots" content="noindex">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        @stack('styles')
    </head>
    <body>
        @yield('content')
        <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.0.0/dist/js/coreui.bundle.min.js" integrity="sha384-caJEC8fMoc6Q3cPepbgNz8nEv350Wy42/1qEtfZnUn6NGNTJWLkzCzXXz08CVs/B" crossorigin="anonymous"></script>
        @stack('scripts')
    </body>
</html>
