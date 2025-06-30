@php
    $categories = [
        'pembangunan' => ['name' => 'Pembangunan', 'icon' => 'fas fa-hammer', 'color' => 'bg-blue-500'],
        'sosial' => ['name' => 'Sosial', 'icon' => 'fas fa-users', 'color' => 'bg-yellow-500'],
        'ekonomi' => ['name' => 'Ekonomi', 'icon' => 'fas fa-chart-line', 'color' => 'bg-green-500'],
        'budaya' => ['name' => 'Budaya', 'icon' => 'fas fa-theater-masks', 'color' => 'bg-purple-500'],
    ];
@endphp

<x-layouts.app :title="$news->title . ' - Desa Bantengputih'" :description="$news->excerpt" :keywords="$news->title . ', berita desa, bantengputih'" :ogTitle="$news->title" :ogDescription="$news->excerpt"
    :ogImage="$news->featured_image">

    <x-slot name="head">
        <style>
            .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .prose {
                color: #374151;
            }

            .prose p {
                margin-bottom: 1.5rem;
            }

            .prose h2 {
                color: #2c5530;
                font-weight: 700;
                font-size: 1.5rem;
                margin-top: 2rem;
                margin-bottom: 1rem;
            }

            .prose ul,
            .prose ol {
                margin-bottom: 1.5rem;
            }

            .prose li {
                margin-bottom: 0.5rem;
            }

            .prose blockquote {
                border-left: 4px solid #4CAF50;
                padding-left: 1.5rem;
                padding-top: 1rem;
                padding-bottom: 1rem;
                margin: 2rem 0;
                background-color: #f0f9ff;
                border-radius: 0 0.5rem 0.5rem 0;
            }
        </style>

        <!-- Structured Data for Article -->
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "NewsArticle",
            "headline": "{{ $news->title }}",
            "description": "{{ $news->excerpt }}",
            "image": "{{ $news->featured_image }}",
            "author": {
                "@type": "Person",
                "name": "{{ $news->user->name ?? 'Admin Desa' }}"
            },
            "publisher": {
                "@type": "Organization",
                "name": "Desa Bantengputih",
                "logo": {
                    "@type": "ImageObject",
                    "url": "{{ asset('images/logo.png') }}"
                }
            },
            "datePublished": "{{ $news->published_at->toISOString() }}",
            "dateModified": "{{ $news->updated_at->toISOString() }}",
            "url": "{{ route('news.show', $news->slug) }}"
        }
        </script>
    </x-slot>

    <!-- Breadcrumb -->
    <section class="py-6 bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary">
                            <i class="fas fa-home mr-2"></i>Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <a href="{{ route('news.index') }}"
                                class="text-sm font-medium text-gray-700 hover:text-primary">Berita & Kegiatan</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <span class="text-sm font-medium text-gray-500">{{ Str::limit($news->title, 50) }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Article Content -->
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Main Article -->
                <div class="col-span-2">
                    <article class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <!-- Article Header -->
                        <div class="relative">
                            <img src="{{ $news->media_url }}" alt="{{ $news->title }}"
                                class="w-full h-64 md:h-80 object-cover" />
                            <div class="absolute top-4 left-4">
                                <span
                                    class="{{ $categories[strtolower($news->category)]['color'] ?? 'bg-gray-500' }} text-white px-3 py-1 rounded-full text-sm font-semibold">
                                    <i
                                        class="{{ $categories[strtolower($news->category)]['icon'] ?? 'fas fa-newspaper' }} mr-1"></i>{{ $categories[strtolower($news->category)]['name'] ?? 'Umum' }}
                                </span>
                            </div>
                        </div>

                        <!-- Article Content -->
                        <div class="p-8 md:p-12">
                            <!-- Article Meta -->
                            <div class="flex flex-wrap items-center gap-4 mb-6 text-sm text-gray-600">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar mr-2"></i>
                                    <span>{{ $news->published_at->format('d F Y') }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-user mr-2"></i>
                                    <span>{{ $news->user->name ?? 'Admin Desa' }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-eye mr-2"></i>
                                    <span>{{ number_format($news->views_count ?? 0) }} views</span>
                                </div>
                            </div>

                            <!-- Article Title -->
                            <h1 class="text-3xl md:text-4xl font-bold text-secondary mb-6 leading-tight">
                                {{ $news->title }}
                            </h1>

                            <!-- Article Content -->
                            <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                                @if ($news->excerpt)
                                    <p class="text-xl text-gray-600 mb-8 font-medium">
                                        {{ $news->excerpt }}
                                    </p>
                                @endif

                                {!! $news->content !!}
                            </div>

                            <!-- Article Footer -->
                            <div class="mt-12 pt-8 border-t border-gray-200">
                                <div class="flex flex-wrap items-center justify-between gap-4">
                                    <!-- Tags -->
                                    <div class="flex flex-wrap gap-2">
                                        <span class="text-sm text-gray-600 mr-2">Tags:</span>
                                        <span
                                            class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm hover:bg-gray-200 transition-colors duration-200">
                                            @if ($news->tags)
                                                @foreach (is_string($news->tags) ? json_decode($news->tags, true) : $news->tags as $tag)
                                                    <span
                                                        class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm hover:bg-gray-200 transition-colors duration-200 mr-2 mb-2 inline-block">
                                                        #{{ $tag }}
                                                    </span>
                                                @endforeach
                                            @endif
                                        </span>
                                    </div>

                                    <!-- Share Buttons -->
                                    <div class="flex items-center gap-3">
                                        <span class="text-sm text-gray-600 mr-2">Bagikan:</span>
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('news.show', $news->slug)) }}"
                                            target="_blank"
                                            class="bg-blue-500 text-white p-2 rounded-full hover:bg-blue-600 transition-colors duration-200">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                        <a href="https://wa.me/?text={{ urlencode($news->title . ' - ' . route('news.show', $news->slug)) }}"
                                            target="_blank"
                                            class="bg-green-500 text-white p-2 rounded-full hover:bg-green-600 transition-colors duration-200">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                        <button onclick="copyToClipboard('{{ route('news.show', $news->slug) }}')"
                                            class="bg-gray-500 text-white p-2 rounded-full hover:bg-gray-600 transition-colors duration-200">
                                            <i class="fas fa-link"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Related Articles -->
                    @if ($relatedNews->count() > 0)
                        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                            <h3 class="text-xl font-bold text-secondary mb-6">
                                <i class="fas fa-newspaper text-primary mr-2"></i>Berita Terkait
                            </h3>
                            <div class="space-y-4">
                                @foreach ($relatedNews as $related)
                                    <article
                                        class="flex space-x-3 pb-4 border-b border-gray-200 last:border-b-0 last:pb-0">
                                        <img src="{{ $related->media_url }}" alt="{{ $related->title }}"
                                            class="w-20 h-15 object-cover rounded-lg flex-shrink-0" />
                                        <div class="flex-1">
                                            <h4
                                                class="font-semibold text-secondary text-sm mb-1 leading-tight hover:text-primary transition-colors duration-200">
                                                <a
                                                    href="{{ route('news.show', $related->slug) }}">{{ $related->title }}</a>
                                            </h4>
                                            <p class="text-xs text-gray-500 mb-1">
                                                {{ $related->published_at->format('d M Y') }}</p>
                                            <p class="text-xs text-gray-600 line-clamp-2">
                                                {{ $related->excerpt }}
                                            </p>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Popular News -->
                    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                        <h3 class="text-xl font-bold text-secondary mb-6">
                            <i class="fas fa-fire text-red-500 mr-2"></i>Berita Populer
                        </h3>
                        <div class="space-y-4">
                            @php
                                $popularNews = App\Models\News::published()
                                    ->orderBy('views_count', 'desc')
                                    ->limit(3)
                                    ->get();
                            @endphp
                            @foreach ($popularNews as $index => $popular)
                                <div class="flex items-center space-x-3">
                                    <span
                                        class="bg-{{ $index === 0 ? 'red' : ($index === 1 ? 'orange' : 'yellow') }}-500 text-white text-sm font-bold px-2 py-1 rounded">
                                        {{ $index + 1 }}
                                    </span>
                                    <div class="flex-1">
                                        <h4
                                            class="font-semibold text-secondary text-sm leading-tight hover:text-primary transition-colors duration-200">
                                            <a
                                                href="{{ route('news.show', $popular->slug) }}">{{ $popular->title }}</a>
                                        </h4>
                                        <p class="text-xs text-gray-500">
                                            {{ number_format($popular->views_count ?? 0) }} views</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Back to News -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <a href="{{ route('news.index') }}"
                            class="flex items-center justify-center w-full bg-primary text-white py-3 px-4 rounded-lg hover:bg-accent transition-colors duration-200">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali ke Berita
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            // Copy to clipboard function
            function copyToClipboard(text) {
                navigator.clipboard.writeText(text).then(function() {
                    alert('Link berhasil disalin!');
                }, function(err) {
                    console.error('Could not copy text: ', err);
                });
            }

            // Mobile menu functionality
            document.querySelectorAll('.mobile-dropdown-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const content = this.nextElementSibling;
                    content.classList.toggle('hidden');
                    this.querySelector('i').classList.toggle('rotate-180');
                });
            });

            document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
                document.getElementById('mobile-menu').classList.remove('hidden');
            });

            document.getElementById('mobile-menu-close')?.addEventListener('click', function() {
                document.getElementById('mobile-menu').classList.add('hidden');
            });
        </script>
    @endpush

</x-layouts.app>
