@extends('layouts.dashboard')
@section('content')
    @csrf
    <div class="columns">
        <div class="column">
            <p class="title is-1">Eliminar Trabajo</p>
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
        <tr>
            <th class="is-vcentered">
                <figure class="image is-32x32">
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
        </tr>
        </tbody>
    </table>
    @php($providers = $artwork->providers)
    <form method="post"
          action={{ route("dashboard.works.deleteWork", compact('artwork')) }} enctype="multipart/form-data">
        <div class="field">
            <fieldset name="">
                <label class="label">Eliminar de:
                @if (!$providers->isEmpty())
                    @foreach($providers as $provider)
                    <label class="checkbox">
                        <input type="checkbox" name="providersId[{{ $provider->id }}]">
                        {{ $provider->type }} con: {{ $provider->username}}
                    </label>
                    @endforeach
                @else
                    No hay proveedores para este trabajo.
                @endif
                </label>
            </fieldset>
        </div>
        @csrf
        <div class="control">
            <button type="submit" class="button is-danger" {{ ($providers->isEmpty()) ? 'disabled' : '' }}>Confirmar
                eliminar
            </button>
        </div>
    </form>

    <div class="mt-6 mb-6 is-flex is-align-items-center">
        <div class="block mr-4">
            <p>Eliminar de la plataforma sin eliminar de sus proveedores, es un cambio permanente.</p>
        </div>
        <div class="block">
            <a class="button is-danger" href={{ route("dashboard.works.deletePermanently", compact('artwork')) }} >Eliminar
                trabajo de la plataforma</a>
        </div>
    </div>

@endsection
