<section class="bg-stone-950 text-stone-100 font-sans min-h-screen py-12 lg:py-20 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto space-y-8 lg:space-y-10">

        <!-- Header Halaman -->
        <div class="border-b border-stone-800 pb-6 lg:pb-8 flex flex-col md:flex-row md:items-end justify-between gap-4 lg:gap-8">

            <div>
                <!-- Label -->
                <span class="text-amber-500 font-medium text-xs lg:text-[13px] tracking-widest uppercase">
                    Agenda & Kegiatan
                </span>

                <!-- H1 -->
                <h1 class="font-serif text-3xl sm:text-4xl lg:text-[40px] font-bold leading-tight text-stone-100 mt-1.5">
                    Acara di Lembah Desa
                </h1>
            </div>

            <!-- Deskripsi Header -->
            <p class="text-stone-400 text-sm sm:text-[15px] lg:text-base max-w-md leading-relaxed">
                Jadwal kegiatan rutin, festival kuliner, dan acara spesial.
                Terbuka untuk umum maupun reservasi khusus.
            </p>
        </div>


        @php
            $dummyEvents = [
                [
                    'id' => 1,
                    'judul' => 'Pasar Kuliner Tradisional & Musik Bambu',
                    'tanggal' => 'Minggu, 18 Oktober 2026',
                    'waktu' => '06:00 - 11:00 WIB',
                    'lokasi' => 'Halaman Pendopo Ageng',
                    'htm' => 'Gratis / Terbuka untuk Umum',
                    'deskripsi' => 'Menyajikan lebih dari 20 jajanan pasar autentik, kopi tubruk pedesaan, dan alunan musik bambu live di tepi sawah. Cocok untuk sarapan keluarga di akhir pekan.',
                ],
                [
                    'id' => 2,
                    'judul' => 'Workshop Membatik & Kerajinan Gerabah',
                    'tanggal' => 'Sabtu, 24 Oktober 2026',
                    'waktu' => '09:00 - 14:00 WIB',
                    'lokasi' => 'Saung Edukasi & Galeri',
                    'htm' => 'Rp 75.000 / orang (Termasuk Alat & Bahan)',
                    'deskripsi' => 'Belajar teknik dasar canting batik tulis dan membuat pot gerabah sendiri bersama pengrajin lokal. Hasil karya bisa dibawa pulang.',
                ],
                [
                    'id' => 3,
                    'judul' => 'Pentas Seni Catur Wulanan & Makan Malam Malam Minggu',
                    'tanggal' => 'Sabtu, 31 Oktober 2026',
                    'waktu' => '18:30 - 21:30 WIB',
                    'lokasi' => 'Area Panggung Semi-Outdoor',
                    'htm' => 'Gratis (Cukup Pesan Menu Makanan)',
                    'deskripsi' => 'Pertunjukan tarian daerah dan akustik lokal menemani santap malam Anda di bawah sorot lampu hias outdoor Lembah Desa.',
                ],
                [
                    'id' => 4,
                    'judul' => 'Pentas Seni Catur Wulanan & Makan Malam Malam Minggu',
                    'tanggal' => 'Sabtu, 31 Oktober 2026',
                    'waktu' => '18:30 - 21:30 WIB',
                    'lokasi' => 'Area Panggung Semi-Outdoor',
                    'htm' => 'Gratis (Cukup Pesan Menu Makanan)',
                    'deskripsi' => 'Pertunjukan tarian daerah dan akustik lokal menemani santap malam Anda di bawah sorot lampu hias outdoor Lembah Desa.',
                ],
            ];
        @endphp


        <!-- Grid Card Event -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">

            @foreach ($dummyEvents as $event)

                <article
                    class="bg-stone-900 border border-stone-800 rounded-2xl
                           overflow-hidden flex flex-col
                           hover:border-stone-700 transition-colors"
                >

                    <div class="p-5 sm:p-6 lg:p-7">

                        {{-- Tanggal --}}
                        <div class="flex items-center justify-between mb-5 lg:mb-6">
                            <span class="text-xs lg:text-[13px] font-semibold uppercase tracking-widest text-amber-500">
                                {{ $event['tanggal'] }}
                            </span>

                            <span class="w-2 h-2 rounded-full bg-amber-500 shrink-0"></span>
                        </div>


                        {{-- Judul Event --}}
                        <h2 class="font-serif text-xl sm:text-[21px] lg:text-[22px] font-bold text-stone-100 leading-snug line-clamp-2">
                            {{ $event['judul'] }}
                        </h2>


                        {{-- Detail Event --}}
                        <div class="mt-5 lg:mt-6 space-y-3 text-sm lg:text-[15px] text-stone-400">

                            {{-- Waktu --}}
                            <p class="flex items-start gap-3">
                                <svg
                                    class="w-4 h-4 mt-0.5 shrink-0 text-amber-500"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>

                                <span>{{ $event['waktu'] }}</span>
                            </p>


                            {{-- Lokasi --}}
                            <p class="flex items-start gap-3">
                                <svg
                                    class="w-4 h-4 mt-0.5 shrink-0 text-stone-500"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
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

                                <span>{{ $event['lokasi'] }}</span>
                            </p>


                            {{-- HTM --}}
                            <p class="flex items-start gap-3">
                                <svg
                                    class="w-4 h-4 mt-0.5 shrink-0 text-stone-500"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 001 1.71l.29.13a2 2 0 010 3.42l-.29.13A2 2 0 003 17v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 00-1-1.71l-.29-.13a2 2 0 010-3.42l.29-.13A2 2 0 0021 10V7a2 2 0 00-2-2H5z"
                                    />
                                </svg>

                                <span class="text-stone-300 font-medium">
                                    {{ $event['htm'] }}
                                </span>
                            </p>

                        </div>


                        {{-- Deskripsi --}}
                        <p class="mt-5 lg:mt-6 pt-4 border-t border-stone-800
                                  text-sm lg:text-[15px]
                                  text-stone-400
                                  leading-relaxed
                                  line-clamp-3">
                            {{ $event['deskripsi'] }}
                        </p>

                    </div>


                    {{-- Footer --}}
                    <div class="mt-auto px-5 sm:px-6 lg:px-7 py-4 border-t border-stone-800">

                        <a
                            href="https://wa.me/6281234567890?text={{ urlencode('Halo Lembah Desa, saya ingin bertanya mengenai event: ' . $event['judul']) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="w-full
                                   bg-emerald-600 hover:bg-emerald-500
                                   text-white
                                   font-medium
                                   py-3 px-4
                                   rounded-xl
                                   text-xs sm:text-[13px] lg:text-sm
                                   transition-colors
                                   flex items-center justify-center gap-2"
                        >

                            <svg
                                class="w-4 h-4"
                                fill="currentColor"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z" />
                            </svg>

                            <span>
                                Tanyakan Acara Ini via WhatsApp
                            </span>

                        </a>

                    </div>

                </article>

            @endforeach

        </div>

    </div>
</section>