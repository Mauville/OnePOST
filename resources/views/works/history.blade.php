@extends('layouts.dashboard')
@section('content')
@if ($errors->any())
<div class="notification is-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<p class="title is-1">Mis trabajos</p>
<form class="field has-addons" method="post" action={{ route("dashboard.works.searchWork") }} enctype="multipart/form-data">
    @csrf
    <p class="control">
      <input class="input" type="text" name="searchField" placeholder="Encuentra trabajo por nombre">
    </p>
    <p class="control">
        <button type="submit" class="button is-primary">Buscar</button>
    </p>
</form>
<form class="" method="post" action={{ route("dashboard.works.sortWorks") }} enctype="multipart/form-data">
    @csrf
    <div class="field">
        <label class="label">
            Ordenar por:
            <div class="select is-primary is-small">
              <select name="sortBy" id="sortBy">
                <option value="stats">Por estad&iacute;sticas</option>
                <option value="dateCreated">Por fecha de difusión</option>
                <option value="name">Por nombre</option>
              </select>
            </div>
        </label>
    </div>
    <div class="field">
        <div class="control">
            <button type="submit" class="button is-primary is-small">Ordenar</button>
        </div>
    </div>
</form>
<a class="button is-danger is-small mt-2" href="{{ route('dashboard.works.export') }}">Export CSV</a>
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
            <th>Estadísticas</th>
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
                    @php ($all_stats = $artwork->stats)
                    @if (!$all_stats)
                        Sin conexión a un proveedor.
                    @else
                        @foreach($all_stats as $provider => $stats)
                            @if ($stats)
                                <li>En {{ $provider }}</li>
                                <li>Retweets: {{ $stats["retweet_count"] }}</li>
                                <li>Favoritos: {{ $stats["favorite_count"] }}</li>
                            @endif
                        @endforeach
                    @endif
                </ul>
            </td>
            <td class="is-vcentered">
                <div class="buttons">
                    <a class="button is-success is-fullwidth"
                       href="{{ route('dashboard.works.repost', compact('artwork')) }}">Redifundir</a>
                    <a class="button is-danger is-fullwidth"
                       href="{{ route('dashboard.works.deleteConfirmation', compact('artwork')) }}">Eliminar</a>
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
