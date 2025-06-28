<?php

namespace App\Http\Controllers;

use App\Models\Document;

class TransparencyController extends Controller
{
    public function index()
    {
        $types = [
            'Peraturan Desa',
            'Keputusan Kepala Desa',
            'Program & Kegiatan',
            'Laporan',
        ];

        $documentsByType = [];
        foreach ($types as $type) {
            $documentsByType[$type] = Document::where('type', $type)->published()->orderByDesc('uploaded_at')->limit(9)->get();
        }

        $typeIcons = [
            'Peraturan Desa' => '<i class="fas fa-gavel mr-2"></i>',
            'Keputusan Kepala Desa' => '<i class="fas fa-stamp mr-2"></i>',
            'Program & Kegiatan' => '<i class="fas fa-tasks mr-2"></i>',
            'Laporan' => '<i class="fas fa-chart-bar mr-2"></i>',
        ];
        $typeBg = [
            'Peraturan Desa' => 'bg-red-100',
            'Keputusan Kepala Desa' => 'bg-purple-100',
            'Program & Kegiatan' => 'bg-orange-100',
            'Laporan' => 'bg-blue-100',
        ];

        $stats = [
            'total_documents' => Document::published()->count(),
            'accountability' => 98,
            'total_downloads' => 2500,
            'current_period' => now()->year,
        ];

        $faqs = [
            [
                'q' => 'Bagaimana cara mengakses dokumen yang tidak tersedia online?',
                'a' => 'Anda dapat mengajukan permintaan informasi melalui surat resmi ke kantor desa atau menggunakan formulir online yang tersedia. Kami akan merespons dalam 14 hari kerja sesuai ketentuan UU Keterbukaan Informasi Publik.',
            ],
            [
                'q' => 'Apakah ada biaya untuk mengakses dokumen?',
                'a' => 'Akses online gratis untuk semua dokumen. Untuk salinan fisik dokumen tertentu mungkin dikenakan biaya administratif sesuai dengan ketentuan yang berlaku. Informasi wajib setor selalu gratis.',
            ],
            [
                'q' => 'Seberapa sering dokumen di-update?',
                'a' => 'Dokumen diperbarui secara berkala sesuai dengan siklus pelaporan. Dokumen anggaran dan keuangan diupdate setiap bulan, sedangkan laporan tahunan diperbarui setiap akhir tahun.',
            ],
            [
                'q' => 'Bagaimana cara melaporkan jika ada informasi yang tidak akurat?',
                'a' => 'Anda dapat melaporkan melalui halaman pengaduan online atau menghubungi langsung kantor desa. Kami akan melakukan verifikasi dan koreksi jika diperlukan dalam waktu 7 hari kerja.',
            ],
        ];

        return view('pages.transparency.index', [
            'types' => $types,
            'documentsByType' => $documentsByType,
            'typeIcons' => $typeIcons,
            'typeBg' => $typeBg,
            'stats' => $stats,
            'faqs' => $faqs,
        ]);
    }
}
