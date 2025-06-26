<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        // Get documents by type for different sections
        $peraturanDesa = Document::where('type', 'Peraturan Desa')
            ->recent()
            ->get()
            ->map(function ($document) {
                $document->setAttribute('file_size', $document->file && Storage::disk('public')->exists($document->file)
                    ? Storage::disk('public')->size($document->file)
                    : 0);
                return $document;
            });

        $keputusanKades = Document::where('type', 'Keputusan Kepala Desa')
            ->recent()
            ->get()
            ->map(function ($document) {
                $document->setAttribute('file_size', $document->file && Storage::disk('public')->exists($document->file)
                    ? Storage::disk('public')->size($document->file)
                    : 0);
                return $document;
            });

        return view('pages.services.index', compact(
            'peraturanDesa',
            'keputusanKades',
        ));
    }

    public function show(Document $document)
    {
        // Check if document file exists
        if (!$document->file || !Storage::exists($document->file)) {
            abort(404, 'Dokumen tidak ditemukan');
        }

        return view('pages.services.show', compact('document'));
    }

    public function preview(Document $document)
    {
        // Check if document file exists
        if (!$document->file || !Storage::disk('public')->exists($document->file)) {
            abort(404, 'Dokumen tidak ditemukan');
        }

        // Only allow preview for PDF files
        if (!$document->isPdf()) {
            return $this->download($document);
        }

        $filePath = Storage::disk('public')->path($document->file);

        return response()->file($filePath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $document->title . '.pdf"'
        ]);
    }

    public function download(Document $document)
    {
        // Check if document file exists
        if (!$document->file || !Storage::disk('public')->exists($document->file)) {
            abort(404, 'Dokumen tidak ditemukan');
        }

        $filePath = Storage::disk('public')->path($document->file);
        $fileName = $document->title . '.' . $document->file_extension;

        return response()->download($filePath, $fileName);
    }
}
