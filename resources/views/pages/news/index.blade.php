<x-layouts.app :title="'Berita & Kegiatan - Desa Bantengputih'" :description="'Dapatkan informasi terbaru tentang berbagai kegiatan, program, dan perkembangan yang terjadi di Desa Bantengputih'" :keywords="'berita desa, kegiatan desa, bantengputih, informasi desa'" :ogTitle="'Berita & Kegiatan - Desa Bantengputih'" :ogDescription="'Dapatkan informasi terbaru tentang berbagai kegiatan, program, dan perkembangan yang terjadi di Desa Bantengputih'"
    :ogImage="asset('images/news-hero.jpg')">

    <x-slot name="head">
        <style>
            .line-clamp-3 {
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            /* News filter button active state */
            .news-filter-btn.active {
                background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
                color: white;
            }

            /* Hover effects */
            .news-card:hover {
                transform: translateY(-2px);
            }

            /* Loading spinner */
            .fa-spinner {
                animation: spin 1s linear infinite;
            }

            @keyframes spin {
                0% {
                    transform: rotate(0deg);
                }

                100% {
                    transform: rotate(360deg);
                }
            }

            /* Green gradient classes */
            .bg-green-gradient {
                background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
            }
        </style>
        <!-- Page-specific structured data -->
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "NewsArticle",
            "name": "Berita & Kegiatan - Desa Bantengputih",
            "description": "Dapatkan informasi terbaru tentang berbagai kegiatan, program, dan perkembangan yang terjadi di Desa Bantengputih",
            "url": "{{ request()->url() }}"
        }
        </script>
    </x-slot>

    <!-- Hero Section -->
    <section class="bg-green-gradient py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Berita & Kegiatan
            </h1>
            <p class="text-xl text-white opacity-90 max-w-3xl mx-auto">
                Dapatkan informasi terbaru tentang berbagai kegiatan, program, dan perkembangan yang terjadi di Desa
                Bantengputih
            </p>
        </div>
    </section>

    <!-- News Filter -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-center gap-4 mb-8">
                @foreach ($categories as $key => $label)
                    <button onclick="filterNews('{{ $key }}')"
                        class="news-filter-btn px-6 py-3 rounded-full font-semibold transition-colors duration-200
                                   {{ ($category ?? 'semua') === $key
                                       ? 'bg-green-gradient text-white'
                                       : 'bg-gray-200 text-gray-700 hover:bg-green-gradient hover:text-white' }}"
                        data-filter="{{ $key }}">
                        <i
                            class="{{ $key === 'semua'
                                ? 'fas fa-globe'
                                : ($key === 'pembangunan'
                                    ? 'fas fa-hammer'
                                    : ($key === 'sosial'
                                        ? 'fas fa-users'
                                        : ($key === 'ekonomi'
                                            ? 'fas fa-chart-line'
                                            : 'fas fa-theater-masks'))) }} mr-2"></i>
                        {{ $label['name'] }}
                    </button>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured News -->
    @if ($featuredNews)
        <section class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-6">
                        Berita Utama
                    </h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">
                        Berita terpenting dan terbaru dari Desa Bantengputih
                    </p>
                </div>

                <!-- Featured Article -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-12"
                    data-category="{{ $featuredNews->category }}">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div class="relative">
                            <img src="{{ $featuredNews->media_url }}" alt="{{ $featuredNews->title }}"
                                class="w-full h-64 lg:h-full object-cover" />
                            <div class="absolute top-4 left-4">
                                <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                    <i class="fas fa-fire mr-1"></i>UTAMA
                                </span>
                            </div>
                        </div>
                        <div class="p-8 lg:p-12">
                            <div class="flex items-center space-x-4 mb-4">
                                <span
                                    class="{{ $categories[strtolower($featuredNews->category)]['color'] ?? 'bg-gray-500' }} text-white px-3 py-1 rounded-full text-sm font-semibold">
                                    <i
                                        class="{{ $categories[strtolower($featuredNews->category)]['icon'] ?? 'fas fa-newspaper' }} mr-1"></i>{{ $categories[strtolower($featuredNews->category)]['name'] ?? 'Umum' }}
                                </span>
                                <span class="text-gray-500 text-sm">
                                    <i
                                        class="fas fa-calendar mr-1"></i>{{ $featuredNews->published_at->format('d M Y') }}
                                </span>
                            </div>
                            <h3 class="text-2xl lg:text-3xl font-bold text-secondary mb-4">
                                {{ $featuredNews->title }}
                            </h3>
                            <p class="text-gray-600 mb-6 leading-relaxed">
                                {{ $featuredNews->excerpt }}
                            </p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4 text-sm text-gray-500">
                                    <span><i
                                            class="fas fa-eye mr-1"></i>{{ number_format($featuredNews->views_count ?? 0) }}
                                        views</span>
                                    <span><i
                                            class="fas fa-user mr-1"></i>{{ $featuredNews->user->name ?? 'Admin' }}</span>
                                </div>
                                <a href="{{ route('news.show', $featuredNews->slug) }}"
                                    class="bg-green-gradient text-white px-6 py-2 rounded-lg font-semibold hover:opacity-90 transition-opacity duration-200">
                                    <i class="fas fa-arrow-right mr-2"></i>Baca Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- News Grid -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-6">
                    Berita Terbaru
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Ikuti perkembangan terbaru dari berbagai kegiatan dan program desa
                </p>
            </div>

            @if ($news->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="news-grid">
                    @foreach ($news as $article)
                        <article
                            class="news-card bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300"
                            data-category="{{ $article->category }}">
                            <div class="relative">
                                <img src="{{ $article->media_url }}" alt="{{ $article->title }}"
                                    class="w-full h-48 object-cover" />
                                <div class="absolute top-4 left-4">
                                    <span
                                        class="{{ $categories[strtolower($article->category)]['color'] ?? 'bg-gray-500' }} text-white px-3 py-1 rounded-full text-sm font-semibold">
                                        <i
                                            class="{{ $categories[strtolower($article->category)]['icon'] ?? 'fas fa-newspaper' }} mr-1"></i>{{ $categories[strtolower($article->category)]['name'] ?? 'Umum' }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center space-x-2 mb-3">
                                    <span class="text-gray-500 text-sm">
                                        <i
                                            class="fas fa-calendar mr-1"></i>{{ $article->published_at->format('d M Y') }}
                                    </span>
                                    <span class="text-gray-300">•</span>
                                    <span class="text-gray-500 text-sm">
                                        <i class="fas fa-eye mr-1"></i>{{ number_format($article->views_count ?? 0) }}
                                        views
                                    </span>
                                </div>
                                <h3
                                    class="text-xl font-bold text-secondary mb-3 hover:text-primary transition-colors duration-200">
                                    <a href="{{ route('news.show', $article->slug) }}">{{ $article->title }}</a>
                                </h3>
                                <p class="text-gray-600 mb-4 line-clamp-3">
                                    {{ $article->excerpt }}
                                </p>
                                <div class="flex items-center justify-between">
                                    <a href="{{ route('news.show', $article->slug) }}"
                                        class="text-primary font-semibold hover:text-accent transition-colors duration-200">
                                        Baca Selengkapnya
                                    </a>
                                    <div class="flex space-x-2">
                                        <button class="text-gray-400 hover:text-red-500 transition-colors duration-200"
                                            onclick="toggleLike({{ $article->id }})">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                        <button class="text-gray-400 hover:text-blue-500 transition-colors duration-200"
                                            onclick="shareNews('{{ route('news.show', $article->slug) }}', '{{ $article->title }}')">
                                            <i class="fas fa-share"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Load More Button -->
                @if ($news->hasMorePages())
                    <div class="text-center mt-12">
                        <button onclick="loadMoreNews()"
                            class="bg-green-gradient text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200"
                            id="loadMoreBtn">
                            <i class="fas fa-plus mr-2"></i>Muat Lebih Banyak
                        </button>
                    </div>
                @endif
            @else
                <div class="text-center py-16">
                    <div class="max-w-md mx-auto">
                        <div class="bg-gray-100 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-newspaper text-3xl text-gray-400"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak Ada Berita</h3>
                        <p class="text-gray-600 mb-6">
                            Belum ada berita yang dipublikasikan untuk kategori atau pencarian ini.
                        </p>
                        <a href="{{ route('news.index') }}"
                            class="bg-green-gradient text-white px-6 py-2 rounded-lg font-semibold hover:opacity-90 transition-opacity duration-200">
                            <i class="fas fa-arrow-left mr-2"></i>Lihat Semua Berita
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>

    @push('scripts')
        <script>
            let currentPage = 1;
            const currentCategory = '{{ $category ?? 'semua' }}';

            // News Filter Function
            function filterNews(category) {
                const url = new URL(window.location);
                if (category === 'semua') {
                    url.searchParams.delete('category');
                } else {
                    url.searchParams.set('category', category);
                }
                window.location.href = url.toString();
            }

            // Load More News Function
            function loadMoreNews() {
                const loadMoreBtn = document.getElementById('loadMoreBtn');
                const originalText = loadMoreBtn.innerHTML;

                loadMoreBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memuat...';
                loadMoreBtn.disabled = true;

                fetch(`{{ route('news.load-more') }}?page=${currentPage + 1}&category=${currentCategory}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.html) {
                            document.getElementById('news-grid').insertAdjacentHTML('beforeend', data.html);
                            currentPage++;

                            if (!data.hasMore) {
                                loadMoreBtn.style.display = 'none';
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error loading more news:', error);
                    })
                    .finally(() => {
                        loadMoreBtn.innerHTML = originalText;
                        loadMoreBtn.disabled = false;
                    });
            }

            // Toggle Like Function
            function toggleLike(newsId) {
                // Implement like functionality if needed
                console.log('Like news:', newsId);
            }

            // Share News Function
            function shareNews(url, title) {
                if (navigator.share) {
                    navigator.share({
                        title: title,
                        url: url
                    });
                } else {
                    // Fallback: copy to clipboard
                    navigator.clipboard.writeText(url).then(() => {
                        alert('Link berhasil disalin!');
                    });
                }
            }

            // Initialize
            document.addEventListener('DOMContentLoaded', function() {
                // Any initialization code here
            });
        </script>
    @endpush

</x-layouts.app>
