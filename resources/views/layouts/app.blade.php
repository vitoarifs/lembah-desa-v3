<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Lembah Desa') }}</title>
    @if ($siteIdentity?->favicon)
        <link rel="icon" type="image/png" href="{{ asset('storage/' . ltrim($siteIdentity->favicon, '/')) }}">
    @endif
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased bg-stone-950 text-stone-100">
    <div x-data="{ sidebarOpen: false }" class="min-h-screen bg-stone-950">
        <livewire:layout.navigation />
        <div class="lg:pl-64 min-h-screen">
            <header class="sticky top-0 z-30 flex h-16 items-center border-b border-stone-800 bg-stone-950/95 backdrop-blur lg:hidden">
                <button type="button" @click="sidebarOpen = true" class="inline-flex items-center justify-center rounded-xl p-2 text-stone-400 transition-colors hover:bg-stone-900 hover:text-stone-100 focus:outline-none focus:ring-2 focus:ring-amber-500/50" aria-label="Open navigation">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <div class="ml-3 flex min-w-0 items-center gap-2">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center overflow-hidden">
                    @if ($siteIdentity?->logo)
                        <img
                            src="{{ asset('storage/' . $siteIdentity->logo) }}"
                            alt="{{ $siteIdentity->nama_website ?? 'Logo' }}"
                            class="h-full w-full object-contain"
                        >
                    @else
                        <x-application-logo class="h-6 w-auto fill-current text-amber-500" />
                    @endif
                </div>

                    <span class="truncate text-sm font-semibold text-stone-100">
                        {{ config('app.name', 'Lembah Desa') }}
                    </span>
                </div>
            </header>
            @if (isset($header))
                <header class="border-b border-stone-800 bg-stone-950">
                    <div class="mx-auto max-w-7xl px-4 py-5 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
            <main class="min-h-[calc(100vh-4rem)] bg-stone-950">
                {{ $slot }}
            </main>
        </div>
    </div>
    @livewireScripts
</body>
</html>