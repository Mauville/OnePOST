@extends('layouts.dashboard')
@section('content')
<p class="title is-1">Mis trabajos</p>
<div class="table-container">
    <table class="table has-text-centered is-fullwidth is-narrow is-striped is-hoverable">
        <thead>
        <tr>
            <th>Miniatura</th>
            <th>Nombre</th>
            <th>Fecha de difusión</th>
            <th>Fecha de modificación</th>
            <th>Descripción</th>
            <th>Proveedores</th>
            <th>Stats</th>
        </tr>
        </thead>
        <tbody>
        @foreach($artworks as $artwork)
        <tr>
            <th class="is-vcentered"><img src="{{ asset($artwork->URI) }}"></th>
            <td class="is-vcentered">{{ $artwork->name }}</td>
            <td class="is-vcentered">{{ $artwork->created_at->format('j F Y') }}</td>
            <td class="is-vcentered">{{ $artwork->updated_at->format('j F Y') }}</td>
            <td class="is-vcentered">{{ $artwork->description }}</td>
            <td class="is-vcentered">Proveedores</td>
            <td class="is-vcentered">
                <ul>
                    <li>Instagram: <br><u>20k likes</u> <u>200 comentarios</u></u></u></li>
                    <li>Twitter: <br><u>20k likes</u> <u>200 retweet</u> <u>1k comentarios</u></u></li>
                    <li>Facebook: <br><u>20k likes</u> <u>200 shares</u> <u>1k comentarios</u></u></li>
                </ul>
            </td>
            <td class="is-vcentered">
                <div class="buttons">
                  <button class="button is-success is-fullwidth">Redifundir</button>
                  <button class="button is-danger is-fullwidth">Eliminar</button>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
@endsection
