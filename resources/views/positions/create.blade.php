@extends('adminlte::page')

@section('title', 'Cargo')

@section('content_header')
    <h1>Cadastro de Cargo</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                <use xlink:href="#check-circle-fill" />
            </svg>
            <div class="ml-2">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if (session('danger'))
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                <use xlink:href="#exclamation-triangle-fill" />
            </svg>
            <div class="ml-2">
                {{ session('danger') }}
            </div>
        </div>
    @endif

    <div class="card card-info">
        <form action="{{ isset($position) ? url('positions/' . $position->id) : url('positions') }}" method="POST">
            <div class="card-body">
                @csrf
                @if (isset($position))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <div class="input-form">
                        <label class="form-label" for="position">Cargo</label>
                        <input class="form-control" name="position" id="position"
                            value="{{ isset($position) ? $position->name : '' }}" />
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">{{ isset($position) ? 'Salvar' : 'Cadastrar' }}</button>
                <a class="btn btn-secondary float-right" href="{{ route('positions.index') }}">Voltar</a>
            </div>
        </form>
    </div>
@stop
@section('js')
    <script>
        $('.select2').select2({
            placeholder: 'Select an option'
        });
    </script>
@stop
