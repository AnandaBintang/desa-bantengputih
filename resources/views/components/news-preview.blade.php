@props(['news' => []])

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 md:mb-0" style="color: #2c5530;">
                Berita Terbaru
            </h2>
            <a href="{{ route('news.index') }}"
                class="text-white px-6 py-2 rounded-lg font-semibold transition-colors duration-300"
                style="background-color: #4CAF50;" onmouseover="this.style.backgroundColor='#45a049'"
                onmouseout="this.style.backgroundColor='#4CAF50'">
                Lihat Semua Berita
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($news as $article)
                <x-news-card :article="$article" />
            @endforeach
        </div>
    </div>
</section>
