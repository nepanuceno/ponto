@extends('adminlte::page')

@section('title', 'Livro de Pontos')

@section('content_header')
    <h1>Livro de Pontos</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Gerar livro referente a:
        </div>
        <form class="form" method="POST" action="{{ url('make-time-sheets') }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <div class="input-form">
                        <label class="label-control" for="month">Mês</label>
                        <select class="select2 form-control" name="month" id="month">
                            @for ($i=1; $i<=12; $i++)
                                <option value="{{ $i }}" {{ $month == $i ? 'selected':'' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="input-form">
                        <label class="label-control" for="year">Ano</label>
                        <select class="select2 form-control" name="year" id="year">
                            @foreach ($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button class="btn btn-primary" type="submit">Gerar Livro</button>
            </div>
        </form>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
