@extends('layouts.dashboard')
@section('content')
    @csrf
    <div class="columns">
        <div class="column">
            <p class="title is-1">Eliminar Proveedor: {{ $provider->type }} con {{ $provider->username }}</p>
        </div>
    </div>
    <div class="columns">
        <div class="column">
            <p class="subtitle is-4">Trabajos difundidos con este proveedor</p>
        </div>
    </div>
    @if ($errors->any())
    <div class="notification is-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (!$artworks->isEmpty())
    <table class="table has-text-centered is-fullwidth is-narrow is-striped is-hoverable">
        <thead>
        <tr>
            <th>Miniatura</th>
            <th>Nombre</th>
            <th>Fecha de difusión</th>
            <th>Fecha de modificación</th>
            <th>Descripción</th>
            <th>Estadísticas</th>
        </tr>
        </thead>
        <tbody>
        @foreach($artworks as $artwork)
        <tr>
            <th class="is-vcentered"><figure class="image is-32x32">
                <img src="{{ Storage::url($artwork->URI)}}"></figure>
            </th>
            <td class="is-vcentered">{{ $artwork->name }}</td>
            <td class="is-vcentered">{{ $artwork->created_at->format('j F Y') }}</td>
            <td class="is-vcentered">{{ $artwork->updated_at->format('j F Y') }}</td>
            <td class="is-vcentered">{{ $artwork->description }}</td>
            <td class="is-vcentered">
                <ul>
                @foreach($artwork->getStatistics() as $providerName => $stats)
                    @if ($stats)
                    <li>En {{ $providerName }}</li>
                    <li>Retweets: {{ $stats["retweet_count"] }}</li>
                    <li>Favoritos: {{ $stats["favorite_count"] }}</li>
                    @endif
                @endforeach
                </ul>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    @else
    <div class="section">
        <p>Sin trabajos relacionados.</p>
    </div>
    @endif
    <a class="button is-danger" href={{ route("dashboard.providers.deleteProvider", compact('provider'))}}>Confirmar eliminar proveedor</a>

@endsection
