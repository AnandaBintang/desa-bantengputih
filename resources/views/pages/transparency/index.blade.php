{{-- filepath: resources/views/pages/transparency/index.blade.php --}}
<x-layouts.app :title="'Transparansi Desa Bantengputih'" :description="'Akses dokumen, laporan keuangan, dan informasi publik Desa Bantengputih secara terbuka dan akuntabel.'" :keywords="'transparansi desa, dokumen publik, laporan keuangan, keterbukaan informasi, desa bantengputih, lamongan'" :canonical="route('transparency')" :ogTitle="'Transparansi Desa Bantengputih'"
    :ogDescription="'Akses dokumen, laporan keuangan, dan informasi publik Desa Bantengputih secara terbuka dan akuntabel.'" :ogImage="asset('images/og-image-transparansi.jpg')">
    <section class="bg-gradient-to-r from-primary to-accent py-20" itemscope itemtype="https://schema.org/WebPage">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6" itemprop="name">Transparansi Desa</h1>
            <p class="text-xl text-white opacity-90 max-w-3xl mx-auto" itemprop="description">
                Komitmen kami untuk keterbukaan informasi publik. Akses mudah ke dokumen, laporan keuangan, dan
                informasi penting lainnya untuk mewujudkan tata kelola yang transparan dan akuntabel.
            </p>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-6">Ringkasan Transparansi</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Data terbaru mengenai keterbukaan informasi dan akuntabilitas pengelolaan Desa Bantengputih
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div
                    class="bg-gradient-to-br from-blue-500 to-blue-600 p-8 rounded-xl text-white text-center shadow-lg">
                    <i class="fas fa-file-alt text-4xl mb-4"></i>
                    <h3 class="text-3xl font-bold mb-2">{{ $stats['total_documents'] }}</h3>
                    <p class="text-blue-100">Dokumen Publik</p>
                </div>
                <div
                    class="bg-gradient-to-br from-green-500 to-green-600 p-8 rounded-xl text-white text-center shadow-lg">
                    <i class="fas fa-chart-line text-4xl mb-4"></i>
                    <h3 class="text-3xl font-bold mb-2">{{ $stats['accountability'] }}%</h3>
                    <p class="text-green-100">Akuntabilitas</p>
                </div>
                <div
                    class="bg-gradient-to-br from-yellow-500 to-yellow-600 p-8 rounded-xl text-white text-center shadow-lg">
                    <i class="fas fa-download text-4xl mb-4"></i>
                    <h3 class="text-3xl font-bold mb-2">{{ $stats['total_downloads'] }}</h3>
                    <p class="text-yellow-100">Total Unduhan</p>
                </div>
                <div
                    class="bg-gradient-to-br from-purple-500 to-purple-600 p-8 rounded-xl text-white text-center shadow-lg">
                    <i class="fas fa-calendar text-4xl mb-4"></i>
                    <h3 class="text-3xl font-bold mb-2">{{ $stats['current_period'] }}</h3>
                    <p class="text-purple-100">Periode Terkini</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-6">Kategori Dokumen</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Temukan dokumen yang Anda cari berdasarkan kategori berikut
                </p>
            </div>
            <nav aria-label="Filter dokumen">
                <ul class="flex flex-wrap justify-center mb-12 border-b border-gray-200">
                    @foreach ($categories as $cat)
                        <li>
                            <button onclick="showCategory('{{ $cat }}')"
                                class="category-btn px-6 py-3 mx-2 mb-4 font-semibold {{ $loop->first ? 'text-primary border-b-2 border-primary' : 'text-gray-600 hover:text-primary' }}"
                                id="{{ $cat }}-btn" type="button">
                                {!! $categoryIcons[$cat] ?? '<i class=\'fas fa-folder\'></i>' !!} {{ ucfirst($cat) }}
                            </button>
                        </li>
                    @endforeach
                </ul>
            </nav>
            @foreach ($categories as $cat)
                <div id="{{ $cat }}" class="category-content {{ $loop->first ? '' : 'hidden' }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($documentsByCategory[$cat] as $doc)
                            <article
                                class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300"
                                itemscope itemtype="https://schema.org/CreativeWork">
                                <div class="flex items-start space-x-4">
                                    <div
                                        class="w-12 h-12 {{ $categoryBg[$cat] ?? 'bg-gray-100' }} rounded-lg flex items-center justify-center flex-shrink-0">
                                        {!! $categoryIcons[$cat] ?? '<i class="fas fa-folder text-gray-500"></i>' !!}
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-lg font-bold text-secondary mb-2" itemprop="name">
                                            {{ $doc->title }}
                                        </h3>
                                        <p class="text-gray-600 text-sm mb-4" itemprop="description">
                                            {{ Str::limit(strip_tags($doc->description), 120) }}
                                        </p>
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs text-gray-500">
                                                <i
                                                    class="fas fa-calendar mr-1"></i>{{ $doc->uploaded_at ? $doc->uploaded_at->format('d M Y') : $doc->created_at->format('d M Y') }}
                                            </span>
                                            <div class="flex space-x-2">
                                                <a href="{{ route('document.preview', $doc) }}"
                                                    class="text-primary hover:text-accent text-sm font-medium"
                                                    target="_blank" rel="noopener"
                                                    aria-label="Lihat {{ $doc->title }}">
                                                    <i class="fas fa-eye mr-1"></i>Lihat
                                                </a>
                                                <a href="{{ route('document.download', $doc) }}"
                                                    class="text-blue-500 hover:text-blue-700 text-sm font-medium"
                                                    aria-label="Unduh {{ $doc->title }}">
                                                    <i class="fas fa-download mr-1"></i>Unduh
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script type="application/ld+json">
                                {
                                    "@context": "https://schema.org",
                                    "@type": "CreativeWork",
                                    "name": "{{ $doc->title }}",
                                    "description": "{{ strip_tags($doc->description) }}",
                                    "datePublished": "{{ $doc->uploaded_at ? $doc->uploaded_at->toDateString() : $doc->created_at->toDateString() }}",
                                    "url": "{{ route('document.preview', $doc) }}"
                                }
                                </script>
                            </article>
                        @empty
                            <div class="col-span-full text-center text-gray-500">Belum ada dokumen pada kategori ini.
                            </div>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-6">Permintaan Informasi</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Tidak menemukan dokumen yang Anda cari? Ajukan permintaan informasi dan kami akan membantu Anda
                </p>
            </div>
            <div class="bg-gradient-to-r from-primary to-accent rounded-xl p-8 text-white">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                    <div>
                        <h3 class="text-2xl font-bold mb-4">
                            <i class="fas fa-question-circle mr-3"></i>Butuh Dokumen Lain?
                        </h3>
                        <p class="opacity-90 mb-6">
                            Sesuai dengan ketentuan keterbukaan informasi publik, Anda dapat mengajukan permintaan untuk
                            dokumen yang tidak tersedia di halaman ini.
                        </p>
                        <ul class="space-y-2 opacity-90">
                            <li><i class="fas fa-check mr-2"></i>Respons dalam 14 hari kerja</li>
                            <li><i class="fas fa-check mr-2"></i>Gratis untuk informasi wajib</li>
                            <li><i class="fas fa-check mr-2"></i>Prosedur yang mudah</li>
                        </ul>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('contact') }}"
                            class="inline-block bg-white text-primary py-4 px-8 rounded-lg font-bold text-lg hover:bg-gray-100 transition-colors duration-200 shadow-lg">
                            <i class="fas fa-paper-plane mr-3"></i>Ajukan Permintaan
                        </a>
                        <p class="text-sm opacity-75 mt-4">
                            Atau hubungi langsung via WhatsApp
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-6">Pertanyaan Umum</h2>
                <p class="text-gray-600">
                    Jawaban untuk pertanyaan yang sering diajukan seputar transparansi desa
                </p>
            </div>
            <div class="space-y-6">
                @foreach ($faqs as $i => $faq)
                    <div class="bg-white border border-gray-200 rounded-lg">
                        <button
                            class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors duration-200"
                            onclick="toggleFaq({{ $i + 1 }})" type="button">
                            <h3 class="font-semibold text-secondary">{{ $faq['q'] }}</h3>
                            <i class="fas fa-chevron-down transform transition-transform duration-200"
                                id="faq-icon-{{ $i + 1 }}"></i>
                        </button>
                        <div class="hidden px-6 pb-4" id="faq-content-{{ $i + 1 }}">
                            <p class="text-gray-600">{{ $faq['a'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            function showCategory(categoryName) {
                // Hide all category contents
                document.querySelectorAll('.category-content').forEach(content => content.classList.add('hidden'));
                // Remove active class from all category buttons
                document.querySelectorAll('.category-btn').forEach(btn => {
                    btn.classList.remove('text-primary', 'border-b-2', 'border-primary');
                    btn.classList.add('text-gray-600');
                });
                // Show selected category content
                document.getElementById(categoryName).classList.remove('hidden');
                // Add active class to selected category button
                const activeButton = document.getElementById(categoryName + '-btn');
                activeButton.classList.remove('text-gray-600');
                activeButton.classList.add('text-primary', 'border-b-2', 'border-primary');
            }

            function toggleFaq(index) {
                const content = document.getElementById(`faq-content-${index}`);
                const icon = document.getElementById(`faq-icon-${index}`);
                if (content.classList.contains("hidden")) {
                    content.classList.remove("hidden");
                    icon.classList.add("rotate-180");
                } else {
                    content.classList.add("hidden");
                    icon.classList.remove("rotate-180");
                }
            }
        </script>
    @endpush
</x-layouts.app>
