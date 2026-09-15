<div class="p-4 sm:p-6 bg-stone-950 min-h-screen text-stone-100 font-sans space-y-6">

  <!-- Flash Message Notification -->
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

  <!-- Header Section -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-stone-800 pb-5">
    <div>
      <span class="text-amber-500 font-medium text-xs tracking-widest uppercase">Hak Akses Admin</span>
      <h1 class="text-2xl sm:text-3xl font-serif font-bold text-stone-100 mt-1">Kelola Content Manager</h1>
    </div>

    <button
      wire:click="create"
      class="bg-amber-600 hover:bg-amber-500 text-stone-950 font-semibold px-4 py-2.5 rounded-xl text-xs sm:text-sm transition-colors flex items-center justify-center gap-2 self-start sm:self-auto shadow-lg"
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
          d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"
        />
      </svg>
      <span>Buat Akun Manager</span>
    </button>
  </div>

  <!-- Search Bar -->
  <div class="flex items-center justify-between gap-4">
    <div class="relative w-full max-w-xs">
      <input
        type="text"
        wire:model.live.debounce.500ms="search"
        placeholder="Cari nama atau email..."
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
            <th class="py-4 px-6">Pengguna</th>
            <th class="py-4 px-6">Role</th>
            <th class="py-4 px-6">Status Akses</th>
            <th class="py-4 px-6 text-right">Aksi</th>
          </tr>
        </thead>
        <!-- Skeleton Loading Body -->
        <tbody wire:loading.delay wire:target="search, gotoPage, previousPage, nextPage" class="divide-y divide-stone-800/60 text-xs sm:text-sm">
          @for ($i = 0; $i < 3; $i++)
            <tr class="animate-pulse">
              <td class="py-4 px-6"><div class="h-4 w-36 bg-stone-800/60 rounded"></div></td>
              <td class="py-4 px-6"><div class="h-5 w-24 bg-stone-800/60 rounded-full"></div></td>
              <td class="py-4 px-6"><div class="h-5 w-16 bg-stone-800/60 rounded-full"></div></td>
              <td class="py-4 px-6 text-right"><div class="h-8 w-16 bg-stone-800/60 rounded-xl ml-auto"></div></td>
            </tr>
          @endfor
        </tbody>
        <!-- Real Data Body -->
        <tbody wire:loading.remove.delay wire:target="search, gotoPage, previousPage, nextPage" class="divide-y divide-stone-800/60 text-xs sm:text-sm">
          @forelse ($users as $user)
            <tr class="hover:bg-stone-800/30 transition-colors">

              <!-- User Info -->
              <td class="py-4 px-6">
                <p class="font-bold text-stone-100">{{ $user->name }}</p>
                <p class="text-stone-400 text-xs mt-0.5">{{ $user->email }}</p>
              </td>

              <!-- Role Badge -->
              <td class="py-4 px-6">
                <span class="px-2.5 py-1 bg-amber-950/60 border border-amber-800/50 text-amber-400 rounded-lg text-xs font-medium">
                  Content Manager
                </span>
              </td>

              <!-- Toggle Active Button -->
              <td class="py-4 px-6">
                <button
                  wire:click="toggleActive({{ $user->id }})"
                  class="px-3 py-1 rounded-full text-xs font-semibold border transition-colors inline-flex items-center gap-1.5 {{ $user->is_active ? 'bg-emerald-950/60 border-emerald-600/40 text-emerald-400' : 'bg-stone-950 border-stone-700 text-stone-500' }}"
                >
                  <span class="w-1.5 h-1.5 rounded-full {{ $user->is_active ? 'bg-emerald-400' : 'bg-stone-500' }}"></span>
                  {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                </button>
              </td>

              <!-- Actions -->
              <td class="py-4 px-6 text-right">
                <div class="flex items-center justify-end gap-2">
                  <button
                    wire:click="edit({{ $user->id }})"
                    class="p-2 rounded-lg bg-stone-800 hover:bg-stone-700 text-amber-500 transition-colors"
                    title="Edit Akun"
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
                    wire:click="confirmDelete({{ $user->id }})"
                    class="p-2 rounded-lg bg-stone-800 hover:bg-rose-950 hover:text-rose-400 text-stone-400 transition-colors"
                    title="Hapus Akun"
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
                colspan="4"
                class="py-12 text-center text-stone-500 text-sm"
              >
                Belum ada akun Content Manager. Klik tombol <strong>Buat Akun Manager</strong> untuk menambahkan.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if ($users->hasPages())
      <div class="px-6 py-4 border-t border-stone-800 bg-stone-950/40">
        {{ $users->links() }}
      </div>
    @endif
  </div>

  <!-- Modal Form Create / Edit -->
  @if ($isOpen)
    <div class="fixed inset-0 z-50 overflow-y-auto bg-stone-950/80 backdrop-blur-sm">
      <div class="flex min-h-full items-center justify-center p-4 sm:p-6">
        <div class="bg-stone-900 border border-stone-800 rounded-2xl max-w-lg w-full p-5 sm:p-7 space-y-5 shadow-2xl relative my-auto">

          <div class="flex items-center justify-between border-b border-stone-800 pb-4">
            <h3 class="text-base sm:text-lg font-serif font-bold text-stone-100">
              {{ $userId ? 'Edit Akun Content Manager' : 'Tambah Content Manager' }}
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

            <!-- Nama Pengguna -->
            <div>
              <label class="block text-stone-300 font-medium mb-1">Nama Lengkap</label>
              <input
                type="text"
                wire:model="name"
                class="w-full bg-stone-950 border border-stone-800 rounded-xl px-4 py-2.5 text-stone-100 focus:outline-none focus:border-amber-500"
                placeholder="e.g. Budi Santoso"
              >
              @error('name') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Email -->
            <div>
              <label class="block text-stone-300 font-medium mb-1">Alamat Email</label>
              <input
                type="email"
                wire:model="email"
                class="w-full bg-stone-950 border border-stone-800 rounded-xl px-4 py-2.5 text-stone-100 focus:outline-none focus:border-amber-500"
                placeholder="e.g. budi@domain.com"
              >
              @error('email') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Password -->
            <div>
              <label class="block text-stone-300 font-medium mb-1">
                Password {{ $userId ? '(Opsional)' : '' }}
              </label>
              <input
                type="password"
                wire:model="password"
                class="w-full bg-stone-950 border border-stone-800 rounded-xl px-4 py-2.5 text-stone-100 focus:outline-none focus:border-amber-500"
                placeholder="{{ $userId ? 'Kosongkan jika tidak ingin diubah' : 'Minimal 8 karakter' }}"
              >
              @error('password') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Checkbox Aktif -->
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
              >Aktifkan Akun Ini</label>
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
                wire:loading.attr="disabled"
                class="px-5 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-500 disabled:opacity-50 disabled:cursor-not-allowed text-stone-950 font-semibold transition-colors flex items-center gap-2"
              >
                <span wire:loading.remove>{{ $userId ? 'Simpan Perubahan' : 'Buat Akun' }}</span>
                <span wire:loading>Memproses...</span>
              </button>
            </div>

          </form>

        </div>
      </div>
    </div>
  @endif

  <!-- Modal Confirm Delete -->
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

          <h3 class="text-lg font-bold text-stone-100">Konfirmasi Hapus Akun</h3>
          <p class="text-xs sm:text-sm text-stone-400">Apakah Anda yakin ingin menghapus akun Content Manager ini? Akun ini tidak akan bisa digunakan lagi.</p>

          <div class="flex items-center justify-center gap-3 pt-2">
            <button
              wire:click="$set('isConfirmingDelete', false)"
              class="px-4 py-2 rounded-xl border border-stone-700 text-stone-300 text-xs sm:text-sm hover:bg-stone-800 transition-colors"
            >Batal</button>

            <button
              wire:click="delete"
              class="px-4 py-2 rounded-xl bg-rose-600 hover:bg-rose-500 text-white font-medium text-xs sm:text-sm transition-colors"
            >Ya, Hapus Akun</button>
          </div>
        </div>
      </div>
    </div>
  @endif

</div>