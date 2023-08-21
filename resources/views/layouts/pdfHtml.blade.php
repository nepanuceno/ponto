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
            margin-top: 5;
            margin-bottom: 5;
            margin-left: 5;
            margin-right: 5;
        }
        .styled-table, .header {
            border-collapse: collapse;
            margin: 1px 0;
            font-size: 0.7rem;
            font-family: sans-serif;
            min-width: 100%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }

        .styled-table thead tr {
            background-color: #ffffff;
            color: #000000;
            /* text-align: left; */
        }

        .styled-table th,
        .styled-table td {
            padding: 5px 5px;
        }

        .header th, td {
            padding: 2px 4px;
            text-align: left;
        }

        .header tr td {
            padding: 1px;
        }

        .header-style {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 1.2em;
        }

        .header-border {
            border: 1px solid black;
            border-bottom: 1px;
            border-top-style:hidden;
            border-left-style: hidden;
            border-right-style: solid;
            border-bottom-style: solid;
        }

        .titulo-documento {
            border: 1px solid black;
            border-top-style: hidden;
            border-right-style: hidden;
        }

        .styled-table tr {
            padding: 1px 1px;
            border-left-style: hidden;
            border-right-style: hidden;
        }

        .styled-table td {
            padding: 1px 1px;
        }

        /* .styled-table td {
            border: 1px solid #0000;
        } */
        /* .styled-table tbody tr {
            border-bottom: 1px solid #050000;
        } */

        /* .styled-table tbody tr:nth-of-type(even) {
            background-color: #f0ebeb;
        } */

        /* .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        } */

        /* .styled-table tbody tr.active-row {
            font-weight: 300;
            color: #009879;
        } */
        .assinatura {
            text-align: center;
            margin-top: 20px;
            text-decoration: underline;
            font-size: 0.8em;
            font-family: sans-serif;
        }

        .logo {
            width: 85px;
            height: 110px;
        }
        .text-center {
            text-align: center;
        }
        .text-middle {
            font-size: 0.5rem;
            font-weight: 400 !important;
        }
        .text-small {
            font-size: 0.6rem;
            font-weight: 200 !important;
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
