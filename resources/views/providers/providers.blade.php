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
        <tr>
            <td class="is-vcentered">Twitter</td>
            <td class="is-vcentered">enroak</td>
            <td class="is-vcentered">
                <div class="buttons">
                  <button class="button is-info is-fullwidth">Reautentificar</button>
                  <button class="button is-danger is-fullwidth">Eliminar</button>
                </div>
            </td>
        </tr>
        <tr>
            <td class="is-vcentered">Facebook</td>
            <td class="is-vcentered">enroak</td>
            <td class="is-vcentered">
                <div class="buttons">
                  <button class="button is-info is-fullwidth">Reautentificar</button>
                  <button class="button is-danger is-fullwidth">Eliminar</button>
                </div>
            </td>
        </tr>
        <tr>
            <td class="is-vcentered">Instagram</td>
            <td class="is-vcentered">enroak</td>
            <td class="is-vcentered">
                <div class="buttons">
                  <button class="button is-info is-fullwidth">Reautentificar</button>
                  <button class="button is-danger is-fullwidth">Eliminar</button>
                </div>
            </td>
        </tr>
    </tbody>
</table>
</div>
@endsection
