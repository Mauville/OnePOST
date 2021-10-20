@extends('layouts.dashboard')
@section('content')
    @csrf
    <div class="columns">
        <div class="column">
            <p class="title is-1">Agregar Trabajo</p>
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

    <form method="post" action={{ route("dashboard.works.postWork") }} enctype="multipart/form-data">
        @csrf
        <div id="file-js-example" class="file has-name">
            <label class="file-label">
                <input class="file-input" type="file" id="art" name="art">
                <span class="file-cta">
      <span class="file-icon">
        <i class="fas fa-upload"></i>
      </span>
      <span class="file-label">
        Escoge un imágen o video...
      </span>
    </span>
                <span class="file-name">
      Sin archivo
    </span>
            </label>
        </div>

        <div class="field">
            <div class="control">
                <label class="label">Título
                    <input class="input" type="text" name="name" placeholder="Título de la Obra">
                </label>
            </div>
        </div>
        <div class="field">
            <div class="control">
                <label class="label">Descripción
                    <textarea class="textarea" name="description" placeholder="Descripción de la Obra"></textarea>
                </label>
            </div>
        </div>

        <div class="field">
            <fieldset name="">
                <label class="label">Publicar en:
                    @if (!$providers->isEmpty())
                    @foreach($providers as $provider)
                    <label class="checkbox">
                        <input type="checkbox" name="providersId[{{ $provider->id }}]">
                        {{ $provider->type }} con: {{ $provider->username}}
                    </label>
                    @endforeach
                    @else
                        Sin proveedores (Agrega un provedor desde Mis proveedores).
                    @endif
                </label>
            </fieldset>
        </div>

        <div class="control">
            <button type="submit" class="button is-primary">Submit</button>
        </div>

        {{--        This script adds the filename of an uploaded object. --}}
        {{--        PN: Why tf doesn't bulma do this automatically? --}}
        <script>
            const fileInput = document.querySelector('#file-js-example input[type=file]');
            fileInput.onchange = () => {
                if (fileInput.files.length > 0) {
                    const fileName = document.querySelector('#file-js-example .file-name');
                    fileName.textContent = fileInput.files[0].name;
                }
            }
        </script>

    </form>

@endsection
