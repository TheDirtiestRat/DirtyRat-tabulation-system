<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content>
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap
      contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>Sign in</title>

    @vite(['resources/js/app.js'])

    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;

            box-shadow: inset 0 0 5rem rgba(0, 0, 0, .5);
        }

        .form-signin {
            max-width: 330px;
            padding: 15px;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="text"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .grd-bg {
            /* background: linear-gradient(60deg, #007bffd3, #343a40e8 75%); */
            background-image: linear-gradient(30deg, #007bffd3, #343a40e8 75%), url("{{ asset('storage/assets/img/ACLC_bg.jpg') }}");
            background-position: center;
            background-repeat: no-repeat;
            /* background-size: cover; */
        }
    </style>
</head>

<body class="text-center grd-bg">

    <main class="form-signin w-100 m-auto">
        <form action="{{ url('loginUser') }}" method="POST">
            {{-- for validation --}}
            @csrf

            {{-- <img class="mb-2" src="{{ asset('storage/images/aclc.png') }}" alt width="72"> --}}
            <h1 class="mb-3 text-light fw-normal">@include('components.title')</h1>

            {{-- alert --}}
            @include('components.alert')

            <div class="text-bg-dark rounded-4 p-3 pb-4">
                <p>
                    Log-in to your user account to enter the system.
                </p>

                <div class="form-floating text-dark">
                    <input type="text" class="form-control" id="floatingInput" name="name" placeholder="Username">
                    <label for="floatingInput">Username</label>
                </div>
                <div class="form-floating text-dark">
                    <input type="password" class="form-control" id="floatingPassword" name="password"
                        placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>

                <div class="checkbox mb-2">
                    <label>
                        <a href="{{ url('/') }}" class=" text-decoration-none text-muted">Welcom Page</a>
                    </label>
                </div>

                <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
            </div>

            <div class="mt-2 mb-3 text-light">@include('components.copyright')</div>
        </form>
    </main>

</body>

</html>
