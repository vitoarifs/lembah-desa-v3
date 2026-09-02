<div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- KOLOM FORM (CREATE / UPDATE) -->
        <div class="md:col-span-1 border-r pr-6 border-gray-200 dark:border-gray-700">
            <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">{{ $isEditMode ? 'Edit Artikel' : 'Tambah Artikel' }}</h2>
            
            @if (session()->has('message'))
                <div class="mb-4 text-sm text-green-600 bg-green-100 p-2 rounded">{{ session('message') }}</div>
            @endif
            
            @if (session()->has('error'))
                <div class="mb-4 text-sm text-red-600 bg-red-100 dark:bg-gray-600 p-2 rounded">{{ session('error') }}</div>
            @endif

            <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Judul</label>
                    <input type="text" wire:model="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-white">
                    @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Konten</label>
                    <textarea wire:model="content" rows="6" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-white"></textarea>
                    @error('content') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="flex justify-end gap-2">
                    @if($isEditMode)
                        <button type="button" wire:click="resetInput" class="px-4 py-2 bg-gray-500 text-white rounded text-sm">Batal</button>
                    @endif
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded text-sm hover:bg-indigo-700">Simpan</button>
                </div>
            </form>
        </div>

        <!-- KOLOM DAFTAR TABEL (READ / DELETE) -->
        <div class="md:col-span-2">
            <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Daftar Artikel Manajemen</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm text-left">
                    <thead class="bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                        <tr>
                            <th class="px-4 py-3">Judul</th>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-gray-900 dark:text-gray-100">
                        @foreach($articles as $article)
                            <tr>
                                <td class="px-4 py-3 font-medium">{{ $article->title }}</td>
                                <td class="px-4 py-3 text-gray-500">{{ $article->created_at->format('d/m/Y') }}</td>
                                <td class="px-4 py-3 text-right space-x-2">
                                    @can('update', $article)
                                        <button wire:click="edit({{ $article->id }})" class="text-blue-600 hover:underline">Edit</button>
                                    @endcan
                                    
                                    @can('delete', $article)
                                        <button wire:click="delete({{ $article->id }})" wire:confirm="Yakin ingin menghapus?" class="text-red-600 hover:underline">Hapus</button>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
