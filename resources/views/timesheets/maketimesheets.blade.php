@extends('adminlte::page')

@section('title', 'Livro de Pontos')

@section('content_header')

@stop

@section('content')
<div class="d-flex justify-content-end mb-4">
    <a class="btn btn-primary" href="{{ url('/employee/pdf') }}">Export to PDF</a>
</div>
    <div class="shadow p-3 bg-body rounded pt-4">
    <h1 class="text-center mb-4">Livro de Ponto do mês de {{ $month }} de {{$year }}</h1>
    @foreach ($employees as $employee)
        <hr>
        <div class="row">
            <div class="col-md-1"><strong>Nome:</strong></div>
            <div class="col-md-6">{{ $employee->name }}</div>
            <div class="col-1"><strong>Matrícula:</strong></div>
            <div class="col-2">{{ $employee->matriculation }}</div>
        </div>
        <div class="row">
            <div class="col-md-1"><strong>Cargo:</strong></div>
            <div class="col-md-6">{{ $employee->getPosition->name }}</div>
            <div class="col-1"><strong>Lotação:</strong></div>
            <div class="col-2">{{  $employee->getDepartament->name }}</div>
        </div>
        <hr>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Dia</th>
                <th>Entrada</th>
                <th>Saída</th>
                <th>Entrada</th>
                <th>Saída</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($arr_days as $day)
                    <tr>
                        <td width="16%">{{ $day['day'] }} - {{ $day['week_day']}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5">
                        Assinatura do chefe imediato:
                    </td>
                </tr>
            </tbody>
        </table>
    @endforeach
    </div>
@stop
