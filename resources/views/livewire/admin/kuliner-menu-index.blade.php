<div class="p-4 sm:p-6 bg-stone-950 min-h-screen text-stone-100 font-sans space-y-6">

    <!-- Flash Message Notification -->
    @if (session()->has('message'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => show = false, 3000)"
            x-transition
            class="bg-emerald-950/80 border border-emerald-600/50 text-emerald-200 px-4 py-3 rounded-xl flex items-center justify-between text-sm"
        >
            <span>{{ session('message') }}</span>

            <button
                @click="show = false"
                class="text-emerald-400 hover:text-emerald-200"
            >
                &times;
            </button>
        </div>
    @endif


    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-stone-800 pb-5">

        <div>
            <span class="text-amber-500 font-medium text-xs tracking-widest uppercase">
                Panel Admin
            </span>

            <h1 class="text-2xl sm:text-3xl font-serif font-bold text-stone-100 mt-1">
                Kelola Menu Kuliner
            </h1>

            <p class="text-xs sm:text-sm text-stone-400 mt-1">
                Atur daftar hidangan, harga, kategori, dan foto menu Lembah Desa
            </p>
        </div>

        <button
            wire:click="openModal"
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

            <span>Tambah Menu Baru</span>
        </button>

    </div>


    <!-- Search & Filter -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">

        <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">

            <!-- Search -->
            <div class="relative w-full max-w-xs">

                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Cari nama menu..."
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


            <!-- Category Filter -->
            <select
                wire:model.live="categoryFilter"
                class="w-full sm:w-52 bg-stone-900 border border-stone-800 text-stone-200 text-xs sm:text-sm rounded-xl px-3 py-2.5 focus:outline-none focus:border-amber-500 transition-colors"
            >
                <option value="">Semua Kategori</option>

                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}">
                        {{ $cat->nama }}
                    </option>
                @endforeach
            </select>

        </div>

    </div>


    <!-- Table Container -->
    <div class="bg-stone-900 border border-stone-800 rounded-2xl overflow-hidden shadow-xl">

        <div class="overflow-x-auto">

            <table class="w-full text-left border-collapse">

                <!-- Table Header -->
                <thead>
                    <tr class="bg-stone-950/60 border-b border-stone-800 text-stone-400 text-xs uppercase tracking-wider">

                        <th class="py-4 px-6 w-20">
                            Foto
                        </th>

                        <th class="py-4 px-6">
                            Nama Menu
                        </th>

                        <th class="py-4 px-6">
                            Kategori
                        </th>

                        <th class="py-4 px-6">
                            Harga
                        </th>

                        <th class="py-4 px-6">
                            Isi Paket
                        </th>

                        <th class="py-4 px-6 text-right">
                            Aksi
                        </th>

                    </tr>
                </thead>


                <!-- Skeleton Loading Body -->
                <tbody wire:loading.delay wire:target="search, categoryFilter, gotoPage, previousPage, nextPage" class="divide-y divide-stone-800/60 text-xs sm:text-sm">
                    @for ($i = 0; $i < 5; $i++)
                        <tr class="animate-pulse">
                            <td class="py-4 px-6"><div class="w-12 h-12 bg-stone-800/60 rounded-xl"></div></td>
                            <td class="py-4 px-6"><div class="h-4 w-36 bg-stone-800/60 rounded"></div></td>
                            <td class="py-4 px-6"><div class="h-4 w-24 bg-stone-800/60 rounded"></div></td>
                            <td class="py-4 px-6"><div class="h-4 w-20 bg-stone-800/60 rounded"></div></td>
                            <td class="py-4 px-6"><div class="h-4 w-28 bg-stone-800/60 rounded"></div></td>
                            <td class="py-4 px-6 text-right"><div class="h-8 w-20 bg-stone-800/60 rounded-xl ml-auto"></div></td>
                        </tr>
                    @endfor
                </tbody>

                <!-- Real Table Body -->
                <tbody wire:loading.remove.delay wire:target="search, categoryFilter, gotoPage, previousPage, nextPage" class="divide-y divide-stone-800/60 text-xs sm:text-sm">

                    @forelse ($menus as $menu)

                        <tr class="hover:bg-stone-800/30 transition-colors">

                            <!-- Foto -->
                            <td class="py-4 px-6">

                                @if ($menu->foto)

                                    <img
                                        src="{{ asset('storage/' . $menu->foto) }}"
                                        alt="{{ $menu->nama }}"
                                        class="w-12 h-12 object-cover rounded-xl border border-stone-800"
                                    >

                                @else

                                    <div class="w-12 h-12 bg-stone-950 rounded-xl border border-dashed border-stone-800 flex items-center justify-center text-stone-600">

                                        <svg
                                            class="w-5 h-5"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                            />
                                        </svg>

                                    </div>

                                @endif

                            </td>


                            <!-- Nama Menu -->
                            <td class="py-4 px-6">

                                <p class="font-bold text-stone-100 max-w-xs sm:max-w-sm">
                                    {{ $menu->nama }}
                                </p>

                                <p class="text-stone-500 text-[11px] font-mono mt-0.5">
                                    {{ $menu->slug }}
                                </p>

                            </td>


                            <!-- Kategori -->
                            <td class="py-4 px-6">

                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-stone-950 border border-stone-700 text-stone-300">
                                    {{ $menu->category->nama }}
                                </span>

                            </td>


                            <!-- Harga -->
                            <td class="py-4 px-6 text-stone-300 font-medium whitespace-nowrap">

                                <span class="text-amber-500/90 font-semibold">
                                    {{ $menu->formatted_harga }}
                                </span>

                            </td>


                            <!-- Isi Paket -->
                            <td class="py-4 px-6">

                                @if (!empty($menu->isi_paket))

                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-950/60 border border-amber-800/50 text-amber-400">

                                        <svg
                                            class="w-3.5 h-3.5"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
                                            />
                                        </svg>

                                        {{ count($menu->isi_paket) }} Item

                                    </span>

                                @else

                                    <span class="text-stone-600">
                                        -
                                    </span>

                                @endif

                            </td>


                            <!-- Actions -->
                            <td class="py-4 px-6 text-right">

                                <div class="flex items-center justify-end gap-2">

                                    <!-- Edit -->
                                    <button
                                        wire:click="edit({{ $menu->id }})"
                                        class="p-2 rounded-lg bg-stone-800 hover:bg-stone-700 text-amber-500 transition-colors"
                                        title="Edit Menu"
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


                                    <!-- Delete -->
                                    <button
                                        onclick="confirm('Yakin ingin menghapus menu ini?') || event.stopImmediatePropagation()"
                                        wire:click="delete({{ $menu->id }})"
                                        class="p-2 rounded-lg bg-stone-800 hover:bg-rose-950 hover:text-rose-400 text-stone-400 transition-colors"
                                        title="Hapus Menu"
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
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 01-1 1v3M4 7h16"
                                            />
                                        </svg>
                                    </button>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="py-12 text-center text-stone-500 text-sm"
                            >
                                Belum ada data menu kuliner.
                                Klik tombol
                                <strong>Tambah Menu Baru</strong>
                                untuk menambahkan.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <!-- Pagination -->
        @if ($menus->hasPages())

            <div class="px-6 py-4 border-t border-stone-800 bg-stone-950/40">

                {{ $menus->links() }}

            </div>

        @endif

    </div>


    <!-- Form Modal -->
    @if ($isModalOpen)

        <div
            class="fixed inset-0 z-50 overflow-y-auto bg-stone-950/80 backdrop-blur-sm"
        >

            <div class="flex min-h-full items-center justify-center p-4 sm:p-6">

                <div class="bg-stone-900 border border-stone-800 rounded-2xl max-w-2xl w-full p-5 sm:p-8 space-y-5 shadow-2xl relative my-auto">

                    <!-- Modal Header -->
                    <div class="flex items-center justify-between border-b border-stone-800 pb-4">

                        <div>

                            <h3 class="text-base sm:text-lg font-serif font-bold text-stone-100">
                                {{ $menuId ? 'Edit Menu Kuliner' : 'Tambah Menu Baru' }}
                            </h3>

                            <p class="text-xs text-stone-400 mt-0.5">
                                Lengkapi informasi menu sebelum menyimpannya.
                            </p>

                        </div>

                        <button
                            wire:click="closeModal"
                            class="text-stone-400 hover:text-stone-200 text-2xl font-bold leading-none"
                        >
                            &times;
                        </button>

                    </div>


                    <!-- Form -->
                    <form
                        wire:submit.prevent="save"
                        class="space-y-4 text-xs sm:text-sm"
                    >

                        <!-- Kategori & Harga -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">

                            <!-- Kategori -->
                            <div>

                                <label class="block text-stone-300 font-medium mb-1">
                                    Kategori Menu
                                </label>

                                <select
                                    wire:model="category_id"
                                    class="w-full bg-stone-950 border border-stone-800 rounded-xl px-3 py-2.5 text-stone-100 focus:outline-none focus:border-amber-500"
                                >
                                    <option value="">
                                        -- Pilih Kategori --
                                    </option>

                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}">
                                            {{ $cat->nama }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('category_id')
                                    <span class="text-rose-500 text-xs mt-1 block">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            <!-- Harga -->
                            <div>

                                <label class="block text-stone-300 font-medium mb-1">
                                    Harga (Rp)
                                </label>

                                <div class="relative">

                                    <span class="absolute left-3 top-2.5 text-stone-500">
                                        Rp
                                    </span>

                                    <input
                                        type="number"
                                        wire:model="harga"
                                        class="w-full bg-stone-950 border border-stone-800 rounded-xl pl-9 pr-4 py-2.5 text-stone-100 focus:outline-none focus:border-amber-500"
                                        placeholder="35000"
                                    >

                                </div>

                                @error('harga')
                                    <span class="text-rose-500 text-xs mt-1 block">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>

                        </div>


                        <!-- Nama & Slug -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">

                            <div>

                                <label class="block text-stone-300 font-medium mb-1">
                                    Nama Menu
                                </label>

                                <input
                                    type="text"
                                    wire:model.live="nama"
                                    class="w-full bg-stone-950 border border-stone-800 rounded-xl px-4 py-2.5 text-stone-100 focus:outline-none focus:border-amber-500"
                                    placeholder="Contoh: Ayam Bakar Madu"
                                >

                                @error('nama')
                                    <span class="text-rose-500 text-xs mt-1 block">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            <div>

                                <label class="block text-stone-300 font-medium mb-1">
                                    Slug URL
                                </label>

                                <input
                                    type="text"
                                    wire:model="slug"
                                    readonly
                                    class="w-full bg-stone-950 border border-stone-800 rounded-xl px-4 py-2.5 text-stone-500 font-mono cursor-not-allowed"
                                    placeholder="otomatis-terisi"
                                >

                                @error('slug')
                                    <span class="text-rose-500 text-xs mt-1 block">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>

                        </div>


                        <!-- Foto -->
                        <div>

                            <label class="block text-stone-300 font-medium mb-1">
                                Foto Menu
                            </label>

                            <div class="flex items-start gap-4">

                                <div class="flex-1">

                                    <input
                                        type="file"
                                        wire:model="foto"
                                        accept="image/*"
                                        class="w-full text-xs text-stone-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-stone-800 file:text-amber-400 hover:file:bg-stone-700 cursor-pointer border border-stone-800 rounded-xl bg-stone-950 p-1"
                                    >

                                    <p class="text-[10px] text-stone-500 mt-1">
                                        JPG, PNG, WEBP — maksimal 2MB
                                    </p>

                                    @error('foto')
                                        <span class="text-rose-500 text-xs mt-1 block">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>


                                <!-- Preview -->
                                <div class="shrink-0">

                                    @if ($foto)

                                        <div class="relative">

                                            <img
                                                src="{{ $foto->temporaryUrl() }}"
                                                class="w-16 h-16 object-cover rounded-xl border border-stone-700"
                                            >

                                            <span class="absolute -top-2 -right-2 bg-amber-500 text-stone-950 text-[9px] px-1.5 py-0.5 rounded-full font-bold">
                                                Baru
                                            </span>

                                        </div>

                                    @elseif ($existingFoto)

                                        <div class="relative">

                                            <img
                                                src="{{ asset('storage/' . $existingFoto) }}"
                                                class="w-16 h-16 object-cover rounded-xl border border-stone-700"
                                            >

                                            <span class="absolute -top-2 -right-2 bg-stone-700 text-stone-200 text-[9px] px-1.5 py-0.5 rounded-full font-bold">
                                                Saat ini
                                            </span>

                                        </div>

                                    @endif

                                </div>

                            </div>

                        </div>


                        <!-- Deskripsi -->
                        <div>

                            <label class="block text-stone-300 font-medium mb-1">
                                Deskripsi Ringkas
                            </label>

                            <textarea
                                wire:model="deskripsi"
                                rows="3"
                                class="w-full bg-stone-950 border border-stone-800 rounded-xl p-3 sm:p-4 text-stone-100 focus:outline-none focus:border-amber-500 resize-none"
                                placeholder="Jelaskan cita rasa dan keunggulan menu ini..."
                            ></textarea>

                            @error('deskripsi')
                                <span class="text-rose-500 text-xs mt-1 block">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>


                        <!-- Isi Paket -->
                        <div class="border-t border-stone-800 pt-4">

                            <div class="flex items-center justify-between mb-2">

                                <label class="block text-stone-300 font-medium">
                                    Komponen / Isi Paket
                                </label>

                                <button
                                    type="button"
                                    wire:click="addIsiPaket"
                                    class="inline-flex items-center gap-1 text-xs text-amber-400 font-semibold hover:text-amber-300 transition"
                                >
                                    <svg
                                        class="w-3.5 h-3.5"
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

                                    <span>Tambah Item</span>
                                </button>

                            </div>


                            <div class="space-y-2 max-h-40 overflow-y-auto pr-1">

                                @foreach ($isi_paket as $index => $item)

                                    <div class="flex items-center gap-2">

                                        <input
                                            type="text"
                                            wire:model="isi_paket.{{ $index }}"
                                            class="w-full bg-stone-950 border border-stone-800 rounded-xl px-3 py-2.5 text-stone-100 placeholder-stone-600 focus:outline-none focus:border-amber-500"
                                            placeholder="Contoh: Nasi Putih / Sambal Terasi"
                                        >

                                        @if (count($isi_paket) > 1)

                                            <button
                                                type="button"
                                                wire:click="removeIsiPaket({{ $index }})"
                                                class="p-2 text-stone-500 hover:text-rose-400 hover:bg-rose-950/50 rounded-lg transition shrink-0"
                                                title="Hapus Baris"
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

                                        @endif

                                    </div>

                                @endforeach

                            </div>

                        </div>


                        <!-- Actions -->
                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-stone-800">

                            <button
                                type="button"
                                wire:click="closeModal"
                                class="px-4 py-2.5 rounded-xl border border-stone-700 text-stone-300 hover:bg-stone-800 transition-colors"
                            >
                                Batal
                            </button>

                            <button
                                type="submit"
                                wire:loading.attr="disabled"
                                class="px-5 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-500 disabled:opacity-50 disabled:cursor-not-allowed text-stone-950 font-semibold transition-colors flex items-center gap-2"
                            >
                                <span wire:loading.remove>
                                    {{ $menuId ? 'Simpan Perubahan' : 'Tambah Menu' }}
                                </span>

                                <span wire:loading>
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