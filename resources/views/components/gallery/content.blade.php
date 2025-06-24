@props([
    'photos' => [],
    'videos' => [],
    'categories' => [],
])

<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Tab Navigation -->
        <x-gallery.tab-navigation />

        <!-- Photo Gallery Tab -->
        <div id="gallery-foto" class="gallery-content">
            <x-gallery.photo-filters :filters="$categories" />
            <x-gallery.photo-grid :photos="$photos" />
        </div>

        <!-- Video Gallery Tab -->
        <div id="gallery-video" class="gallery-content hidden">
            <x-gallery.video-grid :videos="$videos" />
        </div>
    </div>
</section>
