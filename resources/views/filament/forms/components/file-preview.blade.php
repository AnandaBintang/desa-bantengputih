<div class="p-4 border rounded-lg bg-gray-50">
    @if ($getRecord()->type === 'photo')
        <img src="{{ Storage::disk('public')->url($getRecord()->file_path) }}" alt="Preview"
            class="max-w-full h-64 object-contain mx-auto rounded-lg">
    @elseif($getRecord()->type === 'video')
        <div class="text-center">
            <div class="bg-gray-200 rounded-lg p-8 mb-4">
                <svg class="mx-auto h-16 w-16 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M2 6a2 2 0 012-2h6l2 2h6a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
                </svg>
                <p class="mt-2 text-sm text-gray-600">Video File</p>
            </div>
            <a href="{{ Storage::disk('public')->url($getRecord()->file_path) }}" target="_blank"
                class="text-blue-600 hover:text-blue-800 underline">
                Lihat Video
            </a>
        </div>
    @endif

    <div class="mt-4 text-sm text-gray-600 text-center">
        <p><strong>File:</strong> {{ $getRecord()->file_name }}</p>
        <p><strong>Ukuran:</strong> {{ $getRecord()->file_size_human }}</p>
        <p><strong>Tipe:</strong> {{ $getRecord()->file_type }}</p>
    </div>
</div>
