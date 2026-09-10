<section class="min-h-screen bg-stone-950 text-stone-100 font-sans">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-20">

        {{-- =========================================================
            HERO
        ========================================================== --}}
        <header class="border-b border-stone-800 pb-10 lg:pb-12 mb-12 lg:mb-16">

            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 lg:gap-12">

                <div class="max-w-3xl">

                    <span class="inline-flex items-center gap-2 text-amber-500 text-[11px] sm:text-xs font-semibold uppercase tracking-[0.2em]">
                        <span class="w-6 h-px bg-amber-500"></span>
                        Cita Rasa Otentik
                    </span>

                    <h1 class="mt-3 font-serif text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-bold text-stone-100 leading-[1.1]">
                        Petualangan Kuliner
                        <span class="text-amber-500">Lembah Desa</span>
                    </h1>

                </div>

                <p class="lg:max-w-md text-sm sm:text-base text-stone-400 leading-relaxed">
                    Sajian masakan warisan dengan bahan baku segar hasil bumi lokal.
                    Nikmati cita rasa tradisional langsung di tengah suasana pedesaan
                    yang asri dan tenang.
                </p>

            </div>

        </header>


        {{-- =========================================================
            MENU CATEGORIES
        ========================================================== --}}
        <div class="space-y-14 sm:space-y-16 lg:space-y-20">

            @forelse ($categories as $category)

                <section>

                    {{-- CATEGORY HEADER --}}
                    <div class="flex items-end justify-between gap-4 mb-5 sm:mb-6">

                        <div>

                            <div class="flex items-center gap-3">

                                <h2 class="font-serif text-xl sm:text-2xl lg:text-3xl font-bold text-stone-100">
                                    {{ $category->nama }}
                                </h2>

                                <span class="hidden sm:block w-10 lg:w-16 h-px bg-stone-800"></span>

                            </div>

                            <p class="mt-1.5 text-xs sm:text-sm text-stone-500">
                                Pilihan {{ strtolower($category->nama) }} untuk dinikmati
                            </p>

                        </div>


                        {{-- VIEW ALL --}}
                        <a
                            href="{{ url('/kuliner/' . $category->slug) }}"
                            class="shrink-0 inline-flex items-center gap-1.5 text-xs sm:text-sm font-semibold text-amber-500 hover:text-amber-400 transition-colors"
                        >
                            <span class="hidden sm:inline">Lihat Semua</span>
                            <span class="sm:hidden">Semua</span>

                            <svg
                                class="w-4 h-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 5l7 7-7 7"
                                />
                            </svg>
                        </a>

                    </div>


                    {{-- =================================================
                        MENU CAROUSEL
                    ================================================== --}}
                    <div
                        class="flex gap-4 sm:gap-5 lg:gap-6 overflow-x-auto snap-x snap-mandatory pb-4 pt-1
                               scrollbar-thin scrollbar-track-transparent scrollbar-thumb-stone-800
                               hover:scrollbar-thumb-stone-700"
                    >

                        @foreach ($category->menus as $item)

                            <article
                                class="group w-[220px] sm:w-[250px] lg:w-[270px] shrink-0 snap-start"
                            >

                                <a
                                    href="{{ url('/kuliner/' . $category->slug . '/' . $item->slug) }}"
                                    class="h-full bg-stone-900 border border-stone-800 rounded-2xl overflow-hidden flex flex-col
                                           hover:border-stone-700 transition-colors duration-200"
                                >

                                    {{-- IMAGE --}}
                                    <div class="relative aspect-[4/3] bg-stone-900 overflow-hidden">

                                        @if ($item->foto)

                                            <img
                                                src="{{ Storage::url($item->foto) }}"
                                                alt="{{ $item->nama }}"
                                                loading="lazy"
                                                decoding="async"
                                                class="w-full h-full object-cover transition-transform duration-500 ease-out group-hover:scale-105"
                                            >

                                        @else

                                            <div class="w-full h-full flex flex-col items-center justify-center bg-stone-900 text-stone-600">

                                                <svg
                                                    class="w-10 h-10 mb-2"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                    aria-hidden="true"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="1.5"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M5 20h14a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v14a1 1 0 001 1z"
                                                    />
                                                </svg>

                                                <span class="text-[11px]">
                                                    Foto belum tersedia
                                                </span>

                                            </div>

                                        @endif

                                        {{-- IMAGE OVERLAY --}}
                                        <div class="absolute inset-0 bg-gradient-to-t from-stone-950/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                                    </div>


                                    {{-- CONTENT --}}
                                    <div class="flex flex-col flex-1 p-4 sm:p-5">

                                        <h3
                                            class="font-serif text-base sm:text-lg font-bold text-stone-100 leading-snug
                                                   line-clamp-2 min-h-[2.8rem]"
                                        >
                                            {{ $item->nama }}
                                        </h3>


                                        <p class="mt-2 text-amber-500 text-sm font-semibold">
                                            {{ $item->formatted_harga }}
                                        </p>


                                        @if ($item->deskripsi)

                                            <p
                                                class="mt-2.5 text-xs sm:text-sm text-stone-400 leading-relaxed
                                                       line-clamp-3"
                                            >
                                                {{ $item->deskripsi }}
                                            </p>

                                        @endif

                                    </div>

                                </a>

                            </article>

                        @endforeach


                        {{-- =================================================
                            EXPLORE ALL CARD
                        ================================================== --}}
                        @if ($category->menus->count() >= 5)

                            <article class="w-[180px] sm:w-[200px] shrink-0 snap-start">

                                <a
                                    href="{{ url('/kuliner/' . $category->slug) }}"
                                    class="h-full min-h-[280px] bg-stone-900/50 border border-dashed border-stone-800
                                           rounded-2xl flex flex-col items-center justify-center p-6 text-center
                                           hover:border-amber-500/50 hover:bg-stone-900 transition-all duration-200 group"
                                >

                                    <div
                                        class="w-12 h-12 rounded-full bg-stone-800 flex items-center justify-center
                                               text-amber-500 group-hover:bg-amber-500 group-hover:text-stone-950
                                               transition-colors duration-200"
                                    >

                                        <svg
                                            class="w-5 h-5"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                            aria-hidden="true"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3"
                                            />
                                        </svg>

                                    </div>


                                    <span class="mt-4 text-sm font-semibold text-stone-300 group-hover:text-amber-500 transition-colors">
                                        Jelajahi Semua
                                    </span>

                                    <span class="mt-1 text-xs text-stone-500">
                                        {{ $category->nama }}
                                    </span>

                                </a>

                            </article>

                        @endif

                    </div>

                </section>

            @empty

                {{-- =====================================================
                    EMPTY STATE
                ====================================================== --}}
                <div class="py-20 text-center border border-dashed border-stone-800 rounded-2xl">

                    <div class="w-14 h-14 mx-auto rounded-full bg-stone-900 flex items-center justify-center text-stone-600">

                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M3 3h18M5 3l1 14h12l1-14M9 7v6m6-6v6"
                            />
                        </svg>

                    </div>

                    <h2 class="mt-5 font-serif text-xl font-bold text-stone-200">
                        Menu belum tersedia
                    </h2>

                    <p class="mt-2 text-sm text-stone-500">
                        Pilihan kuliner sedang dipersiapkan.
                    </p>

                </div>

            @endforelse

        </div>


        {{-- =========================================================
            CTA
        ========================================================== --}}
        <div class="mt-16 sm:mt-20 lg:mt-24">

            <div class="relative overflow-hidden bg-stone-900 border border-stone-800 rounded-2xl p-6 sm:p-8 lg:p-10">

                {{-- Decorative element --}}
                <div class="absolute -right-16 -top-16 w-40 h-40 rounded-full border border-amber-500/10"></div>
                <div class="absolute -right-8 -top-8 w-24 h-24 rounded-full border border-amber-500/10"></div>


                <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-7 lg:gap-10">

                    <div class="max-w-2xl">

                        <span class="text-amber-500 text-[11px] font-semibold uppercase tracking-[0.18em]">
                            Nikmati Bersama
                        </span>

                        <h2 class="mt-2 font-serif text-2xl sm:text-3xl font-bold text-stone-100">
                            Ingin Reservasi Tempat atau Katering Acara?
                        </h2>

                        <p class="mt-3 text-sm text-stone-400 leading-relaxed">
                            Kami siap melayani berbagai pesanan tempat dan hidangan
                            tradisional untuk momen spesial Anda.
                            Yuk, hubungi kami dan pesan sekarang.
                        </p>

                    </div>


                    <div class="shrink-0">

                        <a
                            href="{{ route('kontak-kami.index') }}"
                            class="w-full md:w-auto inline-flex items-center justify-center gap-2
                                   bg-amber-600 hover:bg-amber-500 text-stone-950
                                   font-semibold text-sm py-3.5 px-6 rounded-xl
                                   transition-colors duration-200"
                        >

                            <span>Hubungi Kami</span>

                            <svg
                                class="w-4 h-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M14 5l7 7-7 7m7-7H3"
                                />
                            </svg>

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>