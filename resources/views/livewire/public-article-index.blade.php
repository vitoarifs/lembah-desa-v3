<div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-6 text-gray-900 dark:text-white">Artikel Terbaru</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($articles as $article)
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-semibold mb-2 text-gray-800 dark:text-gray-200">{{ $article->title }}</h2>
                <p class="text-gray-600 dark:text-gray-400 mb-4">{{ Str::limit($article->content, 100) }}</p>
                <a href="{{ route('artikel.show', $article->slug) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Baca Selengkapnya &rarr;</a>
            </div>
        @endforeach
    </div>
</div>
