<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Himpunan Mahasiswa Teknik Informatika atau yang dikenal dengan HM-TIF adalah sebuah organisasi mahasiswa dalam lingkup program studi Teknik Informatika, Fakultas Ilmu Komputer, Universitas Muhammadiyah Riau. Saat ini HM-TIF memiliki 6 divisi yaitu Kaderisasi & Advokasi, PSDM, Humas, Kerohanian, Kominfo dan Kewirausahaan.">
    <meta name="keywords" content="HM-TIF, Himpunan Mahasiswa Teknik Informatika, Universitas Muhammadiyah Riau">
    <meta name="author" content="Divisi Kominfo HM-TIF">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="HM-TIF (Himpunan Mahasiswa Teknik Informatika) UMRI">
    <meta property="og:description" content="Himpunan Mahasiswa Teknik Informatika atau yang dikenal dengan HM-TIF adalah sebuah organisasi mahasiswa dalam lingkup program studi Teknik Informatika, Fakultas Ilmu Komputer, Universitas Muhammadiyah Riau. Saat ini HM-TIF memiliki 6 divisi yaitu Kaderisasi & Advokasi, PSDM, Humas, Kerohanian, Kominfo dan Kewirausahaan.">
    <meta property="og:image" content="{{ asset('assets/img/banner/2.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="{{ asset('assets/img/banner/2.png') }}">

    <title>{{ isset($title) ? $title . ' |' : '' }} HM-TIF (Himpunan Mahasiswa Teknik Informatika) UMRI</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">
    <link href="https://api.fontshare.com/v2/css?f[]=zodiak@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/yesiamrocks/cssanimation.io@1.0.3/cssanimation.min.css" rel="stylesheet">

    <script src="{{ asset('js/app.js') }}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
