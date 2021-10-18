@extends('layouts.dashboard')
@section('content')
<div class="columns">
  <div class="column is-four-fifths">
    <p class="title is-1">Mis proveedores</p>
  </div>
  <div class="column">
    <a class="button is-primary is-outlined" href="{{ route('dashboard.providers.register') }}">Agregar proveedor</a>
  </div>
</div>

<div class="table-container">
<table class="table has-text-centered is-fullwidth is-narrow is-striped is-hoverable">
    <thead>
        <tr>
            <th>Red social</th>
            <th>Nombre de usuario</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($providers as $provider)
        <tr>
            <td class="is-vcentered">{{ $provider->type }}</td>
            <td class="is-vcentered">{{ $provider->username }}</td>
            <td class="is-vcentered">
                <div class="buttons">
                  <!-- <button class="button is-info is-fullwidth">Reautentificar</button>-->
                  <a class="button is-danger is-fullwidth" href="{{ route('dashboard.providers.deleteConfirmation', compact('provider')) }}">Eliminar</a>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
@endsection
