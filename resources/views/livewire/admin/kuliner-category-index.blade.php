<div>
    <!-- Slot Header Admin -->
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-bold text-gray-800 leading-tight">Kelola Kategori Kuliner</h2>
                <p class="text-xs text-gray-500 mt-1">Daftar grup menu kuliner untuk publik Lembah Desa</p>
            </div>
            <button 
                wire:click="openModal" 
                class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-amber-600 hover:bg-amber-500 text-white text-xs font-semibold rounded-lg shadow-sm transition"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Tambah Kategori</span>
            </button>
        </div>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-6">

        <!-- Notifikasi / Flash Messages -->
        @if (session()->has('message'))
            <div class="p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-r-lg flex items-center justify-between">
                <span class="text-xs sm:text-sm font-medium text-emerald-800">{{ session('message') }}</span>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="p-4 bg-rose-50 border-l-4 border-rose-500 rounded-r-lg flex items-center justify-between">
                <span class="text-xs sm:text-sm font-medium text-rose-800">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Card Tabel Data -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
            <!-- Search & Filter Bar -->
            <div class="p-4 border-b border-gray-200 bg-gray-50/50 flex items-center justify-between gap-4">
                <div class="relative w-full sm:w-72">
                    <input 
                        type="text" 
                        wire:model.live.debounce.300ms="search" 
                        placeholder="Cari nama kategori..." 
                        class="w-full pl-9 pr-4 py-2 bg-white border border-gray-300 rounded-lg text-xs text-gray-800 focus:ring-2 focus:ring-amber-500 focus:border-amber-500"
                    >
                    <svg class="w-4 h-4 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-gray-600">
                    <thead class="bg-gray-100 text-gray-700 font-semibold uppercase tracking-wider border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3.5">Nama Kategori</th>
                            <th class="px-6 py-3.5">Slug</th>
                            <th class="px-6 py-3.5">Jumlah Menu</th>
                            <th class="px-6 py-3.5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($categories as $category)
                            <tr class="hover:bg-gray-50/80 transition">
                                <td class="px-6 py-4 font-semibold text-gray-900">{{ $category->nama }}</td>
                                <td class="px-6 py-4 text-gray-500 font-mono">{{ $category->slug }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-800 border border-amber-200">
                                        {{ $category->menus_count }} Menu
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <button wire:click="edit({{ $category->id }})" class="text-indigo-600 hover:text-indigo-900 font-medium transition">Edit</button>
                                    <button 
                                        onclick="confirm('Yakin ingin menghapus kategori ini?') || event.stopImmediatePropagation()" 
                                        wire:click="delete({{ $category->id }})" 
                                        class="text-rose-600 hover:text-rose-900 font-medium transition"
                                    >Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-400">Belum ada data kategori kuliner.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-4 border-t border-gray-200">
                {{ $categories->links() }}
            </div>
        </div>
    </div>

    <!-- Modal Form Create / Edit -->
    @if ($isModalOpen)
        <div class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                <!-- Backdrop -->
                <div class="fixed inset-0 bg-gray-900/60 transition-opacity" wire:click="closeModal"></div>

                <!-- Modal Content -->
                <div class="relative inline-block w-full max-w-md p-6 overflow-hidden text-left align-middle bg-white rounded-2xl shadow-xl transform transition-all z-10">
                    <h3 class="text-lg font-bold leading-6 text-gray-900 border-b border-gray-100 pb-3">
                        {{ $categoryId ? 'Edit Kategori Kuliner' : 'Tambah Kategori Kuliner' }}
                    </h3>

                    <form wire:submit.prevent="save" class="mt-4 space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Nama Kategori</label>
                            <input 
                                type="text" 
                                wire:model.live="nama" 
                                class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg text-xs text-gray-900 focus:ring-2 focus:ring-amber-500 focus:border-amber-500" 
                                placeholder="Contoh: Makanan Utama"
                            >
                            @error('nama') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Slug URL</label>
                            <input 
                                type="text" 
                                wire:model="slug" 
                                class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg text-xs text-gray-600 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 font-mono" 
                                readonly
                            >
                            @error('slug') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-2">
                            <button 
                                type="button" 
                                wire:click="closeModal" 
                                class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-medium rounded-lg transition"
                            >
                                Batal
                            </button>
                            <button 
                                type="submit" 
                                class="px-4 py-2 bg-amber-600 hover:bg-amber-500 text-white text-xs font-semibold rounded-lg shadow-sm transition"
                            >
                                {{ $categoryId ? 'Simpan Perubahan' : 'Tambah Kategori' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>