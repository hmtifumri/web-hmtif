<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}" type="image/x-icon">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#F5F7F8]">
            <div>
                <a href="/">
                   <img src="{{ asset('assets/img/logo.png') }}" class="mx-auto w-28" alt="Logo {{ config('app.name') }}">
                </a>
            </div>

            <div class="w-full max-w-2xl mt-6 p-8 bg-white shadow-lg shadow-gray-200 overflow-hidden rounded-xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
