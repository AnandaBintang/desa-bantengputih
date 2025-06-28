<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // SEO Data
        $seoData = [
            'title' => 'Beranda - Desa Bantengputih | Kecamatan Karanggeneng Kabupaten Lamongan',
            'description' => 'Website resmi Desa Bantengputih, Kecamatan Karanggeneng, Kabupaten Lamongan. Layanan publik, berita terkini, produk unggulan, dan informasi transparansi pemerintahan desa.',
            'keywords' => 'desa bantengputih, karanggeneng lamongan, pemerintah desa, pelayanan publik, berita desa, produk unggulan, transparansi desa, jawa timur, website desa',
            'ogTitle' => 'Desa Bantengputih - Desa Maju, Mandiri, dan Sejahtera',
            'ogDescription' => 'Selamat datang di website resmi Desa Bantengputih. Dapatkan informasi layanan publik, berita terbaru, dan produk unggulan desa.',
            'ogImage' => asset('images/og-home.jpg'),
        ];

        // Hero slides data
        $heroSlides = [
            [
                'image' => asset('images/hero-pemandangan.jpg'),
                'fallback' => 'https://placehold.co/1920x1080/4CAF50/FFFFFF?text=Pemandangan+Desa+Bantengputih',
                'alt' => 'Pemandangan Desa Bantengputih',
                'title' => 'Selamat Datang di Desa Bantengputih',
                'subtitle' => 'Desa yang maju, mandiri, dan sejahtera untuk seluruh warga',
                'buttons' => [
                    [
                        'url' => route('about'),
                        'text' => 'Tentang Kami',
                        'icon' => 'fas fa-info-circle',
                        'class' => 'hero-btn-primary'
                    ],
                    [
                        'url' => route('contact'),
                        'text' => 'Hubungi Kami',
                        'icon' => 'fas fa-phone',
                        'class' => 'hero-btn-outline'
                    ]
                ]
            ],
            [
                'image' => asset('images/hero-gotong-royong.jpg'),
                'fallback' => 'https://placehold.co/1920x1080/4CAF50/FFFFFF?text=Gotong+Royong+Warga',
                'alt' => 'Kegiatan Gotong Royong Warga',
                'title' => 'Gotong Royong Membangun Desa',
                'subtitle' => 'Bersama-sama membangun desa yang lebih baik untuk masa depan yang cerah',
                'buttons' => [
                    [
                        'url' => route('news.index'),
                        'text' => 'Lihat Kegiatan',
                        'icon' => 'fas fa-newspaper',
                        'class' => 'hero-btn-primary'
                    ],
                    [
                        'url' => route('gallery'),
                        'text' => 'Galeri Foto',
                        'icon' => 'fas fa-images',
                        'class' => 'hero-btn-outline'
                    ]
                ]
            ],
            [
                'image' => asset('images/hero-produk.png'),
                'fallback' => 'https://placehold.co/1920x1080/4CAF50/FFFFFF?text=Produk+Unggulan+Desa',
                'alt' => 'Produk Unggulan Desa',
                'title' => 'Produk Unggulan Desa',
                'subtitle' => 'Berbagai produk berkualitas tinggi dari hasil karya warga desa',
                'buttons' => [
                    [
                        'url' => route('products.index'),
                        'text' => 'Lihat Produk',
                        'icon' => 'fas fa-shopping-basket',
                        'class' => 'hero-btn-primary'
                    ],
                    [
                        'url' => route('contact'),
                        'text' => 'Pesan Sekarang',
                        'icon' => 'fas fa-shopping-cart',
                        'class' => 'hero-btn-outline'
                    ]
                ]
            ]
        ];

        // Village statistics
        $stats = [
            [
                'icon' => 'fas fa-users',
                'value' => 1526,
                'label' => 'Jumlah Penduduk'
            ],
            [
                'icon' => 'fas fa-home',
                'value' => 3,
                'label' => 'Dusun'
            ],
            [
                'icon' => 'fas fa-map',
                'value' => 179.01,
                'label' => 'Luas Wilayah (Ha)'
            ],
            [
                'icon' => 'fas fa-users-cog',
                'value' => 9,
                'label' => 'RT'
            ]
        ];

        // Mock news data
        $latestNews = News::latest()->take(3)->get()->map(function ($news) {
            $media = $news->getFirstMedia('news');
            $news->media_url = $media ? $media->getUrl() : null;
            return $news;
        });

        return view('pages.home', array_merge(compact('heroSlides', 'stats', 'latestNews'), $seoData));
    }
}
