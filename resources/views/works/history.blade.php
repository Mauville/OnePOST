@extends('layouts.dashboard')
@section('content')
<p class="title is-1">Mis trabajos</p>
<div class="table-container">
    @if (!$artworks->isEmpty())
    <table class="table has-text-centered is-fullwidth is-narrow is-striped is-hoverable">
        <thead>
        <tr>
            <th>Miniatura</th>
            <th>Nombre</th>
            <th>Fecha de difusión</th>
            <th>Fecha de modificación</th>
            <th>Descripción</th>
            <th>Stats</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($artworks as $artwork)
        <tr>
            <th class="is-vcentered"><figure class="image is-32x32">
                <img src="{{ asset($artwork->URI) }}"></figure>
            </th>
            <td class="is-vcentered">{{ $artwork->name }}</td>
            <td class="is-vcentered">{{ $artwork->created_at->format('j F Y') }}</td>
            <td class="is-vcentered">{{ $artwork->updated_at->format('j F Y') }}</td>
            <td class="is-vcentered">{{ $artwork->description }}</td>
            <td class="is-vcentered">
                <ul>
                @php ($all_stats = $artwork->getStatistics())
                @if (!$all_stats)
                Sin conexión a un proveedor.
                @endif
                @foreach($all_stats as $provider => $stats)
                    <li>En {{ $provider }}</li>
                    <li>Retweets: {{ $stats["retweet_count"] }}</li>
                    <li>Favoritos: {{ $stats["favorite_count"] }}</li>
                @endforeach
                </ul>
            </td>
            <td class="is-vcentered">
                <div class="buttons">
                  <a class="button is-success is-fullwidth" href="{{ route('dashboard.works.repost', compact('artwork')) }}">Redifundir</a>
                  <a class="button is-danger is-fullwidth" href="{{ route('dashboard.works.deleteConfirmation', compact('artwork')) }}">Eliminar</a>
                </div>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    @else
    <div class="section">
        <p>Haz click en difundir trabajo y difunde tu primer trabajo.</p>
    </div>
    @endif
</div>
@endsection
