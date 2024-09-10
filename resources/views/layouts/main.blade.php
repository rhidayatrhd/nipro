<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <title> NIPRO Indonesia </title> -->
    <title>{{ config('app.name', 'NIPRO INDONESIA') }}</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('css/nijstyle.css') }} ">

    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-icons/font/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/themify-icons/themify-icons.css') }}">
    <link rel="icon" href="{{ asset('img/LogoNIPRO.ico') }}">

    @stack('css')

</head>

<body>
    @include('layouts.head')
    @yield('container')
    @include('layouts.foot')
    <!-- Bootstrap JS -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}">
    <!-- <link rel="stylesheet" href="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"> -->
    <script src="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/jquery.js') }}"></script>
    <script src="{{ asset('js/nijstyle.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    @stack('js')

    <script>
        Main.init()
    </script>
</body>

</html>