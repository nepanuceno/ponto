@extends('layouts.pdfHtml')

@section('content')
    @foreach ($employees as $employee)

        <table class="header">
            <tr>
                <td colspan="2" width="25%">
                    <img src="image/logo/logo_instituicao.jpg" />
                </td>
                <td colspan="4" width="75%" class="center">
                    <h2>{{ Config::get('app.interprise_name') }}</h2>
                </td>
            </tr>
            <tr>
                <th>Nome:</th>
                <td>{{ $employee->name }}</td>
                <th>Matrícula:</th>
                <td>{{ $employee->matriculation }}</td>
                <th>Lotação:</th>
                <td>{{ $employee->getDepartament->name }}</td>
            </tr>
            <tr>
                <th>Cargo:</th>
                <td colspan="3">{{ $employee->getPosition->name }}</td>
                <th>Referência:</th>
                <td>{{ $month }} de {{ $year }}</td>
            </tr>
        </table>
        <hr>
        <table class="styled-table">
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
                        <td width="18%">{{ $day['day'] }} - {{ $day['week_day'] }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if(count($arr_days) < 30)
            <br>
            <br>
            <br>
        @endif
        <p class="assinatura">Assinatura do chefe imediato</p>
    @endforeach
@stop
