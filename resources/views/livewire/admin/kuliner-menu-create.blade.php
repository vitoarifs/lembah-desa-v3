<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-gray-800 leading-tight">Tambah Menu Kuliner</h2>
                <p class="text-xs text-gray-500 mt-1">Input data hidangan baru lengkap dengan foto dan rincian paket</p>
            </div>
            <a href="{{ route('admin.kuliner.menu.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold rounded-lg transition">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
            <form wire:submit.prevent="store" class="space-y-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
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

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Harga (Rp)</label>
                        <input type="number" wire:model="harga" class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg text-xs text-gray-900 focus:ring-2 focus:ring-amber-500" placeholder="35000">
                        @error('harga') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Nama Menu</label>
                        <input type="text" wire:model.live="nama" class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg text-xs text-gray-900 focus:ring-2 focus:ring-amber-500" placeholder="Sego Megono Tampah">
                        @error('nama') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Slug URL</label>
                        <input type="text" wire:model="slug" class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg text-xs text-gray-600 font-mono" readonly>
                        @error('slug') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Foto Menu</label>
                    <input type="file" wire:model="foto" accept="image/*" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100">
                    @error('foto') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror

                    @if ($foto)
                        <div class="mt-2">
                            <span class="text-[10px] text-gray-400 block mb-1">Pratinjau:</span>
                            <img src="{{ $foto->temporaryUrl() }}" class="w-24 h-24 object-cover rounded-lg border border-gray-300">
                        </div>
                    @endif
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Deskripsi</label>
                    <textarea wire:model="deskripsi" rows="3" class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg text-xs text-gray-900 focus:ring-2 focus:ring-amber-500" placeholder="Deskripsikan kelezatan menu..."></textarea>
                    @error('deskripsi') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="border-t border-gray-100 pt-3">
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider">Isi Paket / Komponen (Opsional)</label>
                        <button type="button" wire:click="addIsiPaket" class="text-xs text-amber-600 font-semibold hover:underline">+ Tambah Item</button>
                    </div>
                    <div class="space-y-2">
                        @foreach ($isi_paket as $index => $item)
                            <div class="flex items-center gap-2">
                                <input type="text" wire:model="isi_paket.{{ $index }}" class="w-full px-3 py-1.5 bg-white border border-gray-300 rounded-lg text-xs text-gray-900" placeholder="Contoh: Nasi Liwet / Sambal">
                                @if (count($isi_paket) > 1)
                                    <button type="button" wire:click="removeIsiPaket({{ $index }})" class="p-1.5 text-rose-600 hover:bg-rose-50 rounded-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-2">
                    <a href="{{ route('admin.kuliner.menu.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-medium rounded-lg transition">Batal</a>
                    <button type="submit" class="px-4 py-2 bg-amber-600 hover:bg-amber-500 text-white text-xs font-semibold rounded-lg shadow-sm transition">Simpan Menu</button>
                </div>
            </form>
        </div>
    </div>
</div>