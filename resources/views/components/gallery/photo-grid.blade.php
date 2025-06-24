@props([
    'photos' => [],
])

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6" id="photo-grid">
    @forelse ($photos as $photo)
        <x-gallery.photo-item :photo="$photo" />
    @empty
        <div class="col-span-full text-center py-12">
            <div class="text-gray-400 mb-4">
                <i class="fas fa-images text-6xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Foto</h3>
            <p class="text-gray-500">Foto akan ditampilkan di sini setelah ditambahkan.</p>
        </div>
    @endforelse
</div>

@if (count($photos) > 0)
    <!-- Load More Button -->
    <div class="text-center mt-12">
        <x-gallery.load-more-button type="photo" />
    </div>
@endif
