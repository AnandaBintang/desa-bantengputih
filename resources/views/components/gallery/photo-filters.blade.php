@props([
    'filters' => [],
])

<div class="flex flex-wrap justify-center mb-8">
    @foreach ($filters as $filter)
        <button onclick="filterPhotos('{{ $filter['id'] }}')"
            class="photo-filter-btn px-6 py-2 mx-2 mb-2 rounded-full font-medium transition-all duration-200 transform hover:scale-105 @if ($filter['active']) text-white @else bg-gray-200 text-gray-700 hover:text-white @endif"
            @if ($filter['active']) style="background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%); box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);" @endif
            data-filter="{{ $filter['id'] }}">
            {{ $filter['label'] }}
        </button>
    @endforeach
</div>
