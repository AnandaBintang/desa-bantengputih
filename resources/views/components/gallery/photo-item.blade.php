@props(['photo'])

<div class="photo-item group cursor-pointer" data-category="{{ $photo['category'] }}"
    onclick="openLightbox('{{ $photo['large_src'] ?? $photo['src'] }}', '{{ $photo['title'] }}', '{{ $photo['description'] ?? '' }}')">
    <div class="relative overflow-hidden rounded-lg shadow-lg bg-white">
        <img src="{{ $photo['src'] }}" alt="{{ $photo['title'] }}"
            class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300" />
        <div
            class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-300 flex items-center justify-center">
            <i
                class="fas fa-search-plus text-white text-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i>
        </div>
        <div class="p-4">
            <h3 class="font-semibold text-gray-800 mb-1">
                {!! Str::limit($photo['title'], 25) !!}
            </h3>
            <div class="text-sm text-gray-600">
                {!! Str::limit($photo['description'], 30) !!}
            </div>
        </div>
    </div>
</div>
