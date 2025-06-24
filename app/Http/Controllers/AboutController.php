<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        // SEO Data
        $seoData = [
            'title' => 'Tentang Kami - Desa Bantengputih | Profil, Visi Misi & Pemerintahan',
            'description' => 'Mengenal lebih dekat sejarah, visi misi, struktur pemerintahan, dan peta wilayah Desa Bantengputih, Kecamatan Karanggeneng, Kabupaten Lamongan.',
            'keywords' => 'tentang desa bantengputih, sejarah desa, visi misi desa, struktur pemerintahan desa, kepala desa musthofa, karanggeneng lamongan',
            'ogTitle' => 'Tentang Desa Bantengputih - Sejarah, Visi Misi & Pemerintahan',
            'ogDescription' => 'Pelajari sejarah, visi misi, dan struktur pemerintahan Desa Bantengputih yang terus berkembang menuju kemajuan.',
            'ogImage' => asset('images/og-about.jpg'),
        ];

        // Village Profile Data
        $profileData = $this->getProfileData();
        $visionMissionData = $this->getVisionMissionData();
        $governmentData = $this->getGovernmentData();
        $mapData = $this->getMapData();

        return view('pages.about', array_merge(
            compact('profileData', 'visionMissionData', 'governmentData', 'mapData'),
            $seoData
        ));
    }

    private function getProfileData()
    {
        return [
            'history' => [
                'formation' => 'Terbentuknya Desa Bantengputih sebagai wilayah komunitas desa diyakini terjadi sebelum tahun 1923. Sebagai Desa Administratif (sebagai satuan pemerintahan terendah untuk memberikan pelayanan administrasi dari pusat) dimulai sebelum tahun 1940an yang dibuktikan dengan keberadaan para Kepala Desa yang telah menjabat dari masa ke masa.',
                'development' => 'Mulai tahun 1923 sudah ditemukan sebuah peta/tulisan yakni Peta Krawangan yang telah menyebutkan Bantengputih sebagai Desa yang merupakan bagian wilayah kawedanan Sukodadi. Sejarah pembangunan untuk kesejahteraan masyarakat Bantengputih semenjak jaman reformasi dimulai maka banyak pembangunan yang telah dilaksanakan, termasuk sebagai pelaksana Program Pengembangan Kecamatan dari tahun 2003 sampai 2007 yang dilanjutkan dengan Program Nasional Pemberdayaan Masyarakat (PNPM).'
            ],
            'legends' => [
                'version1' => 'Dahulu ada seekor banteng liar yang berkeliaran di wilayah ini dan suka merusak tanaman. Warga berusaha menangkapnya di tempat lapang (setro) yang sekarang ada di wilayah Dusun Setrobanteng. Banteng ini berlari ke arah timur meninggalkan jejak (Kolo) berwarna putih yang sekarang menjadi wilayah Dusun Koloputih, kemudian berlari ke selatan dan tertangkap. Masyarakat senang dengan penangkapan tersebut sehingga wilayah dimana banteng tertangkap diberi nama Dusun Bekanang (Bek = Penuh, Menang = Kemenangan).',
                'version2' => 'Sudah sejak dulu di wilayah ini ada pemukiman yang asal usul nenek moyangnya dari daerah berbeda yakni Dusun Bekanang, Dusun Koloputih dan Dusun Setrobanteng. Karena pemukiman ini terlalu kecil untuk menjadi desa, pemerintahan kolonial Belanda menggabungkannya menjadi sebuah desa bernama Bantengputih (gabungan nama Setrobanteng dan Koloputih).'
            ],
            'village_heads' => [
                ['no' => 1, 'name' => 'SANDIYO', 'period' => '....... - 1946'],
                ['no' => 2, 'name' => 'SAHID', 'period' => '1946 - 1955'],
                ['no' => 3, 'name' => 'MUSELAR', 'period' => '1955 - 1989'],
                ['no' => 4, 'name' => 'MUJIANTO', 'period' => '1989 - 1998'],
                ['no' => 5, 'name' => 'ISA ANSHORI', 'period' => '1998 - 2007'],
                ['no' => 6, 'name' => 'MUSTHOFA', 'period' => '2007 - 2027'],
            ]
        ];
    }

    private function getVisionMissionData()
    {
        return [
            'vision' => 'TERWUJUDNYA DESA BANTENGPUTIH MENJADI DESA MANDIRI YANG SEJAHTERA',
            'motto' => 'MANDES (Mandiri dan Sejahtera)',
            'vision_meaning' => [
                'mandiri' => 'Desa yang mempunyai ketersediaan dan akses terhadap pelayanan dasar yang mencukupi, infrastruktur yang memadai, aksesibilitas/transportasi yang tidak sulit, pelayanan umum yang bagus, serta penyelenggaraan pemerintahan yang sudah sangat baik.',
                'sejahtera' => 'Tercapainya ketercukupan kebutuhan masyarakat secara lahir dan batin baik sandang, pangan, papan, agama, pendidikan, kesehatan, rasa aman dan tentram.'
            ],
            'current_status' => [
                'status' => 'Desa Berkembang',
                'idm' => '0,6502',
                'target' => 'Desa Mandiri (IDM > 0,8155)'
            ],
            'missions' => [
                'Meningkatnya penyelenggaraan tatakelola pemerintahan yang transparan dan akuntabel',
                'Meningkatkan kualitas pelayanan publik',
                'Meningkatkan infrastruktur Desa',
                'Meningkatkan perekonomian berbasis kerakyatan',
                'Meningkatkan pelestarian adat, agama, dan seni budaya',
                'Meningkatkan pemberdayaan Masyarakat',
                'Melestarikan sumber daya alam dan lingkungan hidup',
                'Meningkatkan interaksi antar lembaga yang ada di desa baik lembaga formal dan non formal'
            ],
            'indicators' => [
                'Terhapusnya kemiskinan masyarakat secara tuntas',
                'Terhapusnya kelaparan bagi masyarakat secara tuntas',
                'Tercapainya ketahanan pangan dan gizi yang baik',
                'Terjaminnya kehidupan yang sehat dan meningkatnya kesejahteraan',
                'Terjaminnya pendidikan yang berkualitas, inklusif dan merata',
                'Terpenuhinya kesetaraan gender dan pemberdayaan perempuan',
                'Terjadinya pertumbuhan ekonomi yang inklusif dan berkelanjutan',
                'Terjaminnya ketersediaan air bersih dan sanitasi berkelanjutan',
                'Tersedianya infrastruktur yang memadai',
                'Terselenggaranya layanan umum sesuai kebutuhan masyarakat',
                'Terwujudnya masyarakat yang inklusif dan damai',
                'Terbangunnya Kelembagaan Desa yang efektif, akuntabel dan inklusif'
            ]
        ];
    }

    private function getGovernmentData()
    {
        return [
            'structure' => [
                'kepala_desa' => [
                    'name' => 'MUSTHOFA',
                    'period' => '2007 - 2027',
                    'photo' => 'https://placehold.co/80x80/FFFFFF/4CAF50?text=KD'
                ],
                'sekretaris_desa' => [
                    'name' => 'AHMAD ASRORI',
                    'position' => 'Sekretaris Desa',
                    'photo' => 'https://placehold.co/80x80/4CAF50/FFFFFF?text=SD'
                ],
                'kepala_seksi' => [
                    [
                        'position' => 'KASI PEMERINTAHAN',
                        'name' => '',
                        'description' => 'Administrasi Pemerintahan',
                        'photo' => 'https://placehold.co/60x60/4CAF50/FFFFFF?text=KP'
                    ],
                    [
                        'position' => 'KASI KESEJAHTERAAN',
                        'name' => 'FITRIA ISTIFARINI',
                        'description' => 'Program Kesejahteraan',
                        'photo' => 'https://placehold.co/60x60/4CAF50/FFFFFF?text=KK'
                    ],
                    [
                        'position' => 'KASI PELAYANAN',
                        'name' => '',
                        'description' => 'Pelayanan Publik',
                        'photo' => 'https://placehold.co/60x60/4CAF50/FFFFFF?text=KL'
                    ]
                ],
                'kepala_urusan' => [
                    [
                        'position' => 'KAUR TATA USAHA',
                        'name' => '',
                        'description' => 'Administrasi & Umum',
                        'photo' => 'https://placehold.co/60x60/4CAF50/FFFFFF?text=TU'
                    ],
                    [
                        'position' => 'KAUR KEUANGAN',
                        'name' => 'MUHAJIR',
                        'description' => 'Keuangan & Anggaran',
                        'photo' => 'https://placehold.co/60x60/4CAF50/FFFFFF?text=KU'
                    ],
                    [
                        'position' => 'KAUR PERENCANAAN',
                        'name' => '',
                        'description' => 'Perencanaan Pembangunan',
                        'photo' => 'https://placehold.co/60x60/4CAF50/FFFFFF?text=PR'
                    ]
                ],
                'kepala_dusun' => [
                    [
                        'position' => 'KADUS BEKANANG',
                        'name' => '',
                        'dusun' => 'Dusun Bekanang',
                        'photo' => 'https://placehold.co/70x70/4CAF50/FFFFFF?text=D1'
                    ],
                    [
                        'position' => 'KADUS KOLOPUTIH',
                        'name' => '',
                        'dusun' => 'Dusun Koloputih',
                        'photo' => 'https://placehold.co/70x70/4CAF50/FFFFFF?text=D2'
                    ],
                    [
                        'position' => 'KADUS SETROBANTENG',
                        'name' => 'TAUFIQ',
                        'dusun' => 'Dusun Setrobanteng',
                        'photo' => 'https://placehold.co/70x70/4CAF50/FFFFFF?text=D3'
                    ]
                ]
            ]
        ];
    }

    private function getMapData()
    {
        return [
            'coordinates' => [
                'latitude' => "7°01'29.07''",
                'longitude' => "112°18'30.35''"
            ],
            'boundaries' => [
                'north' => 'Desa Karangrejo Kec. Karanggeneng',
                'east' => 'Desa Guci & Desa Latukan Kec. Karanggeneng',
                'south' => 'Desa Ngayung Kec. Maduran',
                'west' => 'Desa Gumantuk, Kanugrahan, Turi Banjaran Kec. Maduran'
            ],
            'geography' => [
                'topography' => 'Dataran Rendah',
                'altitude' => '± 25 mdpl',
                'climate' => 'Tropis',
                'district' => 'Karanggeneng',
                'regency' => 'Lamongan'
            ],
            'area' => [
                'total' => '179,01 Ha',
                'rice_field' => '160,90 Ha',
                'non_rice_field' => '18,11 Ha',
                'breakdown' => [
                    'irrigation_technical' => '- Ha',
                    'irrigation_semi_technical' => '160,90 Ha',
                    'rain_fed' => '- Ha',
                    'residential' => '15,05 Ha',
                    'others' => '3,06 Ha'
                ]
            ],
            'administrative_division' => [
                'dusun' => 3,
                'rw' => 3,
                'rt' => 9,
                'detail' => [
                    ['dusun' => 'Bekanang', 'rw' => 1, 'rt' => 3],
                    ['dusun' => 'Koloputih', 'rw' => 1, 'rt' => 4],
                    ['dusun' => 'Setrobanteng', 'rw' => 1, 'rt' => 2]
                ]
            ]
        ];
    }
}
