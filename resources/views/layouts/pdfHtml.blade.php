<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <style>
        @page {
            margin-top: 5;
            margin-bottom: 5;
            margin-left: 5;
            margin-right: 5;
        }

        th, td {
            padding: 1px;
        }

        .header {
            border: none;
        }

        .styled-table {
            border: 1px solid black;
        }

        .styled-table, .header {
            border-collapse: collapse;
            margin: 1px 0;
            font-size: 0.7rem;
            font-family: sans-serif;
            min-width: 100%;
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

        .styled-table {
            border-collapse: collapse;
        }

        .styled-table th {
            border: 1px solid black;
        }

        .styled-table tbody > tr {
            border: 1px solid black;
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

        .assinaturas {
            margin-top: 10px;
            border: 1px black;
            border-style: solid;
            border-radius: 12px;
            width:100%;
        }

        .assinatura-data {
            text-align: right;
        }

        hr {
            margin: 10px 20px 2px 0;
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
