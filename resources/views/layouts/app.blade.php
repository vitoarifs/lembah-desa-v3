<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap"
        rel="stylesheet"
    />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="font-sans antialiased bg-gray-100 text-gray-900">

    <!-- Global Alpine State -->
    <div
        x-data="{ sidebarOpen: false }"
        class="min-h-screen"
    >

        <!-- Sidebar -->
        <livewire:layout.navigation />

        <!-- Main Content Area -->
        <div class="lg:pl-64">

            <!-- Mobile Header -->
            <header
                class="sticky top-0 z-30 flex h-16 items-center border-b border-gray-200 bg-white px-4 shadow-sm lg:hidden"
            >
                <!-- Hamburger -->
                <button
                    type="button"
                    @click="sidebarOpen = true"
                    class="inline-flex items-center justify-center rounded-lg p-2 text-gray-500 transition hover:bg-gray-100 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-300"
                    aria-label="Open navigation"
                >
                    <svg
                        class="h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>
                </button>

                <!-- Mobile App Name -->
                <span class="ml-3 text-lg font-semibold text-gray-800">
                    {{ config('app.name', 'Laravel') }}
                </span>
            </header>

            <!-- Page Heading -->
            @if (isset($header))
                <header class="border-b border-gray-200 bg-white">
                    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="min-h-[calc(100vh-4rem)]">
                {{ $slot }}
            </main>

        </div>
    </div>

    @livewireScripts
</body>
</html>