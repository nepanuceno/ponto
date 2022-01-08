<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    <!-- Styles -->
    {{-- <link rel="stylesheet" media="dompdf" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> --}}
    <style>
        @page {
            margin-top: 10;
            margin-bottom: 5;
            margin-left: 10;
            margin-right: 10;
        }
        .styled-table, .header {
            border-collapse: collapse;
            margin: 1px 0;
            font-size: 0.8em;
            font-family: sans-serif;
            min-width: 100%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }

        .styled-table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        }

        .styled-table th,
        .styled-table td {
            padding: 5px 5px;
        }

        .header th, td {
            padding: 5px;
            text-align: left;
        }

        .styled-table td {
            border: 1px solid #0000;
        }
        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        .styled-table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
        }
        .assinatura {
            text-align: center;
            margin-top: 20px;
            text-decoration: underline;
            font-size: 0.8em;
            font-family: sans-serif;
        }

    </style>
    <title>PDF</title>
</head>
<body>
    <main class="py-4">
        @yield('content')
    </main>
</body>
</html>
