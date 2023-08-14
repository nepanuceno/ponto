@extends('layouts.pdfHtml')

@section('content')
    @foreach ($employees as $employee)

        <table class="header">
            <tr>
                <td colspan="2" width="25%">
                    <img
                        src="data:image/jpeg;base64,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/wDE1yUcI6WJlUj8LX4iUbO57V3oyc8ivGR8crn/AKAMX/gSf/iaU/HO5H/MBi/8CT/8TXeUezd6gvMm0kx6V4//AMLyuOv9gxf+BJ/+JpD8crggg6DER/18n/4mlJXTQ4uzTPZIj+6TjsKrXh3XEUTuUiPUjueeK8l/4XlcY/5AMX/gSf8A4mmv8b5pBh/D0DD0NwT/AOy1MoXjYuE1GXMz1hwjXCxPJtgCZU54J471B9ouEaNYjvUMwGerAYry0/Gx2QIfDlvtHQfaOn/jtKPjdKNuPD0A29MXB4/8drJ0ZN6Oxqq8UtVc9QnnuHEvmKVGIyqDrgvimzCWIpvjfYTlUDDIrzE/G+Zzk+H4CeOtwe3/AAGlb43zsQToEOR0/wBJP/xNS8O3e8iliYq1onqceZTClxLtTywQc43Hvz/nrTRPcKY1iYuolYAn+JQoP+NeWN8bJGUK3h23IHQGfp/47Sr8bphjHh+AbemLg8f+O0/YS7/1oL28e3+XU9QkuLiR5DIPLGAQvccipt5iuZAXDeYWw4P3ee4rylvjdKck+HoCT1zcn/4mk/4XZJksPDtuGPU+f/8AY0exle9w9vC1uU9TWZ4oHgB5ypaRTkYJwanh2xXaJBKZEZcsM5x715IvxskRWC+HbcBuuLg8/wDjtLH8bZYvueHoFz6XBH/stONGSa1FKvFp2R6222S8kFxIUCY2LnAPvUTlX895pmSVCdi56ADjHrXlLfGySQ5fw7Ax7ZuCcf8AjtI3xskY7n8O27H1Nxz/AOg0Ok3/AF/WwRrRX9L+tep6ql1drMfk3rtGVHUe9WLTzLiylWZsSF3UkduSK8lHxvnDbhoEIJ/6eT/8TSD44TqSF0CEAnJxcn/4mnGlJPWV1qKdaLWkbPT8D1ITXEsbSvuTZtRuOnPzH8jTnYwSL9lkMhYfMM5wMda8sHxwnwR/YEOD1/0k8/8AjtNX42SRk7PD1uueuLgj/wBlqfYS7/Mr6xHt8uh6pL5a6ZJIkpaVo8tluc/TtXm3xkVU0PSQqqp+0PwGz/CKpn41Ng/8U5b89f3/AF/8drmfGXjtvF1pa250yOzFvIz5STduyMegqoUnGSfkTOqpRcV3P//Z/+EPBWh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8APD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNC40LjAtRXhpdjIiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczppcHRjRXh0PSJodHRwOi8vaXB0Yy5vcmcvc3RkL0lwdGM0eG1w
                            RXh0LzIwMDgtMDItMjkvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIgeG1sbnM6cGx1cz0iaHR0cDovL25zLnVzZXBsdXMub3JnL2xkZi94bXAvMS4wLyIgeG1sbnM6R0lNUD0iaHR0cDovL3d3dy5naW1wLm9yZy94bXAvIiB4bWxuczpkYz0iaHR0cDovL3B1cmwub3JnL2RjL2VsZW1lbnRzLzEuMS8iIHhtbG5zOmV4aWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20vZXhpZi8xLjAvIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOkRvY3VtZW50SUQ9ImdpbXA6ZG9jaWQ6Z2ltcDphZDJkNWFhMy0yZmZlLTRiYmItODJmNi1jNjNmNjY4MTNkMzEiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6OTU4NDEwMjktMWM1ZC00NWE4LTgyZWYtNzNlNjMxYTQxOGRmIiB4bXBNTTpPcmlnaW5hbERvY3VtZW50SUQ9InhtcC5kaWQ6MjE1ZTU3M2MtNmNhMy00Y2UyLTgxMTgtZmQxODkwOGIwODZjIiBHSU1QOkFQST0iMi4wIiBHSU1QOlBsYXRmb3JtPSJNYWMgT1MiIEdJTVA6VGltZVN0YW1wPSIxNjQwNTcwOTQ1NzM0MjU2IiBHSU1QOlZlcnNpb249IjIuMTAuMTQiIGRjOkZvcm1hdD0iaW1hZ2UvanBlZyIgZXhpZjpQaXhlbFhEaW1lbnNpb249IjE4MCIgZXhpZjpQaXhlbFlEaW1lbnNpb249IjY2IiB4bXA6Q3JlYXRvclRvb2w9IkdJTVAgMi4xMCI+IDxpcHRjRXh0OkxvY2F0aW9uQ3JlYXRlZD4gPHJkZjpCYWcvPiA8L2lwdGNFeHQ6TG9jYXRpb25DcmVhdGVkPiA8aXB0Y0V4dDpMb2NhdGlvblNob3duPiA8cmRmOkJhZy8+IDwvaXB0Y0V4dDpMb2NhdGlvblNob3duPiA8aXB0Y0V4dDpBcnR3b3JrT3JPYmplY3Q+IDxyZGY6QmFnLz4gPC9pcHRjRXh0OkFydHdvcmtPck9iamVjdD4gPGlwdGNFeHQ6UmVnaXN0cnlJZD4gPHJkZjpCYWcvPiA8L2lwdGNFeHQ6UmVnaXN0cnlJZD4gPHhtcE1NOkhpc3Rvcnk+IDxyZGY6U2VxPiA8cmRmOmxpIHN0RXZ0OmFjdGlvbj0ic2F2ZWQiIHN0RXZ0OmNoYW5nZWQ9Ii8iIHN0RXZ0Omluc3RhbmNlSUQ9InhtcC5paWQ6ZTJkN2RjZTUtMDUwNS00NGI0LTlmOTQtYWExNjg1ZGJjZWFjIiBzdEV2dDpzb2Z0d2FyZUFnZW50PSJHaW1wIDIuMTAgKE1hYyBPUykiIHN0RXZ0OndoZW49IjIwMjEtMTItMjZUMjM6MDk6MDUtMDM6MDAiLz4gPC9yZGY6U2VxPiA8L3htcE1NOkhpc3Rvcnk+IDxwbHVzOkltYWdlU3VwcGxpZXI+IDxyZGY6U2VxLz4gPC9wbHVzOkltYWdlU3VwcGxpZXI+IDxwbHVzOkltYWdlQ3JlYXRvcj4gPHJkZjpTZXEvPiA8L3BsdXM6SW1hZ2VDcmVhdG9yPiA8cGx1czpDb3B5cmlnaHRPd25lcj4gPHJkZjpTZXEvPiA8L3BsdXM6Q29weXJpZ2h0T3duZXI+IDxwbHVzOkxpY2Vuc29yPiA8cmRmOlNlcS8+IDwvcGx1czpMaWNlbnNvcj4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+ICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPD94cGFja2V0IGVuZD0idyI/Pv/iArBJQ0NfUFJPRklMRQABAQAAAqBsY21zBDAAAG1udHJSR0IgWFlaIAflAAwA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" />
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
