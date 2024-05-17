<!DOCTYPE html>
<!-- <html lang="en"> -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta contentType="application/json"; charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <title>Nipro &mdash; Dashboard</title> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />

    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/perfect-scrollbar/css/perfect-scrollbar.css') }}">

    <!-- CSS for this page only -->

    @stack('css')
    <!-- End CSS  -->

    <link rel="stylesheet" href="{{ asset('assets/css/styletest.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-override.min.css') }}">
    <link rel="stylesheet" id="theme-color" href="{{ asset('assets/css/dark.min.css') }}">
</head>

<body>
    <div id="app">
        <div class="shadow-header"></div>

        @include('layouts.dashhead')
        @include('layouts.dashnav')

        @yield('content')
        @include('layouts.settings')

        <footer>
            Copyright © 2024 &nbsp <a href="/dashboard" target="_blank" class="ml-1"> PT. NIPRO INDONESIA JAYA </a> <span> . All rights Reserved</span>
        </footer>
        <div class="overlay action-toggle">
        </div>
    </div>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

    <!-- js for this page only -->
    @stack('js')

    <!-- ======= -->
    <!-- <script src="{{ asset('assets/js/main.min.js') }}"></script> -->
    <script src="{{ asset('assets/js/maintest.min.js') }}"></script>
    <script>
        Main.init()
    </script>
</body>

</html>