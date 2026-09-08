<div class="relative">

    <header 
        x-data="{ isOpen: false }" 
        @keydown.escape.window="isOpen = false"
        class="fixed top-0 left-0 right-0 z-50 py-3 bg-stone-950/95 backdrop-blur-md border-b border-stone-800/80 shadow-lg shadow-black/20"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                
                <!-- LOGO & BRAND -->
                <a href="{{ route('home.index') }}" wire:navigate class="flex items-center gap-3 group focus:outline-none">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-amber-600 to-orange-500 flex items-center justify-center text-white shadow-md shadow-orange-950/50 group-hover:scale-105 transition-transform duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-bold text-xl sm:text-2xl tracking-tight font-serif leading-none text-stone-100">
                            Lembah<span class="text-amber-500">Desa</span>
                        </span>
                        <span class="text-[10px] uppercase tracking-widest font-semibold mt-0.5 text-amber-400/90">
                            Kuliner & Saung Senja
                        </span>
                    </div>
                </a>

                <!-- DESKTOP NAVIGATION -->
                <nav class="hidden md:flex items-center gap-1 lg:gap-2">
                    <!-- Beranda -->
                    <a href="{{ route('home.index') }}" wire:navigate
                    class="relative px-4 py-2 text-sm font-medium transition-all duration-200 rounded-full {{ request()->routeIs('home.index') ? 'text-amber-400 font-semibold bg-amber-500/10 border border-amber-500/20' : 'text-stone-300 hover:text-white hover:bg-stone-800/60' }}">
                        Beranda
                        @if(request()->routeIs('home.index'))
                            <span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-4 h-0.5 bg-orange-500 rounded-full"></span>
                        @endif
                    </a>

                    <!-- Menu Populer -->
                    <a href="{{ route('kuliner.index') }}" wire:navigate
                    class="relative px-4 py-2 text-sm font-medium transition-all duration-200 rounded-full {{ request()->routeIs('kuliner.index') ? 'text-amber-400 font-semibold bg-amber-500/10 border border-amber-500/20' : 'text-stone-300 hover:text-white hover:bg-stone-800/60' }}">
                        Menu Populer
                        @if(request()->routeIs('kuliner.index'))
                            <span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-4 h-0.5 bg-orange-500 rounded-full"></span>
                        @endif
                    </a>

                    <!-- Event & Acara -->
                    <a href="{{ route('event.index') }}" wire:navigate
                    class="relative px-4 py-2 text-sm font-medium transition-all duration-200 rounded-full {{ request()->routeIs('event.index') ? 'text-amber-400 font-semibold bg-amber-500/10 border border-amber-500/20' : 'text-stone-300 hover:text-white hover:bg-stone-800/60' }}">
                        Event & Acara
                        @if(request()->routeIs('event.index'))
                            <span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-4 h-0.5 bg-orange-500 rounded-full"></span>
                        @endif
                    </a>

                    <!-- Reservasi -->
                    <a href="{{ route('kontak-kami.index') }}"
                    class="relative px-4 py-2 text-sm font-medium transition-all duration-200 rounded-full {{ request()->routeIs('kontak-kami.index') ? 'text-amber-400 font-semibold bg-amber-500/10 border border-amber-500/20' : 'text-stone-300 hover:text-white hover:bg-stone-800/60' }}">
                        Kontak
                        @if(request()->routeIs('kontak-kami.index'))
                            <span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-4 h-0.5 bg-orange-500 rounded-full"></span>
                        @endif
                    </a>
                </nav>

                <!-- CALL TO ACTION (DESKTOP) -->
                <div class="hidden md:block">
                    <a 
                        href="{{ route('kontak-kami.index') }}" 
                        wire:navigate
                        class="inline-flex items-center justify-center px-5 py-2 text-sm font-medium text-white transition-all duration-300 bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-500 hover:to-orange-500 rounded-full shadow-md shadow-orange-950/40 hover:shadow-lg focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 focus:ring-offset-stone-950 active:scale-95"
                    >
                        Reservasi Sekarang
                    </a>
                </div>

                <!-- MOBILE HAMBURGER BUTTON -->
                <div class="flex md:hidden">
                    <button 
                        @click="isOpen = !isOpen" 
                        type="button" 
                        class="p-2 rounded-xl text-stone-300 hover:text-white hover:bg-stone-800/60 focus:outline-none transition-colors duration-200"
                        aria-label="Toggle Menu"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            <path x-show="isOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

            </div>
        </div>

        <!-- MOBILE NAVIGATION DROPDOWN -->
        <div 
            x-show="isOpen" 
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
            @click.away="isOpen = false"
            x-cloak
            class="md:hidden mx-4 mt-2 bg-stone-900/95 backdrop-blur-md border border-stone-800 shadow-2xl rounded-2xl p-4"
        >
            <div class="flex flex-col space-y-1">
                <!-- Beranda -->
                <a href="{{ route('home.index') }}" @click="isOpen = false" wire:navigate
                class="px-4 py-3 rounded-xl text-base font-medium transition-colors duration-150 {{ request()->routeIs('home.index') ? 'bg-amber-500/15 text-amber-400 font-semibold border border-amber-500/20' : 'text-stone-300 hover:bg-stone-800/60 hover:text-white' }}">
                    Beranda
                </a>

                <!-- Menu Populer -->
                <a href="{{ route('kuliner.index') }}" @click="isOpen = false" wire:navigate
                class="px-4 py-3 rounded-xl text-base font-medium transition-colors duration-150 {{ request()->routeIs('kuliner.index') ? 'bg-amber-500/15 text-amber-400 font-semibold border border-amber-500/20' : 'text-stone-300 hover:bg-stone-800/60 hover:text-white' }}">
                    Menu Populer
                </a>

                <!-- Event & Acara -->
                <a href="{{ route('event.index') }}" @click="isOpen = false" wire:navigate
                class="px-4 py-3 rounded-xl text-base font-medium transition-colors duration-150 {{ request()->routeIs('event.index') ? 'bg-amber-500/15 text-amber-400 font-semibold border border-amber-500/20' : 'text-stone-300 hover:bg-stone-800/60 hover:text-white' }}">
                    Event & Acara
                </a>

                <!-- Reservasi Saung -->
                <a href="{{ route('kontak-kami.index') }}" @click="isOpen = false" wire:navigate
                class="px-4 py-3 rounded-xl text-base font-medium transition-colors duration-150 {{ request()->routeIs('kontak-kami.index') ? 'bg-amber-500/15 text-amber-400 font-semibold border border-amber-500/20' : 'text-stone-300 hover:bg-stone-800/60 hover:text-white' }}">
                    Kontak
                </a>

                <!-- Button CTA Mobile -->
                <div class="pt-2">
                    <a 
                        href="{{ route('kontak-kami.index') }}" 
                        @click="isOpen = false"
                        wire:navigate
                        class="block w-full text-center px-4 py-3 text-base font-medium text-white bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-500 hover:to-orange-500 rounded-xl shadow-md transition-all"
                    >
                        Reservasi Sekarang
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="py-3 invisible pointer-events-none" aria-hidden="true"></div>
</div>