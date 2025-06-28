@forelse($products as $product)
    <div
        class="product-card bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transform hover:-translate-y-2 transition-all duration-300">
        <div class="relative">
            <img src="{{ $product->getFirstMediaUrl('products', 'thumb') ?: 'https://placehold.co/300x200/4CAF50/FFFFFF?text=No+Image' }}"
                alt="{{ $product->name }}" class="w-full h-48 object-cover">
            <div class="absolute top-4 left-4">
                @php
                    $categoryColors = [
                        'perikanan' => 'bg-blue-100 text-blue-800',
                        'pertanian' => 'bg-green-100 text-green-800',
                    ];
                    $categoryKey = strtolower($product->category);
                    $colorClass = $categoryColors[$categoryKey] ?? 'bg-gray-100 text-gray-800';
                @endphp
                <span class="{{ $colorClass }} px-2 py-1 rounded-full text-xs font-semibold">
                    <i class="fas fa-tag mr-1"></i>{{ ucfirst($product->category) }}
                </span>
            </div>
        </div>
        <div class="p-6">
            <h3 class="text-xl font-bold text-secondary mb-2">{{ $product->name }}</h3>
            <div class="text-gray-600 mb-4">{!! $product->description !!}</div>
            <div class="flex items-center justify-between mb-4">
                <div class="text-2xl font-bold text-primary">
                    Rp {{ number_format($product->price, 0, ',', '.') }}/{{ $product->unit ?? 'pcs' }}
                </div>
            </div>
            <a href="{{ route('products.show', $product) }}"
                class="w-full bg-primary hover:bg-accent text-white py-2 px-4 rounded-lg font-semibold transition-colors duration-200 block text-center">
                <i class="fas fa-info-circle mr-2"></i>Detail Produk
            </a>
        </div>
    </div>
@empty
    <div class="col-span-full text-center text-gray-500">Belum ada produk tersedia.</div>
@endforelse
