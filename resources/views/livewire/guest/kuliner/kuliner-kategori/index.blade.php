<section class="bg-stone-950 text-stone-100 font-sans min-h-screen py-12 lg:py-20 px-4 sm:px-6 lg:px-8">
  <div class="max-w-7xl mx-auto space-y-8 sm:space-y-10">

    <!-- Navigasi Kembali & Header Kategori -->
    <div class="space-y-4 border-b border-stone-800 pb-6">
      <a href="{{ url('/kuliner') }}" class="inline-flex items-center gap-2 text-xs font-medium text-stone-400 hover:text-amber-500 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        <span>Kembali ke Semua Kuliner</span>
      </a>

      <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-2">
        <div>
          <span class="text-amber-500 font-medium text-xs tracking-widest uppercase">Kategori Menu</span>
          <h1 class="font-serif text-3xl sm:text-4xl font-bold text-stone-100 mt-1">
            {{ $category['nama'] ?? 'Makanan Utama' }}
          </h1>
        </div>
        <p class="text-stone-400 text-xs sm:text-sm">
          Menampilkan total <span class="text-amber-500 font-semibold">{{ count($items ?? []) }}</span> varian menu
        </p>
      </div>
    </div>

    <!-- Dummy Data items (Siap diganti @forelse($items as $item)) -->
    @php
      $categorySlug = $category['slug'] ?? 'makanan-utama';
      $dummyCategoryItems = [
          [
              'slug' => 'ayam-bakar-madu-pedesaan',
              'nama' => 'Ayam Bakar Madu Pedesaan',
              'harga' => 'Rp 35.000',
              'foto' => 'https://images.unsplash.com/photo-1598515214211-89d3c73ae83b?q=80&w=600&auto=format&fit=crop',
              'deskripsi' => 'Ayam kampung pilihan diungkep bumbu rempah lalu dibakar dengan olesan madu murni.'
          ],
          [
              'slug' => 'sego-megono-tampah',
              'nama' => 'Sego Megono Tampah',
              'harga' => 'Rp 28.000',
              'foto' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=600&auto=format&fit=crop',
              'deskripsi' => 'Nasi hangat dengan racikan nangka muda cincang rempah, disajikan bersama lauk pauk komplit.'
          ],
          [
              'slug' => 'gurame-terbang-sambal-terasi',
              'nama' => 'Gurame Terbang Sambal Terasi',
              'harga' => 'Rp 65.000',
              'foto' => 'https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?q=80&w=600&auto=format&fit=crop',
              'deskripsi' => 'Ikan gurame segar goreng renyah disajikan dengan sambal terasi mentah dan lalapan segar.'
          ],
          [
              'slug' => 'sayur-lodeh-7-rupa',
              'nama' => 'Sayur Lodeh 7 Rupa',
              'harga' => 'Rp 20.000',
              'foto' => 'https://images.unsplash.com/photo-1540420773420-3366772f4999?q=80&w=600&auto=format&fit=crop',
              'deskripsi' => 'Sayur lodeh kuah santan gurih khas pedesaan berisi aneka sayuran hasil panen warga.'
          ],
      ];
    @endphp

    <!-- Grid Menu Card (Responsif 1 Kolom HP, 2 Kolom Tablet, 4 Kolom Laptop) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      @foreach ($dummyCategoryItems as $item)
        <a href="{{ url('/kuliner/' . $categorySlug . '/' . $item['slug']) }}" class="bg-stone-900 border border-stone-800 rounded-2xl overflow-hidden flex flex-col justify-between hover:border-stone-700 transition-colors group">
          <div>
            <!-- Tempat Foto Menu (Aspect Ratio 4:3) -->
            <div class="relative aspect-[4/3] bg-stone-950 overflow-hidden">
              <img src="{{ $item['foto'] }}" alt="{{ $item['nama'] }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            </div>

            <!-- Detail Menu -->
            <div class="p-4 sm:p-5 space-y-2">
              <h3 class="font-serif text-base font-bold text-stone-100 leading-snug line-clamp-1">
                {{ $item['nama'] }}
              </h3>

              <p class="text-amber-500 font-semibold text-xs sm:text-sm">
                {{ $item['harga'] }}
              </p>

              <p class="text-stone-400 text-xs leading-relaxed line-clamp-2 pt-1">
                {{ $item['deskripsi'] }}
              </p>
            </div>
          </div>
        </a>
      @endforeach
    </div>

  </div>
</section>