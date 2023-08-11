<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Icon Plus</title>
        <link rel="icon" href="assets/logo.png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <nav class="w-full bg-white flex items-center justify-center" style="height: 10vh;">
            <a href="/">
                <img class="w-2/12 sm:w-1/12 mx-auto" src="/assets/logo.png" alt="Photo of PLN" />
            </a>
        </nav>
        <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 xs:" style="height: 90vh;">
            <div class="text-center font-medium">
                <h1 class="text-2xl">Hello!</h1>
                <h3>Surat Penugasan</h3>
            </div>
            <div class="w-full sm:max-w-3xl mt-6 px-6 py-4 bg-white overflow-hidden sm:rounded-sm">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
