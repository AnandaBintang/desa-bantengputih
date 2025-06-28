<?php

namespace App\Http\Controllers;

use App\Models\Document;

class TransparencyController extends Controller
{
    public function index()
    {
        $categories = Document::select('category')->distinct()->pluck('category')->toArray();

        $documentsByCategory = [];
        foreach ($categories as $cat) {
            $documentsByCategory[$cat] = Document::byCategory($cat)->published()->orderByDesc('uploaded_at')->limit(9)->get();
        }

        $categoryIcons = [
            'anggaran' => '<i class="fas fa-money-bill-wave mr-2"></i>',
            'peraturan' => '<i class="fas fa-gavel mr-2"></i>',
            'program' => '<i class="fas fa-tasks mr-2"></i>',
            'laporan' => '<i class="fas fa-chart-bar mr-2"></i>',
        ];
        $categoryBg = [
            'anggaran' => 'bg-green-100',
            'peraturan' => 'bg-red-100',
            'program' => 'bg-orange-100',
            'laporan' => 'bg-blue-100',
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

        return view('pages.transparency.index', compact(
            'categories',
            'documentsByCategory',
            'categoryIcons',
            'categoryBg',
            'stats',
            'faqs'
        ));
    }
}
