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

<body class="font-sans text-gray-900 antialiased relative">

    <div class="relative top-0 left-0 w-full min-h-screen z-50">
        <div class="absolute w-full h-screen opacity-20"
            style="background-image: url('assets/wallpaper.png'); background-size: cover; background-repeat: no-repeat; background-position: center;">
        </div>

            <nav class="w-full bg-white flex items-center justify-center gap-x-3" style="height: 10vh;">
                <img src="{{ asset('assets/logo_kampus.png') }}" alt="Logo Kampus" class="w-14">
                <img class="w-1/12" src="/assets/logo.png" alt="Photo of PLN" />
            </nav>
            <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 xs:"
                style="height: 90vh;">
                <div class="text-center font-medium">
                    <h1 class="text-2xl">Hello!</h1>
                    <h3>Pembuatan Surat Perintah Perjalanan Dinas (SPPD)</h3>
                    <h3>PT ICON PLUS KANTOR PERWAKILAN KALIMANTAN SELATAN</h3>
                </div>
                <div class="z-50 w-full sm:max-w-3xl mt-6 px-6 py-4 bg-white overflow-hidden rounded-lg">
                    {{ $slot }}
                </div>
            </div>
    </div>
</body>

</html>
