<x-layouts.app :title="'Produk UMKM Desa Bantengputih'" :description="'Temukan berbagai produk unggulan hasil karya warga Desa Bantengputih dengan kualitas terbaik dan harga terjangkau.'" :keywords="'produk desa bantengputih, umkm lamongan, produk unggulan desa, pertanian, perikanan, jual produk desa, produk lokal lamongan'" :canonical="route('products.index')" :ogTitle="'Produk UMKM Desa Bantengputih'"
    :ogDescription="'Temukan berbagai produk unggulan hasil karya warga Desa Bantengputih dengan kualitas terbaik dan harga terjangkau.'" :ogImage="asset('images/og-image-produk.jpg')">
    <section class="bg-gradient-to-r from-primary to-accent py-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">Produk UMKM Desa</h1>
            <p class="text-xl text-white opacity-90 max-w-3xl mx-auto">
                Temukan berbagai produk unggulan hasil karya warga Desa Bantengputih dengan kualitas terbaik dan harga
                terjangkau
            </p>
        </div>
    </section>

    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-wrap justify-center gap-4 mb-8">
                <a href="{{ route('products.index') }}"
                    class="product-filter-btn px-6 py-3 rounded-full transition-colors duration-200 {{ $selectedCategory == 'semua' ? 'bg-primary text-white' : 'bg-gray-200 text-gray-700 hover:bg-primary hover:text-white' }}">
                    Semua Produk
                </a>
                @foreach ($categories as $cat)
                    <a href="{{ route('products.index', ['category' => $cat]) }}"
                        class="product-filter-btn px-6 py-3 rounded-full transition-colors duration-200 {{ $selectedCategory == $cat ? 'bg-primary text-white' : 'bg-gray-200 text-gray-700 hover:bg-primary hover:text-white' }}">
                        {{ ucfirst($cat) }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div id="products-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @include('pages.products._list', ['products' => $products])
            </div>
            @if ($products->hasMorePages())
                <div class="text-center mt-12">
                    <button id="load-more-btn"
                        class="bg-gradient-to-r from-primary to-accent text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200"
                        data-next-page="{{ $products->currentPage() + 1 }}">
                        <i class="fas fa-plus mr-2"></i>Muat Lebih Banyak
                    </button>
                </div>
            @endif
        </div>
    </section>

    @push('scripts')
        <script>
            let nextPage = {{ $products->currentPage() + 1 }};
            const lastPage = {{ $products->lastPage() }};
            const loadMoreBtn = document.getElementById('load-more-btn');
            const productsGrid = document.getElementById('products-grid');
            let isLoading = false;

            if (loadMoreBtn) {
                loadMoreBtn.addEventListener('click', function() {
                    if (isLoading) return;
                    isLoading = true;
                    loadMoreBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memuat...';

                    let url = "{{ route('products.index') }}?page=" + nextPage +
                        @if (request('category'))
                            "&category={{ request('category') }}"
                        @else
                            ""
                        @endif ;

                    fetch(url, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(res => res.text())
                        .then(html => {
                            productsGrid.insertAdjacentHTML('beforeend', html);
                            nextPage++;
                            if (nextPage > lastPage) {
                                loadMoreBtn.style.display = 'none';
                            } else {
                                loadMoreBtn.innerHTML = '<i class="fas fa-plus mr-2"></i>Muat Lebih Banyak';
                            }
                            isLoading = false;
                        });
                });
            }
        </script>
    @endpush
</x-layouts.app>
