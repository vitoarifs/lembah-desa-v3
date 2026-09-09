<section class="bg-stone-950 text-stone-100 font-sans min-h-screen py-12 lg:py-20 px-4 sm:px-6 lg:px-8">
  <div class="max-w-5xl mx-auto space-y-8">

    <!-- Navigasi Breadcrumb / Kembali -->
    <div class="flex items-center gap-2 text-xs text-stone-400">
      <a href="{{ url('/kuliner') }}" class="hover:text-amber-500 transition-colors">Kuliner</a>
      <span>/</span>
      <a href="{{ url('/kuliner/' . ($menu['kategori_slug'] ?? 'makanan-utama')) }}" class="hover:text-amber-500 transition-colors">
        {{ $menu['kategori_nama'] ?? 'Makanan Utama' }}
      </a>
      <span>/</span>
      <span class="text-stone-200 truncate">{{ $menu['nama'] ?? 'Sego Megono Tampah' }}</span>
    </div>

    <!-- Dummy Data Single Menu -->
    @php
      $menu = [
          'nama' => 'Sego Megono Tampah (Paket Hemat 2 Orang)',
          'harga' => 'Rp 55.000',
          'kategori_nama' => 'Makanan Utama',
          'kategori_slug' => 'makanan-utama',
          'foto' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=800&auto=format&fit=crop',
          'deskripsi' => 'Nasi khas pedesaan yang disajikan hangat di atas tampah bambu beralas daun pisang murni. Memiliki aroma rempah yang otentik dan gurih, diolah menggunakan resep tradisional turun-temurun dari warga Lembah Desa.',
          'isi_paket' => [
              'Nasi Putih / Nasi Liwet Organik',
              'Megono Nangka Muda Rempah',
              'Ayam Goreng Lengkuas (2 Potong)',
              'Mendoan Warm & Crispy (2 Pcs)',
              'Sambal Terasi Mentah & Lalapan Panen',
              'Kerupuk Desa & Es Teh Manis'
          ]
      ];
    @endphp

<!-- Layout Utama: Split Grid 2 Kolom (Desktop) -->
<div class="bg-stone-900 border border-stone-800 rounded-2xl p-5 sm:p-8 grid grid-cols-1 md:grid-cols-12 gap-6 sm:gap-10">

  <!-- ========================================================= -->
  <!-- MOBILE: Foto + Nama + Harga Sejajar                      -->
  <!-- DESKTOP: Foto menjadi kolom kiri                         -->
  <!-- ========================================================= -->

  <!-- Kolom Foto Menu -->
  <div class="md:col-span-5">

    <!-- MOBILE -->
    <div class="md:hidden flex items-center gap-4">

      <!-- Foto kecil -->
      <div class="relative w-28 h-28 shrink-0 bg-stone-950 rounded-xl overflow-hidden border border-stone-800">
        <img
          src="{{ $menu['foto'] }}"
          alt="{{ $menu['nama'] }}"
          class="w-full h-full object-cover"
        >
      </div>

      <!-- Nama + Harga -->
      <div class="min-w-0 flex-1">

        <span class="block text-xs font-semibold uppercase tracking-widest text-amber-500 mb-2">
          {{ $menu['kategori_nama'] }}
        </span>

        <h1 class="font-serif text-xl font-bold text-stone-100 leading-tight">
          {{ $menu['nama'] }}
        </h1>

        <span class="block text-amber-500 font-bold text-lg mt-2">
          {{ $menu['harga'] }}
        </span>

      </div>

    </div>

    <!-- DESKTOP -->
    <div class="hidden md:block relative aspect-square bg-stone-950 rounded-xl overflow-hidden border border-stone-800">
      <img
        src="{{ $menu['foto'] }}"
        alt="{{ $menu['nama'] }}"
        class="w-full h-full object-cover"
      >
    </div>

  </div>


  <!-- ========================================================= -->
  <!-- Kolom Informasi Menu                                     -->
  <!-- ========================================================= -->

  <div class="md:col-span-7 flex flex-col justify-between space-y-6">

    <div class="space-y-5">


      <!-- ===================================================== -->
      <!-- DESKTOP: Nama Menu & Harga                            -->
      <!-- ===================================================== -->

      <div class="hidden md:block space-y-2 border-b border-stone-800 pb-4">

        <span class="text-xs font-semibold uppercase tracking-widest text-amber-500">
          {{ $menu['kategori_nama'] }}
        </span>

        <div class="flex flex-col sm:flex-row sm:items-baseline justify-between gap-2">

          <h1 class="font-serif text-2xl sm:text-3xl font-bold text-stone-100 leading-tight">
            {{ $menu['nama'] }}
          </h1>

          <span class="text-amber-500 font-bold text-xl sm:text-2xl shrink-0">
            {{ $menu['harga'] }}
          </span>

        </div>

      </div>


      <!-- ===================================================== -->
      <!-- Deskripsi Menu                                       -->
      <!-- ===================================================== -->

      <div class="space-y-2">

        <h2 class="text-xs font-semibold text-stone-300 uppercase tracking-wider">
          Deskripsi
        </h2>

        <p class="text-stone-400 text-sm leading-relaxed">
          {{ $menu['deskripsi'] }}
        </p>

      </div>


      <!-- ===================================================== -->
      <!-- Komponen Isi Paket                                   -->
      <!-- ===================================================== -->

      @if (!empty($menu['isi_paket']))

        <div class="space-y-3 pt-2">

          <h2 class="text-xs font-semibold text-stone-300 uppercase tracking-wider">
            Komponen & Isi Hidangan
          </h2>

          <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2">

            @foreach ($menu['isi_paket'] as $item)

              <li class="flex items-center gap-2 text-xs text-stone-300 bg-stone-950/60 border border-stone-800 px-3 py-2 rounded-lg">

                <svg
                  class="w-3.5 h-3.5 text-amber-500 shrink-0"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2.5"
                    d="M5 13l4 4L19 7"
                  />
                </svg>

                <span>{{ $item }}</span>

              </li>

            @endforeach

          </ul>

        </div>

      @endif

    </div>


    <!-- ======================================================= -->
    <!-- Tombol WhatsApp                                        -->
    <!-- ======================================================= -->

    <div class="pt-4 border-t border-stone-800">

      <a
        href="https://wa.me/6281234567890?text={{ urlencode('Halo Lembah Desa, saya ingin memesan menu: ' . $menu['nama']) }}"
        target="_blank"
        rel="noopener noreferrer"
        class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-medium py-3.5 px-5 rounded-xl text-xs sm:text-sm transition-colors flex items-center justify-center gap-2"
      >

        <svg
          class="w-4 h-4"
          fill="currentColor"
          viewBox="0 0 24 24"
        >
          <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"
          />
        </svg>

        <span>Pesan Menu Ini via WhatsApp</span>

      </a>

    </div>

  </div>

</div>

  </div>
</section>