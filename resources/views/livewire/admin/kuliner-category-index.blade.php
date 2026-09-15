<div class="p-4 sm:p-6 bg-stone-950 min-h-screen text-stone-100 font-sans space-y-6">
    @if (session()->has('message'))
        <div class="p-4 bg-emerald-950/40 border border-emerald-900/50 rounded-xl flex items-center justify-between">
            <span class="text-xs sm:text-sm font-medium text-emerald-400">{{ session('message') }}</span>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="p-4 bg-rose-950/40 border border-rose-900/50 rounded-xl flex items-center justify-between">
            <span class="text-xs sm:text-sm font-medium text-rose-400">{{ session('error') }}</span>
        </div>
    @endif
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-stone-800 pb-5">
        <div>
            <span class="text-amber-500 font-medium text-xs tracking-widest uppercase">Panel Admin</span>
            <h1 class="text-2xl sm:text-3xl font-serif font-bold text-stone-100 mt-1">Kelola Kategori Kuliner</h1>
            <p class="text-xs sm:text-sm text-stone-500 mt-1">Daftar grup menu kuliner untuk publik Lembah Desa</p>
        </div>
        <button type="button" wire:click="openModal" class="bg-amber-600 hover:bg-amber-500 text-stone-950 font-semibold px-4 py-2.5 rounded-xl text-xs sm:text-sm transition-colors flex items-center justify-center gap-2 self-start md:self-auto">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span>Tambah Kategori Baru</span>
        </button>
    </div>
    <!-- Search -->
    <div class="flex flex-col sm:flex-row gap-3">
        <div class="relative w-full sm:w-80">
            <input type="text" wire:model.live.debounce.500ms="search" placeholder="Cari nama kategori..." class="w-full pl-9 pr-4 py-2.5 bg-stone-900 border border-stone-800 rounded-xl text-xs sm:text-sm text-stone-100 placeholder-stone-600 focus:ring-2 focus:ring-amber-500/30 focus:border-amber-600 outline-none transition">
            <svg wire:loading.remove wire:target="search" class="w-4 h-4 text-stone-600 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <svg wire:loading wire:target="search" class="animate-spin w-4 h-4 text-amber-500 absolute left-3 top-3" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
            </svg>
        </div>
    </div>
    <!-- Table -->
    <div class="bg-stone-900 border border-stone-800 rounded-2xl overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-stone-400">
                <thead class="bg-stone-900/80 text-stone-500 font-semibold uppercase tracking-wider border-b border-stone-800">
                    <tr>
                        <th class="px-6 py-4">Nama Kategori</th>
                        <th class="px-6 py-4">Slug</th>
                        <th class="px-6 py-4">Jumlah Menu</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <!-- Skeleton Loading Body -->
                <tbody wire:loading.delay wire:target="search, gotoPage, previousPage, nextPage" class="divide-y divide-stone-800">
                    @for ($i = 0; $i < 4; $i++)
                        <tr class="animate-pulse">
                            <td class="px-6 py-4"><div class="h-4 w-32 bg-stone-800 rounded"></div></td>
                            <td class="px-6 py-4"><div class="h-4 w-24 bg-stone-800 rounded"></div></td>
                            <td class="px-6 py-4"><div class="h-5 w-16 bg-stone-800 rounded-full"></div></td>
                            <td class="px-6 py-4 text-right"><div class="h-8 w-16 bg-stone-800 rounded-lg ml-auto"></div></td>
                        </tr>
                    @endfor
                </tbody>
                <!-- Real Data Body -->
                <tbody wire:loading.remove.delay wire:target="search, gotoPage, previousPage, nextPage" class="divide-y divide-stone-800">
                    @forelse ($categories as $category)
                        <tr class="hover:bg-stone-800/40 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-semibold text-stone-100">{{ $category->nama }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-stone-500 font-mono text-xs">{{ $category->slug }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-amber-950/40 text-amber-400 border border-amber-900/50">
                                    {{ $category->menus_count }} Menu
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-1">
                                    <button type="button" wire:click="edit({{ $category->id }})" class="p-2 text-stone-500 hover:text-amber-400 hover:bg-stone-800 rounded-lg transition-colors cursor-pointer" title="Edit kategori">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-9.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 7.5-7.5z"/>
                                        </svg>
                                    </button>
                                    <button type="button" onclick="confirm('Yakin ingin menghapus kategori ini?') || event.stopImmediatePropagation()" wire:click="delete({{ $category->id }})" class="p-2 text-stone-500 hover:text-rose-400 hover:bg-stone-800 rounded-lg transition-colors cursor-pointer" title="Hapus kategori">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3m-4 0h14"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-10 h-10 text-stone-700 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7h4l2-2h4l2 2h6v12a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/>
                                    </svg>
                                    <p class="text-stone-500 text-sm">Belum ada data kategori kuliner.</p>
                                    <p class="text-stone-600 text-xs mt-1">Tambahkan kategori untuk mulai mengelola menu.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($categories->hasPages())
            <div class="px-6 py-4 border-t border-stone-800">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
    <!-- Modal Form Create / Edit -->
    @if ($isModalOpen)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen px-4 py-6 text-center sm:p-0">
                <div class="fixed inset-0 bg-black/70 backdrop-blur-sm" wire:click="closeModal"></div>
                <div class="relative inline-block w-full max-w-md p-6 overflow-hidden text-left align-middle bg-stone-900 border border-stone-800 rounded-2xl shadow-2xl transform transition-all z-10">
                    <div class="flex items-start justify-between gap-4 border-b border-stone-800 pb-4">
                        <div>
                            <span class="text-amber-500 font-medium text-[10px] tracking-widest uppercase">Kategori Kuliner</span>
                            <h3 class="text-lg sm:text-xl font-serif font-bold text-stone-100 mt-1">{{ $categoryId ? 'Edit Kategori Kuliner' : 'Tambah Kategori Kuliner' }}</h3>
                        </div>
                        <button type="button" wire:click="closeModal" class="p-1.5 text-stone-500 hover:text-stone-200 hover:bg-stone-800 rounded-lg transition-colors cursor-pointer">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                    <form wire:submit.prevent="save" class="mt-5 space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-stone-300 uppercase tracking-wider mb-1.5">Nama Kategori</label>
                            <input type="text" wire:model.live="nama" class="w-full px-3.5 py-2.5 bg-stone-950 border border-stone-800 rounded-xl text-sm text-stone-100 placeholder-stone-600 focus:ring-2 focus:ring-amber-500/30 focus:border-amber-600 outline-none transition" placeholder="Contoh: Makanan Utama">
                            @error('nama') <span class="text-xs text-rose-400 mt-1.5 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-stone-300 uppercase tracking-wider mb-1.5">Slug URL</label>
                            <input type="text" wire:model="slug" class="w-full px-3.5 py-2.5 bg-stone-950/50 border border-stone-800 rounded-xl text-xs text-stone-500 focus:ring-2 focus:ring-amber-500/30 focus:border-amber-600 outline-none font-mono" readonly>
                            @error('slug') <span class="text-xs text-rose-400 mt-1.5 block">{{ $message }}</span> @enderror
                        </div>
                        <div class="pt-4 border-t border-stone-800 flex items-center justify-end gap-2">
                            <button type="button" wire:click="closeModal" class="px-4 py-2.5 bg-stone-800 hover:bg-stone-700 text-stone-300 text-xs font-medium rounded-xl transition-colors cursor-pointer">Batal</button>
                            <button type="submit" wire:loading.attr="disabled" class="px-4 py-2.5 bg-amber-600 hover:bg-amber-500 disabled:opacity-50 disabled:cursor-not-allowed text-stone-950 text-xs font-semibold rounded-xl transition-colors cursor-pointer flex items-center gap-2">
                                <span wire:loading.remove wire:target="save">
                                    {{ $categoryId ? 'Simpan Perubahan' : 'Tambah Kategori' }}
                                </span>
                                <span wire:loading wire:target="save">
                                    Memproses...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>