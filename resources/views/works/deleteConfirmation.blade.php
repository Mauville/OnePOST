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
            <th>Stats</th>
        </tr>
        </thead>
        <tbody>
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
                @foreach($artwork->getStatistics() as $provider => $stats)
                    <li>En {{ $provider }}</li>
                    <li>Retweets: {{ $stats["retweet_count"] }}</li>
                    <li>Favoritos: {{ $stats["favorite_count"] }}</li>
                @endforeach
                </ul>
            </td>
        </tr>
    </tbody>
</table>

    <form method="post" action={{ route("dashboard.works.deleteWork", compact('artwork')) }} enctype="multipart/form-data">
        <div class="field">
            <fieldset name="">
                <label class="label">Eliminar de:
                    @foreach($artwork->providers as $provider)
                    <label class="checkbox">
                        <input type="checkbox" name="providersId[{{ $provider->id }}]">
                        {{ $provider->type }} con: {{ $provider->username}}
                    </label>
                    @endforeach
                </label>
            </fieldset>
        </div>
        @csrf
        <div class="control">
            <button type="submit" class="button is-danger">Confirmar eliminar</button>
        </div>
    </form>

@endsection
