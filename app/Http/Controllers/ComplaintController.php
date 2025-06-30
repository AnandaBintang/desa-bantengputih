<?php

namespace App\Http\Controllers;

use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComplaintController extends Controller
{
    public function create()
    {
        return view('pages.complaints.create');
    }

    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'nullable|string|max:255',
            'kategori' => 'required|string',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ], [
            'kategori.required' => 'Kategori pengaduan harus dipilih',
            'judul.required' => 'Judul pengaduan harus diisi',
            'isi.required' => 'Isi pengaduan harus diisi',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $message = $this->formatWhatsAppMessage($request->all());

        $whatsappNumber = Village::first()->phone ?? '6281331931077';

        $whatsappUrl = "https://wa.me/{$whatsappNumber}?text=" . urlencode($message);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'whatsapp_url' => $whatsappUrl
            ]);
        }

        return redirect()->away($whatsappUrl);
    }

    private function formatWhatsAppMessage(array $data): string
    {
        $message = "📢 PENGADUAN ONLINE DESA BANTENGPUTIH\n\n";
        $message .= "📋 DETAIL PENGADUAN:\n";
        $message .= "━━━━━━━━━━━━━━━━━━━━━━\n\n";

        $nama = !empty($data['nama']) && trim($data['nama']) !== '' ? $data['nama'] : 'Anonim';

        $message .= "👤 Nama: {$nama}\n";
        $message .= "📂 Kategori: " . ucfirst($data['kategori']) . "\n";
        $message .= "📌 Judul: {$data['judul']}\n\n";

        $message .= "📝 Isi Pengaduan:\n";
        $message .= "{$data['isi']}\n\n";

        $message .= "━━━━━━━━━━━━━━━━━━━━━━\n";
        $message .= "🕐 Dikirim pada: " . now()->setTimezone('Asia/Jakarta')->translatedFormat('d F Y') . " pukul " . now()->setTimezone('Asia/Jakarta')->format('H:i') . " WIB\n";
        $message .= "🌐 Melalui: Website Resmi Desa Bantengputih";

        return $message;
    }
}
