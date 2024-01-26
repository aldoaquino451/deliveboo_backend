<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- font awesome  --}}
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.css'
        integrity='sha512-tx5+1LWHez1QiaXlAyDwzdBTfDjX07GMapQoFTS74wkcPMsI3So0KYmFe6EHZjI8+eSG0ljBlAQc3PQ5BTaZtQ=='
        crossorigin='anonymous' />

    {{-- Vue --}}
    <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/3.4.15/vue.cjs.js'
        integrity='sha512-v43CHylp2byK4H0o5WYD3XvfXhDD2infaA/ObwTLKru+zYNNCzye3Z1lv3dWZo0MGrTiXU+nhqPg/BH6HCwGuA=='
        crossorigin='anonymous'></script>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400;1,700&family=Montserrat:ital,wght@0,400;0,700;1,400;1,700&family=Roboto:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">

    <!-- Includi Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])

</head>

<body>
    <div id="app">

        <header class="header-login text-white">

            <div class="container d-flex justify-content-between align-items-center">

                <a href="{{ url('http://localhost:5174/') }}"" class="home fs-4"><i class="fa-solid fa-house"></i></a>

                <h1 class="logo text-center">Deliveboo</h2>

                    <div class="d-flex justify-content-end action">
                        @if (!Route::is('login'))
                            <a class="nav-link me-3 btn p-1" href="{{ route('login') }}">{{ __('Accedi') }}</a>
                        @endif

                        @if (Route::has('register'))
                            <a class="nav-link  btn p-1" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                        @endif
                    </div>

            </div>

        </header>

        <main>
            @yield('content')
        </main>

    </div>

    @yield('script')

</body>

</html>
