<section class="bg-stone-950 text-stone-100 font-sans min-h-screen py-12 lg:py-20 px-4 sm:px-6 lg:px-8">

    <div class="max-w-7xl mx-auto">

        <!-- Grid Utama -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">

            <!-- KOLOM KIRI -->
            <div class="lg:col-span-5 flex flex-col space-y-8">

                <!-- Header Halaman -->
                <div>

                    <span class="text-amber-500 font-semibold text-xs lg:text-[13px] tracking-widest uppercase">
                        Hubungi Kami
                    </span>

                    <h1 class="font-serif text-3xl sm:text-4xl lg:text-[40px] font-bold text-stone-100 mt-1.5 leading-tight">
                        Mari Terhubung di Lembah Desa
                    </h1>

                    <p class="text-stone-400 text-sm sm:text-[15px] lg:text-base mt-3 leading-relaxed">
                        Punya pertanyaan seputar lokasi atau ingin memesan tempat untuk rombongan?
                        Pilih jalur komunikasi yang paling nyaman bagi Anda.
                    </p>

                </div>


                <!-- Form Reservasi WhatsApp -->
                <div class="bg-stone-900 border border-stone-800 p-5 sm:p-6 rounded-2xl shadow-lg">

                    <!-- Header Card -->
                    <div class="flex items-center gap-3 mb-5">

                        <div class="w-8 h-8 rounded-lg bg-emerald-500/10 text-emerald-500 flex items-center justify-center font-bold text-sm">
                            WA
                        </div>

                        <div>

                            <h2 class="font-serif text-xl sm:text-[21px] lg:text-[22px] font-bold text-stone-100 leading-tight">
                                Reservasi Cepat WhatsApp
                            </h2>

                            <p class="text-stone-400 text-xs lg:text-[13px] mt-0.5">
                                Respon langsung dari tim layanan pelanggan
                            </p>

                        </div>

                    </div>


                    <form wire:submit.prevent="sendWa" class="space-y-4">

                        <!-- Nama -->
                        <div>

                            <label
                                for="wa-nama"
                                class="block text-xs lg:text-[13px] font-medium text-stone-300 mb-1.5"
                            >
                                Nama Klien
                            </label>

                            <input
                                type="text"
                                id="wa-nama"
                                wire:model="waForm.nama"
                                class="w-full bg-stone-950 border border-stone-800 rounded-lg px-3.5 py-2.5 text-stone-100 text-sm focus:outline-none focus:border-amber-500 transition-colors"
                                placeholder="Masukkan nama kamu"
                            >

                            @error('waForm.nama')
                                <span class="text-rose-500 text-xs mt-1 block">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>


                        <!-- Tanggal & Jumlah Tamu -->
                        <div class="grid grid-cols-2 gap-3">

                            <div>

                                <label
                                    for="wa-tanggal"
                                    class="block text-xs lg:text-[13px] font-medium text-stone-300 mb-1.5"
                                >
                                    Tanggal Kunjungan
                                </label>

                                <input
                                    type="date"
                                    id="wa-tanggal"
                                    wire:model="waForm.tanggal"
                                    min="{{ now()->format('Y-m-d') }}"
                                    class="w-full bg-stone-950 border border-stone-800 rounded-lg px-3.5 py-2.5 text-stone-100 text-sm focus:outline-none focus:border-amber-500 transition-colors"
                                >

                                @error('waForm.tanggal')
                                    <span class="text-rose-500 text-xs mt-1 block">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            <div>

                                <label
                                    for="wa-tamu"
                                    class="block text-xs lg:text-[13px] font-medium text-stone-300 mb-1.5"
                                >
                                    Jumlah Tamu
                                </label>

                                <input
                                    type="number"
                                    id="wa-tamu"
                                    min="1"
                                    wire:model="waForm.tamu"
                                    class="w-full bg-stone-950 border border-stone-800 rounded-lg px-3.5 py-2.5 text-stone-100 text-sm focus:outline-none focus:border-amber-500 transition-colors"
                                    placeholder="Contoh: 1"
                                >

                                @error('waForm.tamu')
                                    <span class="text-rose-500 text-xs mt-1 block">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>

                        </div>


                        <!-- Tombol WhatsApp -->
                        <button
                            type="submit"
                            wire:loading.attr="disabled"
                            wire:target="sendWa"
                            class="w-full mt-2 bg-emerald-600 hover:bg-emerald-500 text-white font-medium py-3 px-4 rounded-xl text-sm transition-all duration-200 shadow-lg active:scale-95 disabled:opacity-50"
                        >

                            <span wire:loading.remove wire:target="sendWa">
                                Kirim via WhatsApp
                            </span>

                            <span wire:loading wire:target="sendWa">
                                Memvalidasi & Membuka WA...
                            </span>

                        </button>

                    </form>

                </div>


                <!-- Card Lokasi -->
                <div
                    x-data="{ showMap: false }"
                    class="bg-stone-900 border border-stone-800 p-5 sm:p-6 rounded-2xl relative overflow-hidden min-h-[220px] flex flex-col justify-between"
                >

                    <div
                        x-show="!showMap"
                        class="space-y-3"
                    >

                        <div class="flex items-center gap-2 text-amber-500 text-xs lg:text-[13px] font-semibold uppercase tracking-wider">

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
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                />
                            </svg>

                            <span>Lokasi Kami</span>

                        </div>


                        <h2 class="font-serif text-xl sm:text-[21px] lg:text-[22px] font-bold text-stone-100 leading-tight">
                            Lembah Desa Resto & Wisata
                        </h2>


                        <p class="text-stone-400 text-sm lg:text-[15px] leading-relaxed">
                            Jl. Raya Pedesaan No. 88, Kawasan Lembah Asri,
                            Kabupaten Sleman, D.I. Yogyakarta 55581
                        </p>


                        <button
                            @click="showMap = true"
                            class="mt-2 inline-flex items-center gap-2 bg-stone-800 hover:bg-stone-700 text-stone-200 border border-stone-700 px-4 py-2 rounded-lg text-xs lg:text-[13px] font-medium transition-colors"
                        >

                            <span>Lihat Peta Interaktif</span>

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
                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"
                                />
                            </svg>

                        </button>

                    </div>


                    <!-- Google Maps -->
                    <template x-if="showMap">

                        <div class="absolute inset-0 w-full h-full bg-stone-950">

                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.3931979317726!2d110.56114919999999!3d-7.9582553!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7bb3af12033a93%3A0x7e81e2f975cb054c!2sPulutan%20Village%20Valley!5e0!3m2!1sen!2sid!4v1789134892883!5m2!1sen!2sid" 
                            width="600" 
                            height="450" 
                            style="border:0;" 
                            allowfullscreen 
                            loading="lazy" 
                            referrerpolicy="strict-origin-when-cross-origin">
                            </iframe>

                        </div>

                    </template>

                </div>

            </div>


            <!-- KOLOM KANAN -->
            <div class="lg:col-span-7 bg-stone-900 border border-stone-800 p-5 sm:p-8 rounded-2xl flex flex-col justify-between h-full">

                <div>

                    <!-- Header Form -->
                    <div class="mb-6">

                        <h2 class="font-serif text-xl sm:text-[21px] lg:text-[22px] font-bold text-stone-100 leading-tight">
                            Kirim Pesan Resmi
                        </h2>

                        <p class="text-stone-400 text-sm lg:text-[15px] mt-1.5 leading-relaxed">
                            Untuk kerja sama, saran, atau pertanyaan khusus lainnya.
                        </p>

                    </div>


                    <!-- Success Message -->
                    @if (session()->has('success'))

                        <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-xl text-sm">
                            {{ session('success') }}
                        </div>

                    @endif


                    <form wire:submit="sendEmail" class="space-y-5">

                        <!-- Nama Lengkap -->
                        <div>

                            <label
                                for="email-nama"
                                class="block text-xs lg:text-[13px] font-medium text-stone-300 mb-1.5"
                            >
                                Nama Lengkap
                            </label>

                            <input
                                type="text"
                                id="email-nama"
                                wire:model="emailForm.nama"
                                class="w-full bg-stone-950 border @error('emailForm.nama') border-rose-500/80 @else border-stone-800 focus:border-amber-500 @enderror rounded-lg px-4 py-3 text-stone-100 text-sm focus:outline-none transition-colors"
                                placeholder="Masukkan nama lengkap"
                            >

                            @error('emailForm.nama')
                                <span class="text-rose-500 text-xs mt-1 block">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>


                        <!-- Alamat Email -->
                        <div>

                            <label
                                for="email-address"
                                class="block text-xs lg:text-[13px] font-medium text-stone-300 mb-1.5"
                            >
                                Alamat Email
                            </label>

                            <input
                                type="email"
                                id="email-address"
                                wire:model="emailForm.address"
                                class="w-full bg-stone-950 border @error('emailForm.address') border-rose-500/80 @else border-stone-800 focus:border-amber-500 @enderror rounded-lg px-4 py-3 text-stone-100 text-sm focus:outline-none transition-colors"
                                placeholder="nama@email.com"
                            >

                            @error('emailForm.address')
                                <span class="text-rose-500 text-xs mt-1 block">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>


                        <!-- Pesan -->
                        <div>

                            <label
                                for="email-pesan"
                                class="block text-xs lg:text-[13px] font-medium text-stone-300 mb-1.5"
                            >
                                Pesan
                            </label>

                            <textarea
                                id="email-pesan"
                                wire:model="emailForm.pesan"
                                rows="5"
                                class="w-full bg-stone-950 border @error('emailForm.pesan') border-rose-500/80 @else border-stone-800 focus:border-amber-500 @enderror rounded-lg px-4 py-3 text-stone-100 text-sm focus:outline-none transition-colors resize-none"
                                placeholder="Tuliskan pesan detail Anda di sini..."
                            ></textarea>

                            @error('emailForm.pesan')
                                <span class="text-rose-500 text-xs mt-1 block">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>


                        <!-- Tombol Submit -->
                        <button
                            type="submit"
                            wire:loading.attr="disabled"
                            wire:target="sendEmail"
                            class="w-full bg-amber-600 hover:bg-amber-500 text-white font-medium py-3.5 px-6 rounded-xl text-sm transition-all duration-200 shadow-lg shadow-amber-950/40 active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed"
                        >

                            <span wire:loading.remove wire:target="sendEmail">
                                Kirim Pesan Email
                            </span>

                            <span wire:loading wire:target="sendEmail">
                                Mengirim Pesan...
                            </span>

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>


    <!-- Redirect WhatsApp -->
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('redirect-to-whatsapp', ({ url }) => {
                window.location.href = url;
            });
        });
    </script>

</section>