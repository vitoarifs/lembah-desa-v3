<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sedang Dalam Pemeliharaan -
        @if ($siteIdentity?->nama_website)
            {{$siteIdentity->nama_website}}
        @else
            Lembah Desa
        @endif
    </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-stone-950 text-stone-100 antialiased">
    <main class="min-h-screen flex items-center justify-center px-6">
        <div class="w-full max-w-lg text-center">
            <p class="text-amber-500 text-sm font-medium tracking-[0.25em] uppercase">
                @if ($siteIdentity?->nama_website)
                    {{$siteIdentity->nama_website}}
                @else
                    Lembah Desa
                @endif
            </p>

        <div class="mt-6">
            <h1 class="text-8xl sm:text-9xl font-serif font-bold text-stone-200">
                503
            </h1>

            <h2 class="mt-4 text-2xl sm:text-3xl font-serif font-semibold text-stone-100">
                Sedang Dalam Pemeliharaan
            </h2>

            <p class="mt-4 text-sm sm:text-base leading-relaxed text-stone-400 max-w-md mx-auto">
                Lembah Desa sedang melakukan pemeliharaan.
                Silakan kembali beberapa saat lagi.
            </p>
        </div>

        <div class="mt-8">
            <a
                href="{{ route('home.index') }}"
                class="inline-flex items-center justify-center rounded-lg bg-amber-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 focus:ring-offset-stone-950"
            >
                Kembali ke Beranda
            </a>
        </div>
    </div>
</main>

</body>
</html>
