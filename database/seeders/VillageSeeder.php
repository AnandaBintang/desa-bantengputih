<?php

namespace Database\Seeders;

use App\Models\Village;
use Illuminate\Database\Seeder;

class VillageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Village::create([
            'name' => 'Desa Bantengputih',
            'description' => 'Desa Bantengputih adalah desa yang terletak di Kecamatan Karanggeneng, Kabupaten Lamongan, Provinsi Jawa Timur. Desa ini memiliki visi untuk menjadi desa yang maju, mandiri, dan sejahtera untuk seluruh warga.',
            'logo' => null,
            'address' => 'Desa Bantengputih, Kecamatan Karanggeneng, Kabupaten Lamongan, Provinsi Jawa Timur',
            'phone' => '6281331931077',
            'email' => 'info@bantengputih.com',
            'website' => 'https://bantengputih.lamongan.go.id',
        ]);
    }
}
