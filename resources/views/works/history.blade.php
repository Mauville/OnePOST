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
            <th>Descripción</th>
            <th>Tipo de contenido</th>
            <th>Proveedores</th>
            <th>Opciones</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th class="is-vcentered"><i class="fas fa-file-image fa-2x icon is-large"></i></th>
            <td class="is-vcentered">Enrique en la pradera</td>
            <td class="is-vcentered">12/09/2021</td>
            <td class="is-vcentered">Hecho con ilustrator</td>
            <td class="is-vcentered">SVG</td>
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
        <tr>
            <th class="is-vcentered"><i class="fas fa-file-image fa-2x icon is-large"></i></th>
            <td class="is-vcentered">Enrique en la pradera</td>
            <td class="is-vcentered">12/09/2021</td>
            <td class="is-vcentered">Hecho con ilustrator</td>
            <td class="is-vcentered">SVG</td>
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
        <tr>
            <th class="is-vcentered"><i class="fas fa-file-image fa-2x icon is-large"></i></th>
            <td class="is-vcentered">Enrique en la pradera</td>
            <td class="is-vcentered">12/09/2021</td>
            <td class="is-vcentered">Hecho con ilustrator</td>
            <td class="is-vcentered">SVG</td>
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
    </tbody>
</table>
</div>
@endsection
