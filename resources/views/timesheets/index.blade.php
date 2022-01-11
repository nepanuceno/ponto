@extends('adminlte::page')

@section('title', 'Gerar Livro de Pontos')

@section('content_header')
    <h1>Livro de Pontos</h1>
@stop

@section('content')
    @if (count($employees) > 0)
    <div class="card">
        <div class="card-header">
            Gerar livro referente a:
        </div>
        <form class="form" method="POST" action="{{ url('make-time-sheets') }}">
            @csrf
            <div class="card-body">
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-info"></i> Atenção!</h5>
                    Selecione um <strong>Departamento</strong> ou um <strong>Servidor</strong>, caso selecione ambas as opções, o único filtro considerado será o de departamento.
                  </div>
                <div class="form-group">
                    <div class="input-form">
                        <label class="label-control" for="month">Departamento</label>
                        <select class="select2 form-control" name="departament" id="departament">
                                <option value="0">Todos</option>
                            @foreach ($departaments as $departament)
                                <option value="{{ $departament->id }}">{{ $departament->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-form">
                        <label class="label-control" for="month">Servidor</label>
                        <select class="select2 form-control" name="employee" id="employee">
                                <option value="0">Todos</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-form">
                        <label class="label-control" for="month">Mês</label>
                        <select class="select2 form-control" name="month" id="month">
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ $month == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
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
    @else
        <div class="alert alert-info">
            Ainda não há servidores cadastrados no sistema.
        </div>
    @endif
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
