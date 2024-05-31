<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reports</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .d-none {
            display: none;
        }

        table,
        td,
        th {
            border: 1px solid;
        }

        td {
            font-size: 12px;
        }

        th {
            font-size: 14px;
        }

        td,
        th {
            padding: 4px;
        }

        hr {
            margin: 4px;
        }

        h1 {
            text-align: center;
        }

        h2,
        h3,
        h5 {
            margin: 5px;
        }

        .text-start {
            text-align: left;
        }

        .text-end {
            text-align: right;
        }

        th {
            height: 15px;
        }

        table.no-borders table,
        table.no-borders th,
        table.no-borders td {
            border: 0;
        }

        .no-borders {
            border: 0;
        }

        table {
            width: 100%;
            text-align: center;
            border-collapse: collapse;

            margin-bottom: 15px;
        }

        .table-dark {
            background: black;
            color: white;
            border: 1px solid black;
        }

        p {
            margin: 0;
        }

        .txt-center {
            text-align: center;
        }

        .center {
            display: block;
            justify-content: center;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
        }

        .d-flex {
            display: flex;
        }

        .float-end {
            float: right;
        }

        .flex-container {
            display: flex;
            flex-flow: row wrap;
        }

        .flex-container>div {
            background-color: #f1f1f1;
            width: 250px;
            margin: 10px;
            text-align: center;
        }

        .grid-container {
            display: grid;
            grid-template-columns: auto auto auto;
            padding: 12px;
        }
    </style>
</head>

<body>
    {{-- header --}}
    <header>
        {{-- <img src="{{ public_path('storage/images/aclc.png') }}" alt="" width="60"> --}}
        <h1 class="txt-ceneter">ACLC College of Ormoce Inc. @include('components.title')</h1>
    </header>

    <div style="width: 100%">
        @yield('content')
    </div>

    {{-- footer --}}
    <footer class="footer" style="font-size: 12px">
        <p>A pdf report : {{ date('l jS \of F Y h:i:s A') }} By Mr. Dirty Rat</p>
    </footer>
</body>

</html>
