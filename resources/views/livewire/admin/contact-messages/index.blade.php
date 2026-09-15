<div class="p-4 sm:p-6 bg-stone-950 min-h-screen text-stone-100 font-sans space-y-6">

  <!-- Flash Message Notification -->
  @if (session()->has('message'))
    <div
      x-data="{ show: true }"
      x-show="show"
      x-init="setTimeout(() => show = false, 3500)"
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

  <!-- Header Section -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-stone-800 pb-5">
    <div>
      <span class="text-amber-500 font-medium text-xs tracking-widest uppercase">Lembah Desa Pulutan</span>
      <h1 class="text-2xl sm:text-3xl font-serif font-bold text-stone-100 mt-1 flex items-center gap-3">
        <span>Pesan Masuk</span>
        @if ($unreadCount > 0)
          <span class="px-2.5 py-0.5 rounded-full text-xs font-sans font-semibold bg-amber-500/20 text-amber-400 border border-amber-500/40">
            {{ $unreadCount }} Belum Dibaca
          </span>
        @endif
      </h1>
    </div>

    <div class="text-xs text-stone-400">
      Total Pesan: <strong class="text-stone-200">{{ $messages->total() }}</strong>
    </div>
  </div>

  <!-- Search Filter -->
  <div class="flex items-center justify-between gap-4">
    <div class="relative w-full max-w-sm">
      <input
        type="text"
        wire:model.live.debounce.500ms="search"
        placeholder="Cari berdasarkan nama, email, atau isi pesan..."
        class="w-full bg-stone-900 border border-stone-800 text-stone-200 text-xs sm:text-sm rounded-xl pl-9 pr-4 py-2.5 focus:outline-none focus:border-amber-500 placeholder-stone-500 transition-colors"
      >
      <svg
        wire:loading.remove
        wire:target="search"
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
      <svg
        wire:loading
        wire:target="search"
        class="animate-spin w-4 h-4 text-amber-500 absolute left-3 top-3"
        fill="none"
        viewBox="0 0 24 24"
      >
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
      </svg>
    </div>
  </div>

  <!-- Table Container -->
  <div class="bg-stone-900 border border-stone-800 rounded-2xl overflow-hidden shadow-xl">
    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse">
        <thead>
          <tr class="bg-stone-950/60 border-b border-stone-800 text-stone-400 text-xs uppercase tracking-wider">
            <th class="py-4 px-6">Pengirim</th>
            <th class="py-4 px-6">Preview Pesan</th>
            <th class="py-4 px-6">Status</th>
            <th class="py-4 px-6">Waktu</th>
            <th class="py-4 px-6 text-right">Aksi</th>
          </tr>
        </thead>
        <!-- Skeleton Loading Body -->
        <tbody wire:loading.delay wire:target="search, gotoPage, previousPage, nextPage" class="divide-y divide-stone-800/60 text-xs sm:text-sm">
          @for ($i = 0; $i < 4; $i++)
            <tr class="animate-pulse">
              <td class="py-4 px-6"><div class="h-4 w-36 bg-stone-800/60 rounded"></div></td>
              <td class="py-4 px-6"><div class="h-4 w-48 bg-stone-800/60 rounded"></div></td>
              <td class="py-4 px-6"><div class="h-5 w-16 bg-stone-800/60 rounded-full"></div></td>
              <td class="py-4 px-6"><div class="h-4 w-24 bg-stone-800/60 rounded"></div></td>
              <td class="py-4 px-6 text-right"><div class="h-8 w-16 bg-stone-800/60 rounded-xl ml-auto"></div></td>
            </tr>
          @endfor
        </tbody>
        <!-- Real Data Body -->
        <tbody wire:loading.remove.delay wire:target="search, gotoPage, previousPage, nextPage" class="divide-y divide-stone-800/60 text-xs sm:text-sm">
          @forelse ($messages as $message)
            <tr class="hover:bg-stone-800/40 transition-colors {{ !$message->is_read ? 'bg-amber-950/10' : '' }}">

              <!-- Pengirim -->
              <td class="py-4 px-6">
                <div class="flex items-center gap-2.5">
                  @if (!$message->is_read)
                    <span
                      class="w-2 h-2 rounded-full bg-amber-500 animate-pulse shrink-0"
                      title="Belum dibaca"
                    ></span>
                  @endif
                  <div>
                    <p class="{{ !$message->is_read ? 'font-bold text-stone-100' : 'font-medium text-stone-300' }}">
                      {{ $message->nama }}
                    </p>
                    <p class="text-stone-400 text-xs mt-0.5">{{ $message->email }}</p>
                  </div>
                </div>
              </td>

              <!-- Preview Pesan -->
              <td
                class="py-4 px-6 cursor-pointer"
                wire:click="showDetail({{ $message->id }})"
              >
                <p class="text-stone-300 line-clamp-1 max-w-md hover:text-amber-400 transition-colors">
                  {{ \Illuminate\Support\Str::limit($message->pesan, 70) }}
                </p>
              </td>

              <!-- Status Badge -->
              <td class="py-4 px-6 whitespace-nowrap">
                @if ($message->is_read)
                  <span class="px-2.5 py-1 bg-stone-950 border border-stone-800 text-stone-400 rounded-lg text-xs font-medium inline-flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-stone-500"></span>
                    Sudah Dibaca
                  </span>
                @else
                  <span class="px-2.5 py-1 bg-amber-950/60 border border-amber-700/50 text-amber-400 rounded-lg text-xs font-semibold inline-flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                    Belum Dibaca
                  </span>
                @endif
              </td>

              <!-- Waktu -->
            <td class="py-4 px-6 whitespace-nowrap text-stone-400 text-xs">
                <div>
                    {{ $message->created_at->timezone('Asia/Jakarta')->translatedFormat('d M Y') }}
                </div>

                <div class="text-stone-500 mt-0.5">
                    {{ $message->created_at->timezone('Asia/Jakarta')->format('H:i') }} WIB
                </div>
            </td>

              <!-- Aksi -->
              <td class="py-4 px-6 text-right whitespace-nowrap">
                <div class="flex items-center justify-end gap-2">
                  <!-- Button Detail -->
                  <button
                    wire:click="showDetail({{ $message->id }})"
                    class="p-2 rounded-lg bg-stone-800 hover:bg-stone-700 text-amber-500 transition-colors"
                    title="Lihat Detail Pesan"
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
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                      />
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                      />
                    </svg>
                  </button>

                  <!-- Toggle Status Read -->
                  <button
                    wire:click="toggleRead({{ $message->id }})"
                    class="p-2 rounded-lg bg-stone-800 hover:bg-stone-700 text-stone-300 transition-colors"
                    title="{{ $message->is_read ? 'Tandai Belum Dibaca' : 'Tandai Sudah Dibaca' }}"
                  >
                    @if ($message->is_read)
                      <svg
                        class="w-4 h-4 text-stone-400"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M3 19v-8a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H4a1 1 0 01-1-1z"
                        />
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M3 11l9-7 9 7"
                        />
                      </svg>
                    @else
                      <svg
                        class="w-4 h-4 text-emerald-400"
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
                    @endif
                  </button>

                  <!-- Button Hapus -->
                  <button
                    wire:click="confirmDelete({{ $message->id }})"
                    class="p-2 rounded-lg bg-stone-800 hover:bg-rose-950 hover:text-rose-400 text-stone-400 transition-colors"
                    title="Hapus Pesan"
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
                <div class="flex flex-col items-center justify-center space-y-2">
                  <svg
                    class="w-10 h-10 text-stone-600"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="1.5"
                      d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"
                    />
                  </svg>
                  <p>Tidak ada pesan masuk yang ditemukan.</p>
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if ($messages->hasPages())
      <div class="px-6 py-4 border-t border-stone-800 bg-stone-950/40">
        {{ $messages->links() }}
      </div>
    @endif
  </div>

  <!-- Modal Detail Pesan -->
  @if ($isDetailOpen && $selectedMessage)
    <div class="fixed inset-0 z-50 overflow-y-auto bg-stone-950/80 backdrop-blur-sm">
      <div class="flex min-h-full items-center justify-center p-4 sm:p-6">
        <div class="bg-stone-900 border border-stone-800 rounded-2xl max-w-2xl w-full p-5 sm:p-7 space-y-6 shadow-2xl relative my-auto">

          <!-- Modal Header -->
          <div class="flex items-start justify-between border-b border-stone-800 pb-4">
            <div>
              <span class="text-amber-500 font-medium text-xs uppercase tracking-wider">Detail Pesan Masuk</span>
              <h3 class="text-lg font-serif font-bold text-stone-100 mt-1">{{ $selectedMessage->nama }}</h3>
              <p class="text-xs text-stone-400 mt-0.5">
                <a
                  href="mailto:{{ $selectedMessage->email }}"
                  class="text-amber-400 hover:underline"
                >{{ $selectedMessage->email }}</a>
                &bull; {{ $selectedMessage->created_at->translatedFormat('d F Y, H:i') }} WIB
              </p>
            </div>
            <button
              wire:click="closeDetail"
              class="text-stone-400 hover:text-stone-100 text-2xl font-bold leading-none"
            >&times;</button>
          </div>

          <!-- Modal Body / Content -->
          <div class="space-y-2">
            <label class="block text-xs font-medium text-stone-400 uppercase tracking-wider">Isi Pesan:</label>
            <div class="bg-stone-950 border border-stone-800/80 rounded-xl p-4 sm:p-5 text-stone-200 text-sm leading-relaxed whitespace-pre-line font-sans max-h-80 overflow-y-auto">
              {{ $selectedMessage->pesan }}
            </div>
          </div>

          <!-- Modal Footer / Actions -->
          <div class="flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-stone-800 pt-4">
            <div class="flex items-center gap-2 w-full sm:w-auto">
              <button
                wire:click="toggleRead({{ $selectedMessage->id }})"
                class="px-3.5 py-2 rounded-xl text-xs font-semibold border transition-colors w-full sm:w-auto flex items-center justify-center gap-1.5 {{ $selectedMessage->is_read ? 'bg-stone-950 border-stone-700 text-stone-400 hover:text-stone-200' : 'bg-amber-950 border-amber-700 text-amber-400' }}"
              >
                {{ $selectedMessage->is_read ? 'Tandai Belum Dibaca' : 'Tandai Sudah Dibaca' }}
              </button>

              <a
                href="mailto:{{ $selectedMessage->email }}?subject=Balasan: Pesan dari Website Lembah Desa Pulutan"
                class="px-3.5 py-2 rounded-xl text-xs font-semibold bg-emerald-600 hover:bg-emerald-500 text-stone-950 transition-colors w-full sm:w-auto text-center"
              >
                Balas via Email
              </a>
            </div>

            <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
              <button
                wire:click="confirmDelete({{ $selectedMessage->id }})"
                class="px-3.5 py-2 rounded-xl text-xs font-semibold bg-stone-800 hover:bg-rose-950 hover:text-rose-400 text-stone-300 transition-colors"
              >
                Hapus
              </button>
              <button
                wire:click="closeDetail"
                class="px-4 py-2 rounded-xl text-xs font-semibold bg-stone-800 hover:bg-stone-700 text-stone-200 transition-colors"
              >
                Tutup
              </button>
            </div>
          </div>

        </div>
      </div>
    </div>
  @endif

  <!-- Modal Konfirmasi Hapus -->
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

          <h3 class="text-lg font-bold text-stone-100">Hapus Pesan Masuk?</h3>
          <p class="text-xs sm:text-sm text-stone-400">Pesan yang telah dihapus tidak dapat dikembalikan. Apakah Anda yakin ingin melanjutkan?</p>

          <div class="flex items-center justify-center gap-3 pt-2">
            <button
              wire:click="$set('isConfirmingDelete', false)"
              class="px-4 py-2 rounded-xl border border-stone-700 text-stone-300 text-xs sm:text-sm hover:bg-stone-800 transition-colors"
            >Batal</button>

            <button
              wire:click="delete"
              class="px-4 py-2 rounded-xl bg-rose-600 hover:bg-rose-500 text-white font-medium text-xs sm:text-sm transition-colors"
            >Ya, Hapus Pesan</button>
          </div>
        </div>
      </div>
    </div>
  @endif

</div>