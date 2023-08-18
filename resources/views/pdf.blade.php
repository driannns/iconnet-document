<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Icon Plus') }}</title>
    <link rel="icon" href="assets/logo.png">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <script src="https://unpkg.com/jspdf-invoice-template@1.4.0/dist/index.js"></script>
    <!-- <script src="js/index.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .times {
            font-family: TimesNewRoman;
            font-size: 17px;
            font-style: normal;
            font-variant: normal;
        }

        .calibri {
            font-family: Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif;
        }
        @page{
            margin:0;
        }

    </style>
</head>

<body class="h-fit w-full flex justify-center text-black">
    <div class="h-fit w-full flex justify-center">
        <div class="relative">
            <img class="" src="assets/template.png" alt="" width="900px">
            <div class="absolute h-full top-0" style="width: 684px; height: 956.63px; margin: 108px ">
                <div class="flex flex-col justify-center items-center">
                    <h1 class="font-bold calibri text-lg pt-6">SURAT TUGAS</h1>
                    <p class="times">Nomor: {{ Session::get('nosurat') }}.STg/KLH.02.01/IC010110/2023</p>
                </div>
                <div class="calibri pt-5">
                    <h2>Yang bertanda tangan di bawah ini :</h2>
                    <div class="flex pl-3">
                        <p class="w-4/12">Nama</p>
                        <p>Erdi Karsa Notowibowo</p>
                    </div>
                    <div class="flex pl-3">
                        <p class="w-4/12">Jabatan</p>
                        <p>Manager Kantor Perwakilan Kalimantan Selatan</p>
                    </div>
                </div>
                <div class="calibri pt-6">
                    <h2 class="pb-4">Menugaskan kepada :</h2>
                    <table class="w-11/12 border border-black mx-auto">
                        <thead class="bg-[#708fb5]">
                            <th class="border border-black">No</th>
                            <th class="border border-black">Nama</th>
                            <th class="border border-black">No. Hp</th>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <td class="border border-black">1</td>
                                <td class="border border-black">{{ Session::get('petugas')}}</td>
                                <td class="border border-black">{{ Session::get('nomor') }}</td>
                            </tr>
                            <tr>
                                <td class="border border-black">2</td>
                                <td class="border border-black">Novriansyah</td>
                                <td class="border border-black">083150823330</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="calibri pt-6">
                    <h2>Untuk melaksanakan tugas sebagai berikut: </h2>
                    <div class="flex pl-3">
                        <p class="w-4/12">Jenis Pekerjaan</p>
                        <p>: {{ Session::get('jenis')}}</p>
                    </div>
                    <div class="flex pl-3">
                        <p class="w-4/12">Lokasi Pekerjaan</p>
                        <p>: {{ Session::get('lokasi')}}</p>
                    </div>
                    <div class="flex pl-3">
                        <p class="w-4/12">Waktu Pengerjaan</p>
                        <p>: {{ Session::get('dari')}}  S/d {{ Session::get('sampai')}}</p>
                    </div>
                </div>
                <div class="calibri">
                    <h2>Surat Tugas ini dibuat untuk dilaksanakan sebaik-baiknya. </h2>
                </div>
                <div class="calibri pt-6">
                    <h2>Banjarbaru,  {{ Session::get('date') }}</h2>
                </div>
                <div class="pt-6">
                    <h2>Manager Kantor Perwakilan Kalsel</h2>
                    <img src="assets/sign.png" alt="" style="width: 115px">
                    <h2 class="-mt-4">Erdi Karsa Notowibowo</h2>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
