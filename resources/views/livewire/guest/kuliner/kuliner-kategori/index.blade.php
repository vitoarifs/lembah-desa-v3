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
            {{ $category->nama }}
          </h1>
        </div>
        <p class="text-stone-400 text-xs sm:text-sm">
          Menampilkan total <span class="text-amber-500 font-semibold">{{ $menus->count() }}</span> varian menu
        </p>
      </div>
    </div>

    <!-- Grid Menu Card -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      @forelse ($menus as $item)
        <a href="{{ url('/kuliner/' . $category->slug . '/' . $item->slug) }}" class="w-[180px] sm:w-[200px] bg-stone-900 border border-stone-800 rounded-2xl overflow-hidden flex flex-col justify-between hover:border-stone-700 transition-colors group">
          <div>
            <!-- Foto Menu -->
            <div class="relative aspect-[4/3] bg-stone-950 overflow-hidden">
              <img 
                src="{{ asset('storage/' . $item->foto) }}" 
                alt="{{ $item->nama }}" 
                loading="lazy" 
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
              >
            </div>

            <!-- Detail Menu -->
            <div class="p-4 sm:p-5 space-y-2">
              <h3 class="font-serif text-base font-bold text-stone-100 leading-snug line-clamp-2">
                {{ $item->nama }}
              </h3>

              <p class="text-amber-500 font-semibold text-xs sm:text-sm">
                Rp {{ number_format($item->harga, 0, ',', '.') }}
              </p>
            </div>
          </div>
        </a>
      @empty
        <div class="col-span-full py-12 text-center text-stone-500">
          <p class="text-sm">Belum ada menu yang tersedia untuk kategori ini.</p>
        </div>
      @endforelse
    </div>

  </div>
</section>