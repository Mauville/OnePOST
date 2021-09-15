@extends('layouts.dashboard')
@section('content')
    <div class="columns">
        <div class="column">
            <p class="title is-1">Agregar Trabajo</p>
        </div>
    </div>

    <form>
        <div id="file-js-example" class="file has-name">
            <label class="file-label">
                <input class="file-input" type="file" name="resume">
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
            <label class="label">Título</label>
            <div class="control">
                <input class="input" type="text" name="title" placeholder="Título de la Obra">
            </div>
        </div>
        <div class="field">
            <label class="label">Descripción</label>
            <div class="control">
                <textarea class="textarea" name="description" placeholder="Descripción de la Obra"></textarea>
            </div>
        </div>

        <div class="field">
            <label class="label">Publicar en:</label>
            <label class="checkbox">
                <input type="checkbox" name="twitter">
                Twitter
            </label>
            <label class="checkbox" disabled>
                <input type="checkbox" disabled>
                Patreon
            </label>
            <label class="checkbox" disabled>
                <input type="checkbox" disabled>
                Instagram
            </label>
            <label class="checkbox" disabled>
                <input type="checkbox" disabled>
                Fantia
            </label>
            <label class="checkbox" disabled>
                <input type="checkbox" disabled>
                DeviantArt
            </label>
        </div>

        <div class="control">
            <button class="button is-primary">Submit</button>
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
