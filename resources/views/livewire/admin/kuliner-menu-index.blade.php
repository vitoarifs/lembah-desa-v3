<div>
    <!-- Slot Header Admin -->
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-bold text-gray-800 leading-tight">Kelola Menu Kuliner</h2>
                <p class="text-xs text-gray-500 mt-1">Daftar hidangan, harga, dan foto menu Lembah Desa</p>
            </div>
            <button 
                wire:click="openModal" 
                class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-amber-600 hover:bg-amber-500 text-white text-xs font-semibold rounded-lg shadow-sm transition"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Tambah Menu Baru</span>
            </button>
        </div>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-6">

        <!-- Notifikasi -->
        @if (session()->has('message'))
            <div class="p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-r-lg flex items-center justify-between">
                <span class="text-xs sm:text-sm font-medium text-emerald-800">{{ session('message') }}</span>
            </div>
        @endif

        <!-- Filter & Table Card -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
            <!-- Search & Filter Bar -->
            <div class="p-4 border-b border-gray-200 bg-gray-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div class="flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto">
                    <!-- Search Input -->
                    <div class="relative w-full sm:w-64">
                        <input 
                            type="text" 
                            wire:model.live.debounce.300ms="search" 
                            placeholder="Cari nama menu..." 
                            class="w-full pl-9 pr-4 py-2 bg-white border border-gray-300 rounded-lg text-xs text-gray-800 focus:ring-2 focus:ring-amber-500 focus:border-amber-500"
                        >
                        <svg class="w-4 h-4 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>

                    <!-- Category Filter Dropdown -->
                    <select 
                        wire:model.live="categoryFilter" 
                        class="w-full sm:w-48 py-2 px-3 bg-white border border-gray-300 rounded-lg text-xs text-gray-800 focus:ring-2 focus:ring-amber-500 focus:border-amber-500"
                    >
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Table Menu -->
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-gray-600">
                    <thead class="bg-gray-100 text-gray-700 font-semibold uppercase tracking-wider border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3.5">Foto</th>
                            <th class="px-6 py-3.5">Nama Menu</th>
                            <th class="px-6 py-3.5">Kategori</th>
                            <th class="px-6 py-3.5">Harga</th>
                            <th class="px-6 py-3.5">Isi Paket</th>
                            <th class="px-6 py-3.5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($menus as $menu)
                            <tr class="hover:bg-gray-50/80 transition">
                                <td class="px-6 py-3">
                                    @if ($menu->foto)
                                        <img src="{{ asset('storage/' . $menu->foto) }}" alt="{{ $menu->nama }}" class="w-12 h-12 object-cover rounded-lg border border-gray-200">
                                    @else
                                        <div class="w-12 h-12 bg-gray-100 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 text-[10px]">No Photo</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900">
                                    <div>{{ $menu->nama }}</div>
                                    <div class="text-[10px] text-gray-400 font-normal font-mono">{{ $menu->slug }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-stone-100 text-stone-800 border border-stone-200">
                                        {{ $menu->category->nama }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 font-bold text-amber-600">
                                    {{ $menu->formatted_harga }}
                                </td>
                                <td class="px-6 py-4">
                                    @if (!empty($menu->isi_paket))
                                        <span class="text-[11px] text-gray-500 font-medium">{{ count($menu->isi_paket) }} Item Komponen</span>
                                    @else
                                        <span class="text-[11px] text-gray-400 font-light">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <button wire:click="edit({{ $menu->id }})" class="text-indigo-600 hover:text-indigo-900 font-medium transition">Edit</button>
                                    <button 
                                        onclick="confirm('Yakin ingin menghapus menu ini?') || event.stopImmediatePropagation()" 
                                        wire:click="delete({{ $menu->id }})" 
                                        class="text-rose-600 hover:text-rose-900 font-medium transition"
                                    >Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-400">Belum ada data menu kuliner.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-4 border-t border-gray-200">
                {{ $menus->links() }}
            </div>
        </div>
    </div>

    <!-- Modal Form Create / Edit -->
    @if ($isModalOpen)
        <div class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                <div class="fixed inset-0 bg-gray-900/60 transition-opacity" wire:click="closeModal"></div>

                <div class="relative inline-block w-full max-w-2xl p-6 overflow-hidden text-left align-middle bg-white rounded-2xl shadow-xl transform transition-all z-10 my-8">
                    <h3 class="text-lg font-bold leading-6 text-gray-900 border-b border-gray-100 pb-3">
                        {{ $menuId ? 'Edit Menu Kuliner' : 'Tambah Menu Kuliner Baru' }}
                    </h3>

                    <form wire:submit.prevent="save" class="mt-4 space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Kategori -->
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Kategori Menu</label>
                                <select wire:model="category_id" class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg text-xs text-gray-900 focus:ring-2 focus:ring-amber-500">
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->nama }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <!-- Harga -->
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Harga (Rp)</label>
                                <input type="number" wire:model="harga" class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg text-xs text-gray-900 focus:ring-2 focus:ring-amber-500" placeholder="Contoh: 35000">
                                @error('harga') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Nama Menu -->
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Nama Menu</label>
                                <input type="text" wire:model.live="nama" class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg text-xs text-gray-900 focus:ring-2 focus:ring-amber-500" placeholder="Contoh: Ayam Bakar Madu">
                                @error('nama') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <!-- Slug URL -->
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Slug URL</label>
                                <input type="text" wire:model="slug" class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg text-xs text-gray-600 font-mono" readonly>
                                @error('slug') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Upload Foto Menu & Pratinjau -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Foto Menu (Rasio 4:3 / 1:1)</label>
                            <input type="file" wire:model="foto" accept="image/*" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100">
                            @error('foto') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror

                            <!-- Preview Upload -->
                            <div class="mt-2 flex items-center gap-4">
                                @if ($foto)
                                    <div>
                                        <span class="text-[10px] text-gray-400 block mb-1">Pratinjau Foto Baru:</span>
                                        <img src="{{ $foto->temporaryUrl() }}" class="w-20 h-20 object-cover rounded-lg border border-gray-300">
                                    </div>
                                @elseif ($existingFoto)
                                    <div>
                                        <span class="text-[10px] text-gray-400 block mb-1">Foto Saat Ini:</span>
                                        <img src="{{ asset('storage/' . $existingFoto) }}" class="w-20 h-20 object-cover rounded-lg border border-gray-300">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Deskripsi Ringkas</label>
                            <textarea wire:model="deskripsi" rows="3" class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg text-xs text-gray-900 focus:ring-2 focus:ring-amber-500" placeholder="Jelaskan cita rasa dan keunggulan menu ini..."></textarea>
                            @error('deskripsi') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Input Dinamis: Isi Paket -->
                        <div class="border-t border-gray-100 pt-3">
                            <div class="flex items-center justify-between mb-2">
                                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider">Komponen / Isi Paket (Opsional)</label>
                                <button type="button" wire:click="addIsiPaket" class="text-xs text-amber-600 font-semibold hover:underline">+ Tambah Item</button>
                            </div>
                            
                            <div class="space-y-2 max-h-36 overflow-y-auto p-1">
                                @foreach ($isi_paket as $index => $item)
                                    <div class="flex items-center gap-2">
                                        <input type="text" wire:model="isi_paket.{{ $index }}" class="w-full px-3 py-1.5 bg-white border border-gray-300 rounded-lg text-xs text-gray-900 focus:ring-2 focus:ring-amber-500" placeholder="Contoh: Nasi Putih / Sambal Terasi">
                                        @if (count($isi_paket) > 1)
                                            <button type="button" wire:click="removeIsiPaket({{ $index }})" class="p-1.5 text-rose-600 hover:bg-rose-50 rounded-lg">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                            </button>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Footer Actions -->
                        <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-2">
                            <button type="button" wire:click="closeModal" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-medium rounded-lg transition">Batal</button>
                            <button type="submit" class="px-4 py-2 bg-amber-600 hover:bg-amber-500 text-white text-xs font-semibold rounded-lg shadow-sm transition">
                                {{ $menuId ? 'Simpan Perubahan' : 'Tambah Menu' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>