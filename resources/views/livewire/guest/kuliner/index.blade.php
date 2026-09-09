<section class="bg-stone-950 text-stone-100 font-sans min-h-screen py-12 lg:py-20 px-4 sm:px-6 lg:px-8">

  <div class="max-w-7xl mx-auto space-y-12 sm:space-y-16">

    <!-- 1. HERO SECTION -->
    <div class="border-b border-stone-800 pb-8 flex flex-col md:flex-row md:items-end justify-between gap-6">
      <div class="max-w-2xl space-y-2">
        <span class="text-amber-500 font-medium text-xs tracking-widest uppercase">Cita Rasa Otentik</span>
        <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-stone-100 leading-tight">
          Petualangan Kuliner Tradisional Lembah Desa
        </h1>
      </div>
      <p class="text-stone-400 text-sm max-w-md leading-relaxed">
        Sajian masakan warisan dengan bahan baku segar hasil bumi lokal. Dinikmati langsung di tengah suasana pedesaan yang asri dan tenang.
      </p>
    </div>

    <!-- MOCK DATA KULINER (Siap diganti dengan variabel Livewire $categories) -->
@php
  $categories = [
      [
          'nama' => 'Makanan Utama',
          'slug' => 'makanan-utama',
          'items' => [
              [
                  'nama' => 'Ayam Bakar Madu Pedesaan',
                  'slug' => 'ayam-bakar-madu-pedesaan',
                  'harga' => 'Rp 35.000',
                  'foto' => 'https://images.unsplash.com/photo-1598515214211-89d3c73ae83b?q=80&w=600&auto=format&fit=crop',
                  'deskripsi' => 'Ayam kampung pilihan diungkep bumbu rempah lalu dibakar dengan olesan madu murni.'
              ],
              [
                  'nama' => 'Sego Megono Tampah',
                  'slug' => 'sego-megono-tampah',
                  'harga' => 'Rp 28.000',
                  'foto' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=600&auto=format&fit=crop',
                  'deskripsi' => 'Nasi hangat dengan racikan nangka muda cincang rempah, disajikan bersama lauk pauk komplit.'
              ],
              [
                  'nama' => 'Gurame Terbang Sambal Terasi',
                  'slug' => 'gurame-terbang-sambal-terasi',
                  'harga' => 'Rp 65.000',
                  'foto' => 'https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?q=80&w=600&auto=format&fit=crop',
                  'deskripsi' => 'Ikan gurame segar goreng renyah disajikan dengan sambal terasi mentah dan lalapan segar.'
              ],
              [
                  'nama' => 'Sayur Lodeh 7 Rupa',
                  'slug' => 'sayur-lodeh-7-rupa',
                  'harga' => 'Rp 20.000',
                  'foto' => 'https://images.unsplash.com/photo-1540420773420-3366772f4999?q=80&w=600&auto=format&fit=crop',
                  'deskripsi' => 'Sayur lodeh kuah santan gurih khas pedesaan berisi aneka sayuran hasil panen warga.'
              ],
              [
                  'nama' => 'Soto Ayam Kampung Kuah Bening',
                  'slug' => 'soto-ayam-kampung-kuah-bening',
                  'harga' => 'Rp 25.000',
                  'foto' => 'https://images.unsplash.com/photo-1572656631137-7935297eff55?q=80&w=600&auto=format&fit=crop',
                  'deskripsi' => 'Soto hangat berkuah rempah bening dengan irisan daging ayam kampung dan koya gurih.'
              ],
              [
                  'nama' => 'Bebek Goreng Ungkep Serundeng',
                  'slug' => 'bebek-goreng-ungkep-serundeng',
                  'harga' => 'Rp 42.000',
                  'foto' => 'https://images.unsplash.com/photo-1585238342024-78d387f4a707?q=80&w=600&auto=format&fit=crop',
                  'deskripsi' => 'Daging bebek empuk bumbu rempah meresap ditaburi serundeng kelapa sangrai wangi.'
              ],
              [
                  'nama' => 'Nasi Goreng Kencur Parahyangan',
                  'slug' => 'nasi-goreng-kencur-parahyangan',
                  'harga' => 'Rp 27.000',
                  'foto' => 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?q=80&w=600&auto=format&fit=crop',
                  'deskripsi' => 'Nasi goreng harum kencur segar dilengkapi telur ceplok dan kerupuk emping.'
              ],
              [
                  'nama' => 'Pecel Desa Sambal Kacang Sangrai',
                  'slug' => 'pecel-desa-sambal-kacang-sangrai',
                  'harga' => 'Rp 18.000',
                  'foto' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?q=80&w=600&auto=format&fit=crop',
                  'deskripsi' => 'Sayuran rebus segar disiram bumbu kacang tanah sangrai pedas manis yang kental.'
              ],
          ]
      ],
      [
          'nama' => 'Minuman Tradisional',
          'slug' => 'minuman-tradisional',
          'items' => [
              [
                  'nama' => 'Wedang Rempah Lembah',
                  'slug' => 'wedang-rempah-lembah',
                  'harga' => 'Rp 15.000',
                  'foto' => 'https://images.unsplash.com/photo-1576092768241-dec231879fc3?q=80&w=600&auto=format&fit=crop',
                  'deskripsi' => 'Seduhan jahe merah, serai, kayu manis, dan gula jawa hangat penambah stamina body.'
              ],
              [
                  'nama' => 'Es Cendol Gula Aren',
                  'slug' => 'es-cendol-gula-aren',
                  'harga' => 'Rp 16.000',
                  'foto' => 'https://images.unsplash.com/photo-1556679343-c7306c1976bc?q=80&w=600&auto=format&fit=crop',
                  'deskripsi' => 'Cendol tepung beras suji alami dengan santan murni dan sirup gula aren asli.'
              ],
              [
                  'nama' => 'Es Kelapa Muda Jeruk',
                  'slug' => 'es-kelapa-muda-jeruk',
                  'harga' => 'Rp 18.000',
                  'foto' => 'https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?q=80&w=600&auto=format&fit=crop',
                  'deskripsi' => 'Kesegaran air kelapa muda dikombinasikan dengan perasan jeruk peras alami.'
              ],
              [
                  'nama' => 'Kopi Tubruk Robusta Desa',
                  'slug' => 'kopi-tubruk-robusta-desa',
                  'harga' => 'Rp 12.000',
                  'foto' => 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?q=80&w=600&auto=format&fit=crop',
                  'deskripsi' => 'Seduhan biji kopi robusta lokal yang disangrai secara tradisional menggunakan kuali tanah.'
              ],
          ]
      ],
      [
          'nama' => 'Camilan Desa',
          'slug' => 'camilan-desa',
          'items' => [
              [
                  'nama' => 'Pisang Goreng Wijen Gula Aren',
                  'slug' => 'pisang-goreng-wijen-gula-aren',
                  'harga' => 'Rp 15.000',
                  'foto' => 'https://images.unsplash.com/photo-1528735602780-2552fd46c7af?q=80&w=600&auto=format&fit=crop',
                  'deskripsi' => 'Pisang raja lokal goreng renyah berbumbu wijen, disajikan dengan cocolan gula aren.'
              ],
              [
                  'nama' => 'Tempe Mendoan Bumbu Kecap',
                  'slug' => 'tempe-mendoan-bumbu-kecap',
                  'harga' => 'Rp 14.000',
                  'foto' => 'https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?q=80&w=600&auto=format&fit=crop',
                  'deskripsi' => 'Tempe tipis goreng tepung setengah matang beraroma daun bawang dengan sambal kecap pedas.'
              ],
              [
                  'nama' => 'Singkong Goreng Merekah',
                  'slug' => 'singkong-goreng-merekah',
                  'harga' => 'Rp 14.000',
                  'foto' => 'https://images.unsplash.com/photo-1589301760014-d929f3979dbc?q=80&w=600&auto=format&fit=crop',
                  'deskripsi' => 'Singkong empuk berbumbu ketumbar gurih goreng garing di luar dan lembut di dalam.'
              ],
          ]
      ]
  ];
@endphp

    <!-- 2. MENU BERDASARKAN KATEGORI (HORIZONTAL SCROLL) -->
    <div class="space-y-12 sm:space-y-16">
      @foreach ($categories as $category)
        <div class="space-y-4 sm:space-y-6">

          <!-- Header Kategori & Link "Lihat Semua" -->
          <div class="flex items-center justify-between">
            <h2 class="font-serif text-xl sm:text-2xl font-bold text-stone-100 flex items-center gap-3">
              <span>{{ $category['nama'] }}</span>
              <span class="w-12 h-[1px] bg-stone-800 hidden sm:inline-block"></span>
            </h2>

            {{-- Ganti dengan kode ini kalau sudah disambungkan ke database --}}

            {{-- @if (count($category['items']) > 8)
              <a href="{{ url('/kuliner/' . $category['slug']) }}" class="text-xs font-semibold text-amber-500 hover:text-amber-400 flex items-center gap-1 transition-colors">
                <span>Lihat Semua</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
              </a>
            @endif --}}

            <!-- Link Ke Route Kategori Spesifik -->
            <a href="{{ url('/kuliner/' . $category['slug']) }}" class="text-xs font-semibold text-amber-500 hover:text-amber-400 flex items-center gap-1 transition-colors">
              <span>Lihat Semua</span>
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </a>
          </div>

          <!-- Carousel Container (Horizontal Scrollable) -->
          <div class="flex gap-4 sm:gap-6 overflow-x-auto snap-x snap-mandatory pb-4 pt-1 [scrollbar-width:thin] [scrollbar-color:#292524_transparent] [x-::-webkit-scrollbar]:h-1.5 [x-::-webkit-scrollbar-thumb]:bg-stone-800 [x-::-webkit-scrollbar-thumb]:rounded-full">
            
            <!-- Loop Card Menu (Maksimal 8 Item) -->
@foreach (array_slice($category['items'], 0, 5) as $item)
  <article
    class="w-[200px] sm:w-[250px] shrink-0 snap-start"
  >
    <!-- Wrap seluruh card dengan tag <a> -->
    <a
      href="{{ url('/kuliner/' . $category['slug'] . '/' . $item['slug']) }}"
      class="bg-stone-900 border border-stone-800 rounded-2xl overflow-hidden flex flex-col justify-between hover:border-stone-700 transition-colors group h-full"
    >

      <div>
        <!-- Tempat Foto Menu (Aspect Ratio 4:3) -->
        <div class="relative aspect-[4/3] bg-stone-950 overflow-hidden">
          <img
            src="{{ $item['foto'] }}"
            alt="{{ $item['nama'] }}"
            loading="lazy"
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
          >
        </div>

        <!-- Detail Menu -->
        <div class="p-4 sm:p-5 space-y-2">

          <!-- Nama Menu -->
          <div class="flex items-start justify-between gap-2">
            <h3 class="font-serif text-base font-bold text-stone-100 leading-snug line-clamp-2">
              {{ $item['nama'] }}
            </h3>
          </div>

          <!-- Harga -->
          <p class="text-amber-500 font-semibold text-xs sm:text-sm">
            {{ $item['harga'] }}
          </p>

          <!-- Deskripsi -->
          <p class="text-stone-400 text-xs leading-relaxed line-clamp-2 pt-1">
            {{ $item['deskripsi'] }}
          </p>

        </div>
      </div>

    </a>
  </article>
@endforeach


            <!-- Card penutup khusus (Menuju halaman kategori) jika items melebihi 3/4 -->
            <div class="w-[160px] sm:w-[180px] shrink-0 snap-start bg-stone-900/40 border border-dashed border-stone-800 rounded-2xl flex flex-col items-center justify-center p-4 text-center hover:border-amber-500/50 transition-colors group">
              <a href="{{ url('/kuliner/' . $category['slug']) }}" class="space-y-2 flex flex-col items-center">
                <div class="w-10 h-10 rounded-full bg-stone-800 flex items-center justify-center text-amber-500 group-hover:bg-amber-500 group-hover:text-stone-950 transition-colors">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                  </svg>
                </div>
                <span class="text-xs font-medium text-stone-300 group-hover:text-amber-500 transition-colors">Jelajahi Semua {{ $category['nama'] }}</span>
              </a>
            </div>

          </div>

        </div>
      @endforeach
    </div>

    <!-- 3. CALL TO ACTION (CTA) SECTION -->
    <div class="bg-stone-900 border border-stone-800 rounded-2xl p-6 sm:p-10 flex flex-col md:flex-row items-center justify-between gap-6 md:gap-8">
      <div class="space-y-2 text-center md:text-left max-w-xl">
        <h2 class="font-serif text-2xl sm:text-3xl font-bold text-stone-100">
          Ingin Reservasi Tempat atau Katering Acara?
        </h2>
        <p class="text-stone-400 text-xs sm:text-sm leading-relaxed">
          Kami siap melayani berbagai pesanan tempat dan hidangan tradisional untuk momen spesial Anda. Yuk, hubungi kami dan pesan sekarang!
        </p>
      </div>

      <div class="shrink-0 w-full md:w-auto">
        <a href="{{ route('kontak-kami.index') }}" class="w-full md:w-auto bg-amber-600 hover:bg-amber-500 text-stone-950 font-semibold py-3.5 px-6 rounded-xl text-xs sm:text-sm transition-colors flex items-center justify-center gap-2">
          <span>Hubungi Kami & Reservasi</span>
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
          </svg>
        </a>
      </div>
    </div>

  </div>
</section>