<x-layouts.app :title="$title" :description="$description" :keywords="$keywords" :ogTitle="$ogTitle" :ogDescription="$ogDescription"
    :ogImage="$ogImage">

    <x-slot name="head">
        <link rel="stylesheet" href="{{ asset('css/gallery.css') }}">
        <!-- Page-specific structured data -->
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "ImageGallery",
            "name": "{{ $title }}",
            "description": "{{ $description }}",
            "url": "{{ request()->url() }}"
        }
        </script>
    </x-slot>

    <!-- Hero Section -->
    <x-gallery.hero />

    <!-- Gallery Stats -->
    <x-gallery.stats :stats="$stats" />

    <!-- Gallery Content -->
    <x-gallery.content :photos="$photos" :videos="$videos" :categories="$categories" />

    <!-- Upload Section -->
    <x-gallery.upload-section />

    <!-- Lightbox -->
    <x-gallery.lightbox />

    @push('scripts')
        <script src="{{ asset('js/gallery.js') }}"></script>
        <script>
            // Pass data to JavaScript
            window.galleryData = {
                photos: @json($photos),
                videos: @json($videos),
                categories: @json($categories)
            };
        </script>
    @endpush

</x-layouts.app>
