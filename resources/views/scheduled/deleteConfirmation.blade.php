@extends('layouts.dashboard')
@section('content')
    @csrf
    <div class="columns">
        <div class="column">
            <p class="title is-1">Eliminar Trabajo Agendado</p>
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
            <th>Fecha de publicación</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th class="is-vcentered"><figure class="image is-32x32">
                <img src="{{ Storage::url($scheduled->URI)}}"></figure>
            </th>
            <td class="is-vcentered">{{ $scheduled->name }}</td>
            <td class="is-vcentered">{{ $scheduled->created_at->format('j F Y') }}</td>
            <td class="is-vcentered">{{ $scheduled->updated_at->format('j F Y') }}</td>
            <td class="is-vcentered">{{ $scheduled->description }}</td>
            <td class="is-vcentered">{{ $scheduled->time_scheduled }}</td>
            <td class="is-vcentered">
        </tr>
    </tbody>
</table>
    <div class="mt-6 mb-6 is-flex is-align-items-center">
        <div class="block mr-4">
            <p>Eliminar de la plataforma sin eliminar de sus proveedores, es un cambio permanente.</p>
        </div>
        <div class="block">
            <a class="button is-danger" href={{ route("dashboard.scheduled.deletePermanently", compact('scheduled')) }} >Eliminar proveedor de la plataforma</a>
        </div>
    </div>

@endsection
