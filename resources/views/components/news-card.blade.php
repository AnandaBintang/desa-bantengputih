<!-- filepath: /home/yats/Documents/projects/desa-bantengputih/resources/views/components/news-card.blade.php -->
@props(['article'])

<article
    class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
    <img src="{{ $article->media_url ?? 'https://placehold.co/400x250/4CAF50/FFFFFF?text=Berita+Desa' }}"
        alt="{{ $article->title }}" class="w-full h-48 object-cover"
        onerror="this.src='https://placehold.co/400x250/4CAF50/FFFFFF?text=Berita+Desa'">
    <div class="p-6">
        <span class="font-semibold text-sm" style="color: #4CAF50;">
            {{ $article->published_at?->format('d F Y') ?? 'Belum Dipublikasi' }}
        </span>
        <h3 class="text-xl font-bold mt-2 mb-3" style="color: #2c5530;">
            <a href="{{ route('news.show', $article->slug) }}" class="transition-colors duration-200"
                style="color: #2c5530;" onmouseover="this.style.color='#4CAF50'"
                onmouseout="this.style.color='#2c5530'">
                {{ $article->title }}
            </a>
        </h3>
        <div class="text-gray-600">
            {{ Str::limit($article->excerpt ?? strip_tags($article->content), 120) }}
        </div>
        <a href="{{ route('news.show', $article->slug) }}"
            class="inline-flex items-center font-semibold mt-3 transition-colors duration-200" style="color: #4CAF50;"
            onmouseover="this.style.color='#45a049'" onmouseout="this.style.color='#4CAF50'">
            Baca Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
        </a>
    </div>
</article>
