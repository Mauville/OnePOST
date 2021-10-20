@extends('layouts.dashboard')
@section('content')
    @csrf
    <div class="columns">
        <div class="column">
            <p class="title is-1">Redifundir Trabajo</p>
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
    <figure class="image is-64x64">
        <img src="{{ asset($artwork->URI) }}"></figure>
    </figure>

    <form method="post" action={{ route("dashboard.works.repostWork", compact('artwork')) }} enctype="multipart/form-data">
        @csrf
        <div class="field">
            <div class="control">
                <label class="label">Título
                    <input class="input" type="text" name="name" value="{{ $artwork->name }}">
                </label>
            </div>
        </div>
        <div class="field">
            <div class="control">
                <label class="label">Descripción
                    <textarea class="textarea" name="description">{{ $artwork->description }}</textarea>
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
        <div class="field">
            <fieldset name="">
                <label class="label checkbox">
                    Agendar trabajo: 
                    <input type="checkbox" name="shouldSchedule" value="1">
                </label>
            </fieldset>
        </div>
        <div class="field">
            <div class="control">
                <label class="label">En fecha y hora:
                    @php($now = Carbon\Carbon::now()->addMinutes(2)->toDateTimeString())
                    <input class="input" type="datetime-local" name="time_scheduled" min="{{ $now }}" value="{{ $now }}">
                </label>
            </div>
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
