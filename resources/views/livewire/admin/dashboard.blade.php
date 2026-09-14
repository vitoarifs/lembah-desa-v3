<div class="p-4 sm:p-6 bg-stone-950 min-h-screen text-stone-100 font-sans space-y-6">

  <!-- Header Dashboard -->
  <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-stone-800 pb-6">
    <div>
      <span class="text-amber-500 font-semibold text-xs tracking-widest uppercase">Lembah Desa Pulutan</span>
      <h1 class="text-2xl sm:text-3xl font-serif font-bold text-stone-100 mt-1">
        Selamat datang, {{ auth()->user()->name }}
      </h1>
      <p class="text-xs sm:text-sm text-stone-400 mt-1">
        Kelola konten dan informasi Lembah Desa dari sini.
      </p>
    </div>

    <!-- Timestamp Terakhir Diperbarui -->
    <div class="flex items-center gap-2 bg-stone-900 border border-stone-800 px-3.5 py-2 rounded-xl text-stone-400 text-xs self-start md:self-auto shadow-sm">
      <svg
        class="w-4 h-4 text-amber-500 shrink-0"
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
      <span>Terakhir diperbarui: <strong class="text-stone-200 font-medium">{{ $lastUpdated }} WIB</strong></span>
    </div>
  </div>

  <!-- Cards Statistik Utama -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">

    <!-- Card 1: Menu Kuliner -->
    <div class="bg-stone-900 border border-stone-800 rounded-2xl p-5 shadow-xl flex items-center justify-between group hover:border-amber-600/50 transition-colors">
      <div class="space-y-1">
        <span class="text-stone-400 text-xs font-medium uppercase tracking-wider block">Menu Kuliner</span>
        <div class="text-2xl sm:text-3xl font-serif font-bold text-stone-100">{{ $totalMenus }}</div>
        <p class="text-xs text-amber-500 font-medium flex items-center gap-1">
          <span class="w-1.5 h-1.5 rounded-full bg-amber-500 inline-block"></span>
          Menu tersedia
        </p>
      </div>
      <div class="w-12 h-12 rounded-xl bg-amber-950/50 border border-amber-800/40 text-amber-400 flex items-center justify-center shrink-0">
        <svg
          class="w-6 h-6"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"
          />
        </svg>
      </div>
    </div>

    <!-- Card 2: Kategori Kuliner -->
    <div class="bg-stone-900 border border-stone-800 rounded-2xl p-5 shadow-xl flex items-center justify-between group hover:border-amber-600/50 transition-colors">
      <div class="space-y-1">
        <span class="text-stone-400 text-xs font-medium uppercase tracking-wider block">Kategori Kuliner</span>
        <div class="text-2xl sm:text-3xl font-serif font-bold text-stone-100">{{ $totalCategories }}</div>
        <p class="text-xs text-stone-400 font-medium">Kategori terdaftar</p>
      </div>
      <div class="w-12 h-12 rounded-xl bg-stone-800 border border-stone-700/60 text-stone-300 flex items-center justify-center shrink-0">
        <svg
          class="w-6 h-6"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M7 7h.01M7 11h.01M7 15h.01M11 7h8M11 11h8M11 15h8"
          />
        </svg>
      </div>
    </div>

    <!-- Card 3: Event -->
    <div class="bg-stone-900 border border-stone-800 rounded-2xl p-5 shadow-xl flex items-center justify-between group hover:border-amber-600/50 transition-colors">
      <div class="space-y-1">
        <span class="text-stone-400 text-xs font-medium uppercase tracking-wider block">Event & Kegiatan</span>
        <div class="text-2xl sm:text-3xl font-serif font-bold text-stone-100">{{ $totalEvents }}</div>
        <p class="text-xs text-stone-400 font-medium">Acara terpublikasi</p>
      </div>
      <div class="w-12 h-12 rounded-xl bg-stone-800 border border-stone-700/60 text-stone-300 flex items-center justify-center shrink-0">
        <svg
          class="w-6 h-6"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
          />
        </svg>
      </div>
    </div>

    <!-- Card 4: Pesan Kontak -->
    <div class="bg-stone-900 border border-stone-800 rounded-2xl p-5 shadow-xl flex items-center justify-between group hover:border-amber-600/50 transition-colors">
      <div class="space-y-1">
        <span class="text-stone-400 text-xs font-medium uppercase tracking-wider block">Pesan Kontak</span>
        <div class="text-2xl sm:text-3xl font-serif font-bold text-stone-100">{{ $unreadMessages }}</div>
        <p class="text-xs text-emerald-400 font-medium flex items-center gap-1">
          @if ($unreadMessages > 0)
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
            Belum dibaca
          @else
            <span class="w-1.5 h-1.5 rounded-full bg-stone-500"></span>
            Semua pesan dibaca
          @endif
        </p>
      </div>
      <div class="w-12 h-12 rounded-xl bg-emerald-950/50 border border-emerald-800/40 text-emerald-400 flex items-center justify-center shrink-0">
        <svg
          class="w-6 h-6"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
          />
        </svg>
      </div>
    </div>

  </div>

  <!-- Aksi Cepat & Ringkasan Pesan Terbaru -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 pt-2">

    <!-- Kolom Kiri: Pesan Terbaru -->
    <div class="lg:col-span-2 bg-stone-900 border border-stone-800 rounded-2xl p-5 space-y-4 shadow-xl">
      <div class="flex items-center justify-between border-b border-stone-800 pb-3">
        <h2 class="text-base font-serif font-bold text-stone-100 flex items-center gap-2">
          <span>Pesan Masuk Terbaru</span>
          @if ($unreadMessages > 0)
            <span class="px-2 py-0.5 text-[10px] bg-amber-500/20 text-amber-400 rounded-full font-sans border border-amber-500/30">
              {{ $unreadMessages }} Baru
            </span>
          @endif
        </h2>
        <a
          href="{{ route('admin.contact-messages.index') }}"
          class="text-xs text-amber-500 hover:text-amber-400 font-medium transition-colors"
        >
          Lihat Semua &rarr;
        </a>
      </div>

      <div class="space-y-2">
        @forelse ($recentMessages as $msg)
          <a
            href="{{ route('admin.contact-messages.index') }}"
            class="block p-3.5 rounded-xl border border-stone-800/80 bg-stone-950/60 hover:bg-stone-800/40 transition-colors"
          >
            <div class="flex items-center justify-between">
              <div class="flex items-center gap-2">
                @if (!$msg->is_read)
                  <span
                    class="w-2 h-2 rounded-full bg-amber-500 shrink-0"
                    title="Belum dibaca"
                  ></span>
                @endif
                <span class="{{ !$msg->is_read ? 'font-bold text-stone-100' : 'font-medium text-stone-300' }} text-xs sm:text-sm">
                  {{ $msg->nama }}
                </span>
              </div>
              <span class="text-[11px] text-stone-500">{{ $msg->created_at->diffForHumans() }}</span>
            </div>
            <p class="text-xs text-stone-400 mt-1 line-clamp-1 pl-4">
              {{ $msg->pesan }}
            </p>
          </a>
        @empty
          <div class="py-8 text-center text-stone-500 text-xs">
            Belum ada pesan masuk terbaru.
          </div>
        @endforelse
      </div>
    </div>

    <!-- Kolom Kanan: Akses Pintas / Quick Navigation -->
    <div class="bg-stone-900 border border-stone-800 rounded-2xl p-5 space-y-4 shadow-xl">
      <h2 class="text-base font-serif font-bold text-stone-100 border-b border-stone-800 pb-3">
        Akses Pintas
      </h2>

      <div class="space-y-2.5 text-xs sm:text-sm">
        <a
          href="{{ route('admin.contact-messages.index') }}"
          class="flex items-center justify-between p-3 rounded-xl bg-stone-950 border border-stone-800 hover:border-amber-600/40 text-stone-200 transition-colors group"
        >
          <div class="flex items-center gap-2.5">
            <svg
              class="w-4 h-4 text-amber-500"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
              />
            </svg>
            <span>Buka Inbox Pesan</span>
          </div>
          <span class="text-stone-500 group-hover:text-amber-500">&rarr;</span>
        </a>

        @if (Route::has('admin.identitas-website.index'))
          <a
            href="{{ route('admin.identitas-website.index') }}"
            class="flex items-center justify-between p-3 rounded-xl bg-stone-950 border border-stone-800 hover:border-amber-600/40 text-stone-200 transition-colors group"
          >
            <div class="flex items-center gap-2.5">
              <svg
                class="w-4 h-4 text-amber-500"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                />
              </svg>
              <span>Pengaturan Identitas Website</span>
            </div>
            <span class="text-stone-500 group-hover:text-amber-500">&rarr;</span>
          </a>
        @endif

        @if (auth()->user()->role === 'admin' && Route::has('admin.kelola-content-manager.index'))
          <a
            href="{{ route('admin.kelola-content-manager.index') }}"
            class="flex items-center justify-between p-3 rounded-xl bg-stone-950 border border-stone-800 hover:border-amber-600/40 text-stone-200 transition-colors group"
          >
            <div class="flex items-center gap-2.5">
              <svg
                class="w-4 h-4 text-amber-500"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                />
              </svg>
              <span>Kelola Content Manager</span>
            </div>
            <span class="text-stone-500 group-hover:text-amber-500">&rarr;</span>
          </a>
        @endif
      </div>
    </div>

  </div>

</div>