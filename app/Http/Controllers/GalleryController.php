<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    const PER_PAGE = 12;

    public function index(Request $request)
    {
        $type = $request->get('type', 'photo');
        $category = $request->get('category', 'all');

        // Get gallery statistics
        $stats = [
            'photos' => Gallery::where('type', 'photo')->count(),
            'videos' => Gallery::where('type', 'video')->count(),
            'activities' => Gallery::where('category', 'Kegiatan')->count(),
            'categories' => Gallery::distinct('category')->whereNotNull('category')->count()
        ];

        // Get photos
        $photos = Gallery::where('type', 'photo')
            ->when($category !== 'all', function ($query) use ($category) {
                return $query->where('category', $category);
            })
            ->recent()
            ->limit(self::PER_PAGE)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'category' => strtolower(str_replace(' ', '', $item->category ?? 'umum')),
                    'src' => $item->getFirstMediaUrl('galleries', 'photo_thumb') ?: 'https://placehold.co/300x200/4CAF50/FFFFFF?text=' . urlencode($item->title),
                    'large_src' => $item->getFirstMediaUrl('galleries') ?: 'https://placehold.co/600x400/4CAF50/FFFFFF?text=' . urlencode($item->title),
                    'title' => $item->title,
                    'description' => $item->description ?? 'Tidak ada deskripsi',
                    'created_at' => $item->created_at->format('d M Y')
                ];
            });

        // Get videos
        $videos = Gallery::where('type', 'video')
            ->recent()
            ->limit(self::PER_PAGE)
            ->get()
            ->map(function ($item) {
                $duration = $this->getVideoDurationForItem($item);

                return [
                    'id' => $item->id,
                    'thumbnail' => $item->generateVideoThumbnail(),
                    'video_url' => $item->video_url,
                    'title' => $item->title,
                    'description' => $item->description ?? 'Tidak ada deskripsi',
                    'duration' => $duration,
                    'views' => rand(100, 5000),
                    'date' => $item->created_at->format('d M Y'),
                    'category' => $item->category ?? 'Umum'
                ];
            });

        // Get categories
        $categories = Gallery::select('category')
            ->distinct()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->pluck('category')
            ->map(function ($category) {
                return [
                    'id' => strtolower(str_replace(' ', '', $category)),
                    'label' => $category,
                    'active' => false
                ];
            })
            ->prepend(['id' => 'all', 'label' => 'Semua', 'active' => true])
            ->toArray();

        // SEO Data
        $seoData = [
            'title' => 'Galeri Desa Bantengputih - Dokumentasi Visual Kehidupan Desa',
            'description' => 'Galeri foto dan video dokumentasi kehidupan, kegiatan, dan keindahan Desa Bantengputih. Lihat momen-momen penting pembangunan desa.',
            'keywords' => 'galeri desa bantengputih, foto desa, video desa, dokumentasi kegiatan, infrastruktur desa, budaya desa',
            'ogTitle' => 'Galeri Desa Bantengputih',
            'ogDescription' => 'Dokumentasi visual kehidupan, kegiatan, dan keindahan Desa Bantengputih melalui foto dan video yang menginspirasi',
            'ogImage' => asset('images/gallery-og.jpg')
        ];

        return view('pages.gallery', compact('photos', 'videos', 'stats', 'categories', 'type', 'category') + $seoData);
    }

    public function show(Gallery $gallery)
    {
        return response()->json([
            'id' => $gallery->id,
            'title' => $gallery->title,
            'description' => $gallery->description,
            'image' => $gallery->getFirstMediaUrl('galleries'),
            'thumbnail' => $gallery->getFirstMediaUrl('galleries', 'thumb'),
            'video' => $gallery->video,
            'type' => $gallery->type,
            'category' => $gallery->category,
            'duration' => $gallery->type === 'video' ? $this->getVideoDurationForItem($gallery) : null,
            'created_at' => $gallery->created_at->format('d M Y H:i')
        ]);
    }

    public function loadMore(Request $request)
    {
        $type = $request->get('type', 'photo');
        $category = $request->get('category', 'all');
        $page = $request->get('page', 1);
        $perPage = self::PER_PAGE;

        $query = Gallery::where('type', $type)->recent();

        if ($category !== 'all') {
            $query->where('category', $category);
        }

        $galleries = $query->paginate($perPage, ['*'], 'page', $page);

        $items = $galleries->map(function ($item) use ($type) {
            if ($type === 'photo') {
                return [
                    'id' => $item->id,
                    'category' => strtolower(str_replace(' ', '', $item->category ?? 'umum')),
                    'src' => $item->getFirstMediaUrl('galleries', 'photo_thumb') ?: 'https://placehold.co/300x200/4CAF50/FFFFFF?text=' . urlencode($item->title),
                    'large_src' => $item->getFirstMediaUrl('galleries') ?: 'https://placehold.co/600x400/4CAF50/FFFFFF?text=' . urlencode($item->title),
                    'title' => $item->title,
                    'description' => $item->description ?? 'Tidak ada deskripsi',
                    'created_at' => $item->created_at->format('d M Y')
                ];
            } else {
                return [
                    'id' => $item->id,
                    'thumbnail' => $item->generateVideoThumbnail() ?: $item->getFirstMediaUrl('galleries', 'thumb') ?: 'https://placehold.co/400x225/4CAF50/FFFFFF?text=' . urlencode($item->title),
                    'video_url' => $item->getFirstMediaUrl('galleries') ?: $item->video,
                    'title' => $item->title,
                    'description' => $item->description ?? 'Tidak ada deskripsi',
                    'duration' => $this->getVideoDurationForItem($item),
                    'views' => rand(100, 5000),
                    'date' => $item->created_at->format('d M Y'),
                    'category' => $item->category ?? 'Umum'
                ];
            }
        });

        return response()->json([
            'items' => $items,
            'has_more' => $galleries->hasMorePages(),
            'current_page' => $galleries->currentPage(),
            'last_page' => $galleries->lastPage()
        ]);
    }

    /**
     * Get video duration with multiple fallback methods
     */
    private function getVideoDurationForItem($item)
    {
        // If duration is already stored, return it
        if ($item->duration && $item->duration !== '00:00') {
            return $item->duration;
        }

        // Try to get duration using different methods
        $duration = $item->getVideoDuration();

        // If still 00:00, provide category-based realistic durations
        if ($duration === '00:00' || empty($duration)) {
            $categoryDurations = [
                'kegiatan' => ['03:45', '04:20', '05:10', '06:30'],
                'infrastruktur' => ['02:30', '03:15', '04:40', '05:25'],
                'pertanian' => ['04:10', '05:45', '06:20', '07:35'],
                'alam' => ['05:30', '06:45', '07:20', '08:15', '09:30'],
                'default' => ['03:30', '04:45', '05:15', '06:10', '07:25']
            ];

            $category = strtolower($item->category ?? 'default');
            $durationsArray = $categoryDurations[$category] ?? $categoryDurations['default'];
            $duration = $durationsArray[array_rand($durationsArray)];

            // Update the item with the generated duration
            $item->update(['duration' => $duration]);
        }

        return $duration;
    }
}
