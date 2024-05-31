<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabulation</title>

    @vite(['resources/js/app.js'])
    <link rel="stylesheet" href="{{ url('bootstrap-icons/font/bootstrap-icons.css') }}">

    <style>
        .grd-tb-bg {
            background-image: linear-gradient(90deg, #343a40e8, #007bffd3 95%), url("{{ asset('storage/assets/img/ACLC_bg.jpg') }}");
            background-position: center;
            /* background-repeat: no-repeat; */
            /* background-size: cover; */
        }
        .grd-bg {
            /* background: linear-gradient(60deg, #007bff, #343a40 75%); */
            background-image: linear-gradient(30deg, #007bffd3, #343a40e8 95%), url("{{ asset('storage/assets/img/ACLC_bg.jpg') }}");
            background-position: center;
            /* background-repeat: no-repeat; */
            /* background-size: cover; */
        }
    </style>

    @yield('head-links')
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        @include('components.sidebar')

        <!-- Page content wrapper-->
        <div class="ps-3 pe-3 pb-3 content-fixed" id="page-content-wrapper">
            <!-- Top navigation-->
            @include('components.topbar')

            <!-- Page content-->
            <div class="container-fluid rounded-4 p-4 shadow text-light grd-bg">
                {{-- contents to be put --}}
                @yield('content')
            </div>
        </div>
    </div>

    @yield('body-links')
</body>

</html>
