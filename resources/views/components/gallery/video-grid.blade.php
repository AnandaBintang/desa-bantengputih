@props([
    'videos' => [],
])

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @forelse ($videos as $video)
        <x-gallery.video-item :video="$video" />
    @empty
        <div class="col-span-full text-center py-12">
            <div class="text-gray-400 mb-4">
                <i class="fas fa-video text-6xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Video</h3>
            <p class="text-gray-500">Video akan ditampilkan di sini setelah ditambahkan.</p>
        </div>
    @endforelse
</div>

@if (count($videos) > 0)
    <!-- Load More Button -->
    <div class="text-center mt-12">
        <x-gallery.load-more-button type="video" />
    </div>
@endif
