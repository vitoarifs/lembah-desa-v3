<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Lembah Desa Pulutan') }}</title>

        @if ($siteIdentity?->favicon)
            <link
                rel="icon"
                type="image/png"
                href="{{ asset('storage/' . ltrim($siteIdentity->favicon, '/')) }}"
            >
        @endif

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen flex flex-col bg-[#FAF8F5] text-stone-800 antialiased m-0 p-0 overflow-x-hidden selection:bg-emerald-800 selection:text-white">

        <!-- HEADER (Full-Width di Paling Atas) -->
        <livewire:guest.header />

        <!-- MAIN CONTENT (Memenuhi Sisa Layar dengan Latar Krem Pedesaan) -->
        <main class="flex-grow">
            {{ $slot }}
        </main>

        <!-- FOOTER (Full-Width Hijau Hutan Pedesaan di Paling Bawah) -->
        <livewire:guest.footer />

    </body>
</html>