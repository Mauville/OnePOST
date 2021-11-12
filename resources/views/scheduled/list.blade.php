@extends('layouts.dashboard')
@section('content')
<p class="title is-1">Mis trabajos agendados</p>
<div class="table-container">
    @if (!$scheduled_works->isEmpty())
    <table class="table has-text-centered is-fullwidth is-narrow is-striped is-hoverable">
        <thead>
        <tr>
            <th>Miniatura</th>
            <th>Nombre</th>
            <th>Fecha de difusión</th>
            <th>Fecha de modificación</th>
            <th>Descripción</th>
            <th>Fecha de publicación</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($scheduled_works as $scheduled)
        <tr>
            <th class="is-vcentered"><figure class="image is-32x32">
                <img src="{{ asset("storage/" .$scheduled->URI) }}"></figure>
            </th>
            <td class="is-vcentered">{{ $scheduled->name }}</td>
            <td class="is-vcentered">{{ $scheduled->created_at->format('j F Y') }}</td>
            <td class="is-vcentered">{{ $scheduled->updated_at->format('j F Y') }}</td>
            <td class="is-vcentered">{{ $scheduled->description }}</td>
            <td class="is-vcentered">{{ $scheduled->time_scheduled }}</td>
            <td class="is-vcentered">
                <div class="buttons">
                  <a class="button is-success is-fullwidth" href="{{ route('dashboard.scheduled.change', compact('scheduled')) }}">Cambiar</a>
                  <a class="button is-danger is-fullwidth" href="{{ route('dashboard.scheduled.deleteConfirmation', compact('scheduled')) }}">Eliminar</a>
                </div>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    @else
    <div class="section">
        <p>Agenda un trabajo desde difundir trabajo.</p>
    </div>
    @endif
</div>
@endsection
