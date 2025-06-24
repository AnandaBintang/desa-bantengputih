@props([
    'type' => 'photo', // photo or video
])

@php
    $text = $type === 'video' ? 'Muat Video Lainnya' : 'Muat Lebih Banyak';
@endphp

<button onclick="loadMoreContent('{{ $type }}')"
    class="text-white px-8 py-3 rounded-lg font-semibold transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl"
    style="background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);">
    <i class="fas fa-plus mr-2"></i>{{ $text }}
</button>
