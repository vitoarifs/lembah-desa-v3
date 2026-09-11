<div class="p-4 sm:p-6 bg-stone-950 min-h-screen text-stone-100 font-sans space-y-6">

  <!-- Flash Message -->
  @if (session()->has('message'))
    <div
      x-data="{ show: true }"
      x-show="show"
      x-init="setTimeout(() => show = false, 3000)"
      class="bg-emerald-950/80 border border-emerald-600/50 text-emerald-200 px-4 py-3 rounded-xl flex items-center justify-between text-sm shadow-lg"
    >
      <div class="flex items-center gap-2">
        <svg
          class="w-5 h-5 text-emerald-400"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M5 13l4 4L19 7"
          />
        </svg>
        <span>{{ session('message') }}</span>
      </div>
      <button
        @click="show = false"
        class="text-emerald-400 hover:text-emerald-200"
      >&times;</button>
    </div>
  @endif

  <!-- Header -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-stone-800 pb-5">
    <div>
      <span class="text-amber-500 font-medium text-xs tracking-widest uppercase">Pengaturan Sistem</span>
      <h1 class="text-2xl sm:text-3xl font-serif font-bold text-stone-100 mt-1">Identitas Website</h1>
    </div>

    <button
      wire:click="save"
      wire:loading.attr="disabled"
      class="bg-amber-600 hover:bg-amber-500 disabled:opacity-50 text-stone-950 font-semibold px-5 py-2.5 rounded-xl text-xs sm:text-sm transition-colors flex items-center justify-center gap-2 self-start sm:self-auto shadow-lg"
    >
      <span wire:loading.remove>Simpan Perubahan</span>
      <span wire:loading>Memproses...</span>
    </button>
  </div>

  <form
    wire:submit.prevent="save"
    class="space-y-6"
  >

    <!-- Section 1: Informasi Utama & Asset Gambar -->
    <div class="bg-stone-900 border border-stone-800 rounded-2xl p-5 sm:p-6 space-y-5 shadow-xl">
      <h2 class="text-base sm:text-lg font-serif font-bold text-amber-500 border-b border-stone-800 pb-3">
        Informasi Utama & Branding
      </h2>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-stone-300 text-xs sm:text-sm font-medium mb-1">Nama Website</label>
          <input
            type="text"
            wire:model="nama_website"
            class="w-full bg-stone-950 border border-stone-800 rounded-xl px-4 py-2.5 text-stone-100 text-xs sm:text-sm focus:outline-none focus:border-amber-500"
            placeholder="e.g. Lembah Desa"
          >
          @error('nama_website') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
          <label class="block text-stone-300 text-xs sm:text-sm font-medium mb-1">Tagline</label>
          <input
            type="text"
            wire:model="tagline"
            class="w-full bg-stone-950 border border-stone-800 rounded-xl px-4 py-2.5 text-stone-100 text-xs sm:text-sm focus:outline-none focus:border-amber-500"
            placeholder="e.g. Cita Rasa Autentik Nusantara"
          >
          @error('tagline') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>
      </div>

      <div>
        <label class="block text-stone-300 text-xs sm:text-sm font-medium mb-1">Deskripsi Singkat Website</label>
        <textarea
          wire:model="deskripsi_singkat"
          rows="3"
          class="w-full bg-stone-950 border border-stone-800 rounded-xl p-3 sm:p-4 text-stone-100 text-xs sm:text-sm focus:outline-none focus:border-amber-500 resize-none"
          placeholder="Tuliskan deskripsi singkat mengenai website atau bisnis Anda..."
        ></textarea>
        @error('deskripsi_singkat') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
      </div>

      <!-- Upload Logo & Favicon -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">

        <!-- Logo -->
        <div class="space-y-2">
          <label class="block text-stone-300 text-xs sm:text-sm font-medium">Logo Website</label>
          <input
            type="file"
            wire:model="logo"
            class="w-full bg-stone-950 border border-stone-800 rounded-xl px-3 py-2 text-stone-400 text-xs file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-stone-800 file:text-amber-500 hover:file:bg-stone-700 cursor-pointer"
          >
          @error('logo') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror

          <div class="mt-2 flex items-center gap-3">
            @if ($logo)
              <div class="p-2 bg-stone-950 border border-stone-800 rounded-xl">
                <span class="text-xs text-stone-500 block mb-1">Preview Baru:</span>
                <img
                  src="{{ $logo->temporaryUrl() }}"
                  class="h-12 object-contain max-w-[150px]"
                >
              </div>
            @elseif ($existingLogo)
              <div class="p-2 bg-stone-950 border border-stone-800 rounded-xl">
                <span class="text-xs text-stone-500 block mb-1">Logo Saat Ini:</span>
                <img
                  src="{{ asset('storage/' . $existingLogo) }}"
                  class="h-12 object-contain max-w-[150px]"
                >
              </div>
            @endif
          </div>
        </div>

        <!-- Favicon -->
        <div class="space-y-2">
          <label class="block text-stone-300 text-xs sm:text-sm font-medium">Favicon (Ikon Tab Browser)</label>
          <input
            type="file"
            wire:model="favicon"
            class="w-full bg-stone-950 border border-stone-800 rounded-xl px-3 py-2 text-stone-400 text-xs file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-stone-800 file:text-amber-500 hover:file:bg-stone-700 cursor-pointer"
          >
          @error('favicon') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror

          <div class="mt-2 flex items-center gap-3">
            @if ($favicon)
              <div class="p-2 bg-stone-950 border border-stone-800 rounded-xl">
                <span class="text-xs text-stone-500 block mb-1">Preview Baru:</span>
                <img
                  src="{{ $favicon->temporaryUrl() }}"
                  class="w-8 h-8 object-contain"
                >
              </div>
            @elseif ($existingFavicon)
              <div class="p-2 bg-stone-950 border border-stone-800 rounded-xl">
                <span class="text-xs text-stone-500 block mb-1">Favicon Saat Ini:</span>
                <img
                  src="{{ asset('storage/' . $existingFavicon) }}"
                  class="w-8 h-8 object-contain"
                >
              </div>
            @endif
          </div>
        </div>

      </div>
    </div>

    <!-- Section 2: Kontak & Operasional -->
    <div class="bg-stone-900 border border-stone-800 rounded-2xl p-5 sm:p-6 space-y-5 shadow-xl">
      <h2 class="text-base sm:text-lg font-serif font-bold text-amber-500 border-b border-stone-800 pb-3">
        Kontak & Operasional
      </h2>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
          <label class="block text-stone-300 text-xs sm:text-sm font-medium mb-1">Nomor WhatsApp</label>
          <input
            type="text"
            wire:model="nomor_whatsapp"
            class="w-full bg-stone-950 border border-stone-800 rounded-xl px-4 py-2.5 text-stone-100 text-xs sm:text-sm focus:outline-none focus:border-amber-500"
            placeholder="e.g. 6281234567890"
          >
          @error('nomor_whatsapp') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
          <label class="block text-stone-300 text-xs sm:text-sm font-medium mb-1">Alamat Email</label>
          <input
            type="email"
            wire:model="email"
            class="w-full bg-stone-950 border border-stone-800 rounded-xl px-4 py-2.5 text-stone-100 text-xs sm:text-sm focus:outline-none focus:border-amber-500"
            placeholder="e.g. info@omahkuliner.com"
          >
          @error('email') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
          <label class="block text-stone-300 text-xs sm:text-sm font-medium mb-1">Jam Operasional</label>
          <input
            type="text"
            wire:model="jam_operasional"
            class="w-full bg-stone-950 border border-stone-800 rounded-xl px-4 py-2.5 text-stone-100 text-xs sm:text-sm focus:outline-none focus:border-amber-500"
            placeholder="e.g. Senin - Minggu (08:00 - 21:00 WIB)"
          >
          @error('jam_operasional') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-stone-300 text-xs sm:text-sm font-medium mb-1">Alamat Lengkap</label>
          <textarea
            wire:model="alamat"
            rows="3"
            class="w-full bg-stone-950 border border-stone-800 rounded-xl p-3 text-stone-100 text-xs sm:text-sm focus:outline-none focus:border-amber-500 resize-none"
            placeholder="Tuliskan alamat fisik usaha..."
          ></textarea>
          @error('alamat') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
          <label class="block text-stone-300 text-xs sm:text-sm font-medium mb-1">Link Google Maps</label>
          <textarea
            wire:model="link_gmaps"
            rows="3"
            class="w-full bg-stone-950 border border-stone-800 rounded-xl p-3 text-stone-100 text-xs sm:text-sm focus:outline-none focus:border-amber-500 resize-none"
            placeholder="https://maps.google.com/..."
          ></textarea>
          @error('link_gmaps') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>
      </div>
    </div>

    <!-- Section 3: Media Sosial -->
    <div class="bg-stone-900 border border-stone-800 rounded-2xl p-5 sm:p-6 space-y-5 shadow-xl">
      <h2 class="text-base sm:text-lg font-serif font-bold text-amber-500 border-b border-stone-800 pb-3">
        Tautan Media Sosial
      </h2>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-stone-300 text-xs sm:text-sm font-medium mb-1">Link Instagram</label>
          <input
            type="url"
            wire:model="link_instagram"
            class="w-full bg-stone-950 border border-stone-800 rounded-xl px-4 py-2.5 text-stone-100 text-xs sm:text-sm focus:outline-none focus:border-amber-500"
            placeholder="https://instagram.com/username"
          >
          @error('link_instagram') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
          <label class="block text-stone-300 text-xs sm:text-sm font-medium mb-1">Link Facebook</label>
          <input
            type="url"
            wire:model="link_facebook"
            class="w-full bg-stone-950 border border-stone-800 rounded-xl px-4 py-2.5 text-stone-100 text-xs sm:text-sm focus:outline-none focus:border-amber-500"
            placeholder="https://facebook.com/page"
          >
          @error('link_facebook') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
          <label class="block text-stone-300 text-xs sm:text-sm font-medium mb-1">Link TikTok</label>
          <input
            type="url"
            wire:model="link_tiktok"
            class="w-full bg-stone-950 border border-stone-800 rounded-xl px-4 py-2.5 text-stone-100 text-xs sm:text-sm focus:outline-none focus:border-amber-500"
            placeholder="https://tiktok.com/@username"
          >
          @error('link_tiktok') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
          <label class="block text-stone-300 text-xs sm:text-sm font-medium mb-1">Link YouTube</label>
          <input
            type="url"
            wire:model="link_youtube"
            class="w-full bg-stone-950 border border-stone-800 rounded-xl px-4 py-2.5 text-stone-100 text-xs sm:text-sm focus:outline-none focus:border-amber-500"
            placeholder="https://youtube.com/@channel"
          >
          @error('link_youtube') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>
      </div>
    </div>

    <!-- Bottom Action Button -->
    <div class="flex justify-end pt-2">
      <button
        type="submit"
        wire:loading.attr="disabled"
        class="bg-amber-600 hover:bg-amber-500 disabled:opacity-50 text-stone-950 font-semibold px-6 py-3 rounded-xl text-xs sm:text-sm transition-colors flex items-center gap-2 shadow-xl"
      >
        <span wire:loading.remove>Simpan Pengaturan</span>
        <span wire:loading>Memproses...</span>
      </button>
    </div>

  </form>

</div>