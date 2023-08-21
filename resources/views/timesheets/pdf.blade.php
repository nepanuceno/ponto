@extends('layouts.pdfHtml')

@section('content')
    @foreach ($employees as $employee)

        @php
            $path = public_path('/images/logo/logo_instituicao.png');
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        @endphp

        <table class="header">
            <tr>
                <td class="text-center" width="4%" rowspan="6">
                    <img class="logo" src="{{ $base64 }}"/>
                </td>
                <td class='header-style header-border' colspan="5">
                    SECRETRIA DA SEGURANÇA PÚBLICA
                    <br>
                    <strong>{{ Config::get('app.interprise_name') }}</strong>
                </td>
                <td class="header-style text-center titulo-documento" colspan="5">
                    FOLHA DE FREQUÊNCIA MENSAL
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Nome:</strong>
                    {{ $employee->name }}
                </td>
                <td colspan="5" rowspan="4" class="text-center">
                    <strong>Referência:</strong>
                    {{ $month }} de {{ $year }}
                </td>
            </tr>
            <tr>
                <td width="50%" >
                    <strong>Lotação:</strong> {{ $employee->getDepartament->name }}
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Cargo:</strong>
                    {{ $employee->getPosition->name }}
                </td>
            </tr>
            <tr>
                <td width="20%">
                    <strong>Matrícula:</strong> {{ $employee->matriculation }}
                </td>
            </tr>
        </table>

        <table class="styled-table" border='1'>
            <thead>
                <tr>
                    <th class="text-center text-middle" width='3%' rowspan="3">DIA</th>
                    <th class="text-center" width='90%' colspan="8">JORNADA DE TRABALHO EXECUTADA</th>
                    <th class="text-center text-middle" width='5%' rowspan="3"  >CONTÉM ANOTAÇÃO NO VERSO</th>
                </tr>
                <tr>
                    <th class="text-center" colspan="2">ENTRADA</th>
                    <th class="text-center" colspan="2">SAÍDA</th>
                    <th class="text-center" colspan="2">ENTRADA</th>
                    <th class="text-center" colspan="2">SAÍDA</th>
                </tr>
                <tr>
                    <th class="text-center text-small" width='3%'>Horário</th>
                    <th class="text-center text-small">Rubrica</th>
                    <th class="text-center text-small" width='3%'>Horário</th>
                    <th class="text-center text-small">Rubrica</th>
                    <th class="text-center text-small" width='3%'>Horário</th>
                    <th class="text-center text-small">Rubrica</th>
                    <th class="text-center text-small" width='3%'>Horário</th>
                    <th class="text-center text-small">Rubrica</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($arr_days as $day)
                    <tr>
                        <td class="text-center" width="3%">
                            <span>{{ $day['day'] }}</span>
                            <span class="text-middle">{{ mb_substr($day['week_day'], 0, 3) }}</span>
                        </td>
                        <td class="text-center">:</td>
                        <td class="text-center">
                            {{ ($day['raw_day'] == 0 || $day['raw_day'] == 6) ? '*** DESCANSO ***':'' }}
                        </td>
                        <td class="text-center">:</td>
                        <td class="text-center"></td>
                        <td class="text-center">:</td>
                        <td class="text-center"></td>
                        <td class="text-center">:</td>
                        <td class="text-center"></td>
                        <td class="text-center">
                            --- <input type="checkbox"/>
                        </td>
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
