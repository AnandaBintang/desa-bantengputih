<x-layouts.app :title="$product->name">
    <section class="py-20 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <img src="{{ $product->getFirstMediaUrl('products', 'large') ?: 'https://placehold.co/300x200/4CAF50/FFFFFF?text=No+Image' }}"
                        alt="{{ $product->name }}" class="w-full rounded-lg">
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-secondary mb-2">{{ $product->name }}</h1>
                    <div class="text-2xl font-bold text-primary mb-4">
                        Rp. {{ number_format($product->price, 0, ',', '.') }}/{{ $product->unit ?? 'pcs' }}
                    </div>
                    <div class="text-gray-600 mb-4">{!! $product->description !!}</div>
                    <div class="flex flex-col sm:flex-row gap-3 mt-6">
                        <a href="https://wa.me/{{ $villageInfo->phone ?? '' }}?text=Halo,%20saya%20tertarik%20dengan%20produk%20{{ urlencode($product->name) }}"
                            target="_blank"
                            class="bg-primary hover:bg-accent text-white px-6 py-3 rounded-lg font-semibold text-center transition-colors duration-300">
                            <i class="fab fa-whatsapp mr-2"></i>Pesan via WhatsApp
                        </a>
                        <a href="{{ route('products.index') }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-lg font-semibold transition-colors duration-300 text-center">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar Produk
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
