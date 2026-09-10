<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-gray-800 leading-tight">Edit Kategori: {{ $category->nama }}</h2>
                <p class="text-xs text-gray-500 mt-1">Ubah data nama atau slug kategori</p>
            </div>
            <a href="{{ route('admin.kuliner.kategori.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold rounded-lg transition">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
            <form wire:submit.prevent="update" class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Nama Kategori</label>
                    <input type="text" wire:model.live="nama" class="w-full px-3 py-2 bg-white border border-gray-300 rounded-lg text-xs text-gray-900 focus:ring-2 focus:ring-amber-500">
                    @error('nama') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Slug URL</label>
                    <input type="text" wire:model="slug" class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg text-xs text-gray-600 font-mono" readonly>
                    @error('slug') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-2">
                    <a href="{{ route('admin.kuliner.kategori.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-medium rounded-lg transition">Batal</a>
                    <button type="submit" class="px-4 py-2 bg-amber-600 hover:bg-amber-500 text-white text-xs font-semibold rounded-lg shadow-sm transition">Perbarui Kategori</button>
                </div>
            </form>
        </div>
    </div>
</div>