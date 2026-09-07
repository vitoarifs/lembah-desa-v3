<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Pesan Masuk</title>
    <!-- Pastikan Tailwind CSS sudah terhubung -->
    @vite('resources/css/app.css')
</head>
<body class="bg-stone-950 p-4 sm:p-6 antialiased">

    <div class="max-w-7xl mx-auto bg-stone-900 border border-stone-800 text-stone-100 rounded-2xl p-6 shadow-xl">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-stone-800">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-stone-50">Daftar Pesan Masuk</h2>
                <p class="text-xs sm:text-sm text-stone-400 mt-1">Kelola semua pesan dan masukan dari pengguna.</p>
            </div>
            <!-- Badge Total Pesan (Opsional) -->
            <span class="bg-amber-500/10 text-amber-500 text-xs font-semibold px-3 py-1 rounded-full border border-amber-500/20">
                {{ count($messages) }} Pesan
            </span>
        </div>

        <!-- Grid System: 1 kolom di layar sangat kecil, 2 kolom di HP/Tablet (sm), 3 kolom di Laptop (lg) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($messages as $msg)
                <div class="flex flex-col justify-between p-5 bg-stone-950/60 hover:bg-stone-950 border border-stone-800 hover:border-stone-700/80 rounded-xl transition-all duration-200 group">
                    <div>
                        <!-- Meta Info (Nama, Email, Waktu) -->
                        <div class="flex flex-col gap-1 mb-3">
                            <div class="flex items-start justify-between gap-2">
                                <span class="font-bold text-sm sm:text-base text-amber-500 truncate max-w-[150px] sm:max-w-none" title="{{ $msg->nama }}">
                                    {{ $msg->nama }}
                                </span>
                                <span class="text-[10px] sm:text-xs text-stone-500 whitespace-nowrap pt-0.5">
                                    {{ $msg->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <span class="text-xs text-stone-400 truncate" title="{{ $msg->email }}">
                                {{ $msg->email }}
                            </span>
                        </div>

                        <!-- Konten Pesan -->
                        <div class="space-y-1.5 border-t border-stone-900 pt-3">
                            <h4 class="font-semibold text-sm text-stone-200 group-hover:text-stone-50 transition-colors line-clamp-1" title="{{ $msg->subjek }}">
                                {{ $msg->subjek }}
                            </h4>
                            <p class="text-xs text-stone-400 leading-relaxed line-clamp-3" title="{{ $msg->pesan }}">
                                {{ $msg->pesan }}
                            </p>
                        </div>
                    </div>
                    
                    <!-- Aksi Tambahan (Optional/Masa Depan) -->
                    <div class="mt-4 pt-3 border-t border-stone-900 flex justify-end">
                        <button class="text-[11px] font-medium text-stone-400 hover:text-amber-500 transition-colors">
                            Lihat Detail →
                        </button>
                    </div>
                </div>
            @empty
                <!-- Tampilan Jika Kosong (Colspan disesuaikan agar penuh) -->
                <div class="col-span-1 sm:col-span-2 lg:col-span-3 flex flex-col items-center justify-center py-12 px-4 border border-dashed border-stone-800 rounded-xl bg-stone-950/20">
                    <svg class="w-8 h-8 text-stone-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-4m-8 0H4" />
                    </svg>
                    <p class="text-stone-500 text-sm font-medium">Belum ada pesan masuk saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>

</body>
</html>
