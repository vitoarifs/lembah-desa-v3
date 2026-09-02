<div class="py-12 max-w-3xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-sm">
        <a href="{{ route('artikel.index') }}" class="text-sm text-gray-500 hover:text-gray-700">&larr; Kembali ke Daftar Artikel</a>
        <h1 class="text-4xl font-extrabold my-4 text-gray-900 dark:text-white">{{ $article->title }}</h1>
        <p class="text-xs text-gray-400 mb-6">Dipublikasikan pada {{ $article->created_at->format('d M Y') }}</p>
        <div class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-line">
            {{ $article->content }}
        </div>
    </div>
</div>
