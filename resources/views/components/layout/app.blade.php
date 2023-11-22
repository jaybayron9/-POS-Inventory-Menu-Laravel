<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>HotPlate POS</title>

        <script src="{{ asset('js/jquery.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset('js/sweetalert.min.js') }}"></script> 
        @vite(['resources/css/app.css','resources/js/app.js'])
        {{ $links ?? '' }}
    </head>
    <body class="overflow-x-hidden">
        <main>
            {{ $slot }}
        </main>
        {{ $scripts ?? '' }}
    </body>
</html>