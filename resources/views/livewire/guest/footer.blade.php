<footer class="bg-stone-950 text-stone-300 pt-16 pb-8 border-t border-amber-900/20 relative overflow-hidden">

    <!-- Efek Pendar Cahaya Senja (Background Gradient Accent) -->
    <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-[600px] h-[250px] bg-gradient-to-b from-amber-600/10 via-orange-600/5 to-transparent blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-8 mb-12">

            <!-- BRAND & DESKRIPSI -->
            <div class="space-y-4">

                <a href="#beranda" class="flex items-center gap-3">

                    @if ($siteIdentity?->logo)
                        <div class="w-10 h-10 rounded-full bg-stone-900 border border-stone-800 flex items-center justify-center overflow-hidden shrink-0">
                            <img
                                src="{{ \Illuminate\Support\Facades\Storage::url($siteIdentity->logo) }}"
                                alt="{{ $siteIdentity->nama_website ?? 'Logo Website' }}"
                                class="w-full h-full object-cover"
                            >
                        </div>
                    @else
                        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-amber-600 to-orange-500 flex items-center justify-center text-white shadow-md shadow-orange-950/30">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"
                                />
                            </svg>
                        </div>
                    @endif

                    <div class="flex flex-col">

                        <span class="font-bold text-2xl text-white tracking-tight font-serif leading-none">
                            {{ $siteIdentity?->nama_website ?? 'Lembah Desa' }}
                        </span>

                        @if ($siteIdentity?->tagline)
                            <span class="text-[10px] uppercase tracking-widest font-semibold text-amber-400/90 mt-0.5">
                                {{ $siteIdentity->tagline }}
                            </span>
                        @endif

                    </div>

                </a>


                @if ($siteIdentity?->deskripsi_singkat)
                    <p class="text-stone-400 text-sm leading-relaxed">
                        {{ $siteIdentity->deskripsi_singkat }}
                    </p>
                @endif


                <!-- SOSIAL MEDIA -->
                @if (
                    $siteIdentity?->link_instagram ||
                    $siteIdentity?->link_facebook ||
                    $siteIdentity?->link_tiktok ||
                    $siteIdentity?->link_youtube
                )
                    <div class="pt-2 flex items-center gap-3">

                        {{-- Instagram --}}
                        @if ($siteIdentity?->link_instagram)
                            <a
                                href="{{ $siteIdentity->link_instagram }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="w-9 h-9 rounded-full bg-stone-900 border border-stone-800 flex items-center justify-center text-stone-400 hover:text-amber-400 hover:border-amber-500/50 transition-all duration-200"
                                aria-label="Instagram"
                            >
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.79 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            </a>
                        @endif


                        {{-- Facebook --}}
                        @if ($siteIdentity?->link_facebook)
                            <a
                                href="{{ $siteIdentity->link_facebook }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="w-9 h-9 rounded-full bg-stone-900 border border-stone-800 flex items-center justify-center text-stone-400 hover:text-amber-400 hover:border-amber-500/50 transition-all duration-200"
                                aria-label="Facebook"
                            >
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
                                </svg>
                            </a>
                        @endif


                        {{-- TikTok --}}
                        @if ($siteIdentity?->link_tiktok)
                            <a
                                href="{{ $siteIdentity->link_tiktok }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="w-9 h-9 rounded-full bg-stone-900 border border-stone-800 flex items-center justify-center text-stone-400 hover:text-amber-400 hover:border-amber-500/50 transition-all duration-200"
                                aria-label="TikTok"
                            >
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M19.589 6.686a4.793 4.793 0 01-3.77-1.89A4.793 4.793 0 0115.003 2h-3.51v13.607a2.592 2.592 0 11-2.591-2.592c.178 0 .353.018.52.052v-3.55a6.146 6.146 0 00-.52-.022 6.112 6.112 0 106.112 6.112V8.706a8.286 8.286 0 004.575 1.372V6.566a4.813 4.813 0 01-0.001.12z"/>
                                </svg>
                            </a>
                        @endif


                        {{-- YouTube --}}
                        @if ($siteIdentity?->link_youtube)
                            <a
                                href="{{ $siteIdentity->link_youtube }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="w-9 h-9 rounded-full bg-stone-900 border border-stone-800 flex items-center justify-center text-stone-400 hover:text-amber-400 hover:border-amber-500/50 transition-all duration-200"
                                aria-label="YouTube"
                            >
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M23.498 6.186a2.999 2.999 0 00-2.113-2.122C19.505 3.5 12 3.5 12 3.5s-7.505 0-9.385.564A2.999 2.999 0 00.502 6.186 31.045 31.045 0 000 12a31.045 31.045 0 00.502 5.814 2.999 2.999 0 002.113 2.122C4.495 20.5 12 20.5 12 20.5s7.505 0 9.385-.564a2.999 2.999 0 002.113-2.122A31.045 31.045 0 0024 12a31.045 31.045 0 00-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                </svg>
                            </a>
                        @endif

                    </div>
                @endif

            </div>


            <!-- NAVIGASI PINTAS -->
            <div class="space-y-4">

                <h3 class="text-white font-semibold text-base font-serif tracking-wide border-b border-amber-900/40 pb-2 inline-block">
                    Navigasi
                </h3>

                <ul class="space-y-2.5 text-sm">
                    <li>
                        <a
                            href="{{ route('home.index') }}"
                            class="text-stone-400 hover:text-amber-400 transition-colors duration-200"
                        >
                            Beranda
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ route('kuliner.index') }}"
                            class="text-stone-400 hover:text-amber-400 transition-colors duration-200"
                        >
                            Menu Populer
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ route('event.index') }}"
                            class="text-stone-400 hover:text-amber-400 transition-colors duration-200"
                        >
                            Event & Acara
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ route('kontak-kami.index') }}"
                            class="text-stone-400 hover:text-amber-400 transition-colors duration-200"
                        >
                            Kontak & Lokasi
                        </a>
                    </li>
                </ul>

            </div>


            <!-- JAM OPERASIONAL -->
            <div class="space-y-4">

                <h3 class="text-white font-semibold text-base font-serif tracking-wide border-b border-amber-900/40 pb-2 inline-block">
                    Jam Operasional
                </h3>

                @if ($siteIdentity?->jam_operasional)

                    <div class="space-y-3 text-sm text-stone-400">

                        <div class="flex justify-between items-start gap-4 border-b border-stone-800/60 pb-2">

                            <span>
                                Jam buka
                            </span>

                            <span class="text-amber-300 font-medium text-right">
                                {{ $siteIdentity->jam_operasional }}
                            </span>

                        </div>

                    </div>

                @else

                    <p class="text-sm text-stone-500">
                        Informasi jam operasional belum tersedia.
                    </p>

                @endif

            </div>


            <!-- LOKASI & KONTAK -->
            <div class="space-y-4">

                <h3 class="text-white font-semibold text-base font-serif tracking-wide border-b border-amber-900/40 pb-2 inline-block">
                    Lokasi & Kontak
                </h3>

                <ul class="space-y-3 text-sm text-stone-400">

                    {{-- Alamat --}}
                    @if ($siteIdentity?->alamat)
                        <li class="flex items-start gap-3">

                            <svg
                                class="w-5 h-5 text-amber-500 shrink-0 mt-0.5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                />
                            </svg>

                            <span>
                                {{ $siteIdentity->alamat }}
                            </span>

                        </li>
                    @endif


                    {{-- WhatsApp --}}
                    @if ($siteIdentity?->nomor_whatsapp)
                        <li class="flex items-center gap-3">

                            <svg
                                class="w-5 h-5 text-amber-500 shrink-0"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                                />
                            </svg>

                            <a
                                href="https://wa.me/{{ preg_replace('/\D+/', '', $siteIdentity->nomor_whatsapp) }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="hover:text-amber-400 transition-colors"
                            >
                                {{ $siteIdentity->nomor_whatsapp }}
                            </a>

                        </li>
                    @endif


                    {{-- Email --}}
                    @if ($siteIdentity?->email)
                        <li class="flex items-center gap-3">

                            <svg
                                class="w-5 h-5 text-amber-500 shrink-0"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 8l9 6 9-6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                />
                            </svg>

                            <a
                                href="mailto:{{ $siteIdentity->email }}"
                                class="hover:text-amber-400 transition-colors break-all"
                            >
                                {{ $siteIdentity->email }}
                            </a>

                        </li>
                    @endif

                </ul>


                {{-- Google Maps --}}
                @if ($siteIdentity?->link_gmaps)
                    <div class="pt-1">

                        <a
                            href="{{ $siteIdentity->link_gmaps }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex items-center gap-2 text-xs font-medium text-amber-400 hover:text-amber-300 underline underline-offset-4 transition-colors"
                        >

                            <span>
                                Petunjuk Arah Google Maps
                            </span>

                            <svg
                                class="w-3.5 h-3.5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"
                                />
                            </svg>

                        </a>

                    </div>
                @endif

            </div>

        </div>


        <!-- BOTTOM COPYRIGHT BAR -->
        <div class="border-t border-stone-800/80 pt-6 mt-6 flex flex-col md:flex-row items-center justify-between text-xs text-stone-500 gap-4">

            <p>
                © {{ date('Y') }}
                {{ $siteIdentity?->nama_website ?? 'Lembah Desa' }}.
                All rights reserved.
            </p>

            <div class="flex items-center gap-6">

                <a
                    href="#"
                    class="hover:text-amber-400 transition-colors"
                >
                    Kebijakan Privasi
                </a>

                <a
                    href="#"
                    class="hover:text-amber-400 transition-colors"
                >
                    Syarat & Ketentuan
                </a>

            </div>

        </div>

    </div>
</footer>