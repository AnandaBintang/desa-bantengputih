@props([
    'stats' => [],
])

@php
    $statsData = [
        [
            'number' => isset($stats['photos']) ? $stats['photos'] . '+' : '0',
            'label' => 'Foto Tersimpan',
        ],
        [
            'number' => isset($stats['videos']) ? $stats['videos'] . '+' : '0',
            'label' => 'Video Dokumenter',
        ],
        [
            'number' => isset($stats['activities']) ? $stats['activities'] . '+' : '0',
            'label' => 'Kegiatan Terdokumentasi',
        ],
        [
            'number' => isset($stats['categories']) ? $stats['categories'] . '+' : '0',
            'label' => 'Kategori',
        ],
    ];
@endphp

<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            @foreach ($statsData as $stat)
                <x-gallery.stat-item :stat="$stat" />
            @endforeach
        </div>
    </div>
</section>
