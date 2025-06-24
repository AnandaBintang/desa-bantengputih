@props([
    'title' => 'Berbagi Momen Bersama',
    'description' =>
        'Punya foto atau video menarik tentang desa? Bagikan dengan kami untuk memperkaya galeri dokumentasi Desa Bantengputih',
    'note' => '*Foto dan video akan direview terlebih dahulu sebelum dipublikasikan',
])

<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-secondary mb-6">
            {{ $title }}
        </h2>
        <p class="text-gray-600 mb-8 max-w-2xl mx-auto">
            {{ $description }}
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <x-gallery.upload-button type="photo" />
            <x-gallery.upload-button type="video" />
        </div>
        <p class="text-sm text-gray-500 mt-4">
            {{ $note }}
        </p>
    </div>
</section>
