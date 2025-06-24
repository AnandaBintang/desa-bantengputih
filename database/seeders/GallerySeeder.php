<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run()
    {
        // Create sample photos
        Gallery::create([
            'title' => 'Kegiatan Gotong Royong Desa',
            'description' => 'Warga desa bergotong royong membersihkan lingkungan',
            'category' => 'Kegiatan',
            'type' => 'photo'
        ]);

        Gallery::create([
            'title' => 'Panen Padi Musim Kemarau',
            'description' => 'Petani memanen padi di sawah desa',
            'category' => 'Pertanian',
            'type' => 'photo'
        ]);

        Gallery::create([
            'title' => 'Pembangunan Jalan Desa',
            'description' => 'Proses pembangunan infrastruktur jalan',
            'category' => 'Infrastruktur',
            'type' => 'photo'
        ]);

        // Create sample videos
        Gallery::create([
            'title' => 'Profil Desa Bantengputih',
            'description' => 'Video profil lengkap desa',
            'category' => 'Profil',
            'type' => 'video',
            'video' => 'https://example.com/video1.mp4'
        ]);

        Gallery::create([
            'title' => 'Festival Budaya Desa',
            'description' => 'Dokumentasi festival budaya tahunan',
            'category' => 'Budaya',
            'type' => 'video',
            'video' => 'https://example.com/video2.mp4'
        ]);
    }
}
