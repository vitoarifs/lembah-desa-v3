<div class="p-4 sm:p-6 bg-stone-950 min-h-screen text-stone-100 font-sans space-y-6">

  <!-- Flash Message Notification -->
  @if (session()->has('message'))
    <div
      x-data="{ show: true }"
      x-show="show"
      x-init="setTimeout(() => show = false, 3000)"
      class="bg-emerald-950/80 border border-emerald-600/50 text-emerald-200 px-4 py-3 rounded-xl flex items-center justify-between text-sm"
    >
      <span>{{ session('message') }}</span>
      <button
        @click="show = false"
        class="text-emerald-400 hover:text-emerald-200"
      >&times;</button>
    </div>
  @endif

  <!-- Header Section -->
  <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-stone-800 pb-5">
    <div>
      <span class="text-amber-500 font-medium text-xs tracking-widest uppercase">Panel Admin</span>
      <h1 class="text-2xl sm:text-3xl font-serif font-bold text-stone-100 mt-1">Kelola Event & Acara</h1>
    </div>

    <button
      wire:click="create"
      class="bg-amber-600 hover:bg-amber-500 text-stone-950 font-semibold px-4 py-2.5 rounded-xl text-xs sm:text-sm transition-colors flex items-center justify-center gap-2 self-start md:self-auto"
    >
      <svg
        class="w-4 h-4"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M12 4v16m8-8H4"
        />
      </svg>
      <span>Tambah Event Baru</span>
    </button>
  </div>

  <!-- Search Bar -->
  <div class="flex items-center justify-between gap-4">
    <div class="relative w-full max-w-xs">
      <input
        type="text"
        wire:model.live.debounce.300ms="search"
        placeholder="Cari event atau lokasi..."
        class="w-full bg-stone-900 border border-stone-800 text-stone-200 text-xs sm:text-sm rounded-xl pl-9 pr-4 py-2.5 focus:outline-none focus:border-amber-500 placeholder-stone-500 transition-colors"
      >
      <svg
        class="w-4 h-4 text-stone-500 absolute left-3 top-3"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
        />
      </svg>
    </div>
  </div>

  <!-- Table Container -->
  <div class="bg-stone-900 border border-stone-800 rounded-2xl overflow-hidden shadow-xl">
    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse">
        <thead>
          <tr class="bg-stone-950/60 border-b border-stone-800 text-stone-400 text-xs uppercase tracking-wider">
            <th class="py-4 px-6">Judul Event</th>
            <th class="py-4 px-6">Waktu & Tempat</th>
            <th class="py-4 px-6">HTM</th>
            <th class="py-4 px-6">Status</th>
            <th class="py-4 px-6 text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-stone-800/60 text-xs sm:text-sm">
          @forelse ($events as $event)
            <tr class="hover:bg-stone-800/30 transition-colors">

              <!-- Title -->
              <td class="py-4 px-6">
                <p class="font-bold text-stone-100 max-w-xs sm:max-w-sm">{{ $event->judul }}</p>
                <p class="text-stone-400 text-xs mt-0.5">{{ $event->formatted_tanggal }}</p>
              </td>

              <!-- Time & Location -->
              <td class="py-4 px-6 text-stone-300">
                <p class="text-amber-500/90 font-medium">{{ $event->waktu }}</p>
                <p class="text-stone-400 text-xs mt-0.5">{{ $event->lokasi }}</p>
              </td>

              <!-- HTM -->
              <td class="py-4 px-6 text-stone-300 font-medium">
                {{ $event->htm }}
              </td>

              <!-- Status Toggle -->
              <td class="py-4 px-6">
                <button
                  wire:click="toggleActive({{ $event->id }})"
                  class="px-3 py-1 rounded-full text-xs font-semibold border transition-colors inline-flex items-center gap-1.5 {{ $event->is_active ? 'bg-emerald-950/60 border-emerald-600/40 text-emerald-400' : 'bg-stone-950 border-stone-700 text-stone-500' }}"
                >
                  <span class="w-1.5 h-1.5 rounded-full {{ $event->is_active ? 'bg-emerald-400' : 'bg-stone-500' }}"></span>
                  {{ $event->is_active ? 'Aktif' : 'Nonaktif' }}
                </button>
              </td>

              <!-- Action Buttons -->
              <td class="py-4 px-6 text-right">
                <div class="flex items-center justify-end gap-2">
                  <button
                    wire:click="edit({{ $event->id }})"
                    class="p-2 rounded-lg bg-stone-800 hover:bg-stone-700 text-amber-500 transition-colors"
                    title="Edit Event"
                  >
                    <svg
                      class="w-4 h-4"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                      />
                    </svg>
                  </button>

                  <button
                    wire:click="confirmDelete({{ $event->id }})"
                    class="p-2 rounded-lg bg-stone-800 hover:bg-rose-950 hover:text-rose-400 text-stone-400 transition-colors"
                    title="Hapus Event"
                  >
                    <svg
                      class="w-4 h-4"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                      />
                    </svg>
                  </button>
                </div>
              </td>

            </tr>
          @empty
            <tr>
              <td
                colspan="5"
                class="py-12 text-center text-stone-500 text-sm"
              >
                Belum ada data event/acara. Klik tombol <strong>Tambah Event Baru</strong> untuk menambahkan.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if ($events->hasPages())
      <div class="px-6 py-4 border-t border-stone-800 bg-stone-950/40">
        {{ $events->links() }}
      </div>
    @endif
  </div>

  <!-- Form Modal (Create / Edit) - Fixed Mobile Viewport Overflow -->
  @if ($isOpen)
    <div class="fixed inset-0 z-50 overflow-y-auto bg-stone-950/80 backdrop-blur-sm">
      <div class="flex min-h-full items-center justify-center p-4 sm:p-6">
        <div class="bg-stone-900 border border-stone-800 rounded-2xl max-w-2xl w-full p-5 sm:p-8 space-y-5 shadow-2xl relative my-auto">

          <div class="flex items-center justify-between border-b border-stone-800 pb-4">
            <h3 class="text-base sm:text-lg font-serif font-bold text-stone-100">
              {{ $eventId ? 'Edit Event & Acara' : 'Tambah Event Baru' }}
            </h3>
            <button
              wire:click="closeModal"
              class="text-stone-400 hover:text-stone-200 text-2xl font-bold leading-none"
            >&times;</button>
          </div>

          <form
            wire:submit.prevent="save"
            class="space-y-4 text-xs sm:text-sm"
          >

            <!-- Judul Event -->
            <div>
              <label class="block text-stone-300 font-medium mb-1">Judul Event</label>
              <input
                type="text"
                wire:model="judul"
                class="w-full bg-stone-950 border border-stone-800 rounded-xl px-4 py-2.5 text-stone-100 focus:outline-none focus:border-amber-500"
                placeholder="e.g. Pasar Kuliner Tradisional & Musik Bambu"
              >
              @error('judul') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Grid Tanggal, Waktu, HTM -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4">
              <div>
                <label class="block text-stone-300 font-medium mb-1">Tanggal</label>
                <input
                  type="date"
                  wire:model="tanggal"
                  class="w-full bg-stone-950 border border-stone-800 rounded-xl px-3 py-2.5 text-stone-100 focus:outline-none focus:border-amber-500"
                >
                @error('tanggal') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
              </div>

              <div>
                <label class="block text-stone-300 font-medium mb-1">Waktu Execution</label>
                <input
                  type="text"
                  wire:model="waktu"
                  class="w-full bg-stone-950 border border-stone-800 rounded-xl px-4 py-2.5 text-stone-100 focus:outline-none focus:border-amber-500"
                  placeholder="e.g. 06:00 - 11:00 WIB"
                >
                @error('waktu') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
              </div>

              <div>
                <label class="block text-stone-300 font-medium mb-1">HTM / Biaya</label>
                <input
                  type="text"
                  wire:model="htm"
                  class="w-full bg-stone-950 border border-stone-800 rounded-xl px-4 py-2.5 text-stone-100 focus:outline-none focus:border-amber-500"
                  placeholder="e.g. Gratis / Rp 75.000"
                >
                @error('htm') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
              </div>
            </div>

            <!-- Lokasi -->
            <div>
              <label class="block text-stone-300 font-medium mb-1">Lokasi Tempat</label>
              <input
                type="text"
                wire:model="lokasi"
                class="w-full bg-stone-950 border border-stone-800 rounded-xl px-4 py-2.5 text-stone-100 focus:outline-none focus:border-amber-500"
                placeholder="e.g. Halaman Pendopo Ageng"
              >
              @error('lokasi') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Deskripsi -->
            <div>
              <label class="block text-stone-300 font-medium mb-1">Deskripsi Lengkap</label>
              <textarea
                wire:model="deskripsi"
                rows="3"
                class="w-full bg-stone-950 border border-stone-800 rounded-xl p-3 sm:p-4 text-stone-100 focus:outline-none focus:border-amber-500 resize-none"
                placeholder="Tuliskan rincian kegiatan event..."
              ></textarea>
              @error('deskripsi') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Status Aktif Toggle -->
            <div class="flex items-center gap-2 pt-1">
              <input
                type="checkbox"
                id="is_active"
                wire:model="is_active"
                class="rounded bg-stone-950 border-stone-800 text-amber-500 focus:ring-0 w-4 h-4 cursor-pointer"
              >
              <label
                for="is_active"
                class="text-stone-300 font-medium select-none cursor-pointer"
              >Publikasikan Event Ini</label>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-stone-800">
              <button
                type="button"
                wire:click="closeModal"
                class="px-4 py-2.5 rounded-xl border border-stone-700 text-stone-300 hover:bg-stone-800 transition-colors"
              >Batal</button>

              <button
                type="submit"
                class="px-5 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-500 text-stone-950 font-semibold transition-colors flex items-center gap-2"
              >
                <span wire:loading.remove>{{ $eventId ? 'Simpan Perubahan' : 'Tambah Event' }}</span>
                <span wire:loading>Memproses...</span>
              </button>
            </div>

          </form>

        </div>
      </div>
    </div>
  @endif

  <!-- Confirm Delete Modal -->
  @if ($isConfirmingDelete)
    <div class="fixed inset-0 z-50 overflow-y-auto bg-stone-950/80 backdrop-blur-sm">
      <div class="flex min-h-full items-center justify-center p-4">
        <div class="bg-stone-900 border border-stone-800 rounded-2xl max-w-md w-full p-6 space-y-4 shadow-2xl text-center my-auto">
          <div class="w-12 h-12 bg-rose-950/80 border border-rose-800 text-rose-500 rounded-full flex items-center justify-center mx-auto">
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
                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
              />
            </svg>
          </div>

          <h3 class="text-lg font-bold text-stone-100">Konfirmasi Hapus Event</h3>
          <p class="text-xs sm:text-sm text-stone-400">Apakah Anda yakin ingin menghapus event ini? Tindakan ini tidak dapat dibatalkan.</p>

          <div class="flex items-center justify-center gap-3 pt-2">
            <button
              wire:click="$set('isConfirmingDelete', false)"
              class="px-4 py-2 rounded-xl border border-stone-700 text-stone-300 text-xs sm:text-sm hover:bg-stone-800 transition-colors"
            >Batal</button>

            <button
              wire:click="delete"
              class="px-4 py-2 rounded-xl bg-rose-600 hover:bg-rose-500 text-white font-medium text-xs sm:text-sm transition-colors"
            >Ya, Hapus Data</button>
          </div>
        </div>
      </div>
    </div>
  @endif

</div>