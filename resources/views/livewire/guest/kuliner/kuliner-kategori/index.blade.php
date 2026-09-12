<section class="bg-stone-950 text-stone-100 font-sans min-h-screen py-12 lg:py-20 px-4 sm:px-6 lg:px-8">

    <div class="max-w-7xl mx-auto space-y-8 sm:space-y-10">

        <!-- Navigasi Kembali & Header Kategori -->
        <div class="space-y-4 border-b border-stone-800 pb-6 lg:pb-8">

            {{-- Navigasi Kembali --}}
            <a
                href="{{ url('/kuliner') }}"
                class="inline-flex items-center gap-2
                       text-xs lg:text-[13px]
                       font-medium
                       text-stone-400
                       hover:text-amber-500
                       transition-colors"
            >
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
                        d="M15 19l-7-7 7-7"
                    />
                </svg>

                <span>Kembali ke Semua Kuliner</span>
            </a>


            {{-- Header Kategori --}}
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-3 sm:gap-6">

                <div>

                    {{-- Label --}}
                    <span class="text-amber-500 font-medium text-xs lg:text-[13px] tracking-widest uppercase">
                        Kategori Menu
                    </span>


                    {{-- H1 --}}
                    <h1
                        class="font-serif
                               text-3xl sm:text-4xl lg:text-[40px]
                               font-bold
                               text-stone-100
                               mt-1.5
                               leading-tight"
                    >
                        {{ $category->nama }}
                    </h1>

                </div>


                {{-- Jumlah Menu --}}
                <p class="text-stone-400 text-sm sm:text-[15px] lg:text-base leading-relaxed">
                    Menampilkan total
                    <span class="text-amber-500 font-semibold">
                        {{ $menus->count() }}
                    </span>
                    varian menu
                </p>

            </div>

        </div>


        <!-- Grid Menu Card -->
<div class="grid grid-cols-[repeat(auto-fit,220px)] sm:grid-cols-[repeat(auto-fit,250px)] lg:grid-cols-[repeat(auto-fit,270px)] gap-4 sm:gap-5 lg:gap-6 justify-center">

    @forelse ($menus as $item)
        <article class="group w-[220px] sm:w-[250px] lg:w-[270px]">

            <a
                href="{{ route('kuliner.category.detail.index', ['category' => $category->slug, 'menu' => $item->slug]) }}"
                class="block bg-stone-900 border border-stone-800 rounded-2xl overflow-hidden hover:border-stone-700 transition-colors"
            >

                <!-- Foto -->
                <div class="relative aspect-[4/3] bg-stone-950 overflow-hidden">
                    <img
                        src="{{ asset('storage/' . $item->foto) }}"
                        alt="{{ $item->nama }}"
                        loading="lazy"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                    >
                </div>

                <!-- Informasi -->
                <div class="p-4 sm:p-5 space-y-2">

                    <h2 class="font-serif text-xl sm:text-[21px] lg:text-[22px] font-bold text-stone-100 leading-tight line-clamp-2">
                        {{ $item->nama }}
                    </h2>

                    <p class="text-amber-500 font-semibold text-sm lg:text-[15px]">
                        {{ $item->formatted_harga }}
                    </p>

                </div>

            </a>

        </article>

    @empty

        <div class="col-span-full py-12 text-center text-stone-500">
            <p class="text-sm lg:text-[15px]">
                Belum ada menu yang tersedia untuk kategori ini.
            </p>
        </div>

    @endforelse

</div>
    </div>

</section>