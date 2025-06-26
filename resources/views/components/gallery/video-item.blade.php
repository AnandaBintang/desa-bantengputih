@props(['video'])

<div class="video-item bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
    <div class="relative cursor-pointer"
        onclick="openVideoLightbox('{{ $video['video_url'] }}', '{{ $video['title'] }}', '{{ $video['description'] }}')">
        <img src="{{ $video['thumbnail'] }}" alt="{{ $video['title'] }}" class="w-full h-48 object-cover" />
        <div
            class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center group hover:bg-opacity-40 transition-all duration-200">
            <div
                class="bg-white bg-opacity-90 hover:bg-opacity-100 rounded-full w-16 h-16 flex items-center justify-center transition-all duration-200 group-hover:scale-110 shadow-lg">
                <i class="fas fa-play text-2xl ml-1"
                    style="background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"></i>
            </div>
        </div>
        <div class="absolute bottom-2 right-2 bg-black bg-opacity-80 text-white px-2 py-1 rounded text-xs font-medium">
            {{ $video['duration'] }}
        </div>
        <div class="absolute top-2 left-2 bg-red-600 text-white px-2 py-1 rounded text-xs font-medium">
            <i class="fas fa-video mr-1"></i>VIDEO
        </div>
    </div>
    <div class="p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-2 line-clamp-2">
            {{ $video['title'] }}
        </h3>
        <div class="text-gray-600 mb-4 line-clamp-3">
            {!! $video['description'] !!}
        </div>
        <div class="flex items-center justify-between text-sm text-gray-500">
            {{-- <span><i class="fas fa-eye mr-1"></i>{{ $video['views'] }} views</span> --}}
            <span><i class="fas fa-calendar mr-1"></i>{{ $video['date'] }}</span>
        </div>
    </div>
</div>
