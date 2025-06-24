@props([
    'tabs' => [
        ['id' => 'foto', 'icon' => 'fas fa-camera', 'label' => 'Foto', 'active' => true],
        ['id' => 'video', 'icon' => 'fas fa-video', 'label' => 'Video', 'active' => false],
    ],
])

<div class="flex flex-wrap justify-center mb-12 border-b border-gray-200">
    @foreach ($tabs as $tab)
        <button onclick="showGalleryTab('{{ $tab['id'] }}')"
            class="gallery-tab-btn px-8 py-4 mx-2 mb-4 font-semibold transition-all duration-300 relative border-b-4 {{ $tab['active'] ? 'text-green-500 border-green-500' : 'text-gray-600 border-transparent hover:text-green-500' }}"
            id="{{ $tab['id'] }}-tab">
            <i class="{{ $tab['icon'] }} mr-2"></i>{{ $tab['label'] }}
        </button>
    @endforeach
</div>
