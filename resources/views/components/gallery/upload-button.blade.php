@props([
    'type' => 'photo', // photo or video
])

@php
    $config = [
        'photo' => [
            'icon' => 'fas fa-camera',
            'text' => 'Kirim Foto',
            'style' => 'background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);',
            'class' => 'text-white',
        ],
        'video' => [
            'icon' => 'fas fa-video',
            'text' => 'Kirim Video',
            'style' => '',
            'class' => 'bg-blue-500 text-white hover:bg-blue-600',
        ],
    ][$type];
@endphp

<a href="{{ route('guest.upload', ['type' => $type]) }}"
    class="inline-block px-8 py-3 rounded-lg font-semibold transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl {{ $config['class'] }}"
    @if ($config['style']) style="{{ $config['style'] }}" @endif>
    <i class="{{ $config['icon'] }} mr-2"></i>{{ $config['text'] }}
</a>
