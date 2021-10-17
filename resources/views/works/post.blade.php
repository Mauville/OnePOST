@extends('layouts.dashboard')
@section('content')
    @csrf
    <div class="columns">
        <div class="column">
            <p class="title is-1">Agregar Trabajo</p>
        </div>
    </div>

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
        Choose a file…
      </span>
    </span>
                <span class="file-name">
      No file uploaded
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
                    {{--        TODO Make these dynamic--}}
                    <label class="checkbox">
                        <input type="checkbox" name="network[twitter]">
                        Twitter
                    </label>
                    <label class="checkbox" disabled>
                        <input type="checkbox" name="network[patreon]" disabled>
                        Patreon
                    </label>
                    <label class="checkbox" disabled>
                        <input type="checkbox" name="network[instagram]" disabled>
                        Instagram
                    </label>
                    <label class="checkbox" disabled>
                        <input type="checkbox" name="network[fantia]" disabled>
                        Fantia
                    </label>
                    <label class="checkbox" disabled>
                        <input type="checkbox" name="network[deviant]" disabled>
                        DeviantArt
                    </label>
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
