<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DocumentController extends Controller
{
    public function preview(Document $document)
    {
        if (!$document->file) {
            abort(404, 'File path tidak ditemukan di database');
        }

        $filePath = $document->file;

        if (str_starts_with($filePath, 'storage/')) {
            $filePath = str_replace('storage/', '', $filePath);
        }

        if (str_starts_with($filePath, 'public/')) {
            $filePath = str_replace('public/', '', $filePath);
        }


        if (!Storage::disk('public')->exists($filePath)) {
            if (!Storage::exists($document->file)) {
                Log::error('File not found: ' . $document->file);
                abort(404, 'File tidak ditemukan: ' . $document->file);
            }
            $diskToUse = 'local';
            $pathToUse = $document->file;
        } else {
            $diskToUse = 'public';
            $pathToUse = $filePath;
        }

        $fullPath = Storage::disk($diskToUse)->path($pathToUse);
        $mimeType = Storage::disk($diskToUse)->mimeType($pathToUse);

        if ($mimeType !== 'application/pdf') {
            return redirect()->route('document.download', $document);
        }

        return response()->file($fullPath, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . basename($pathToUse) . '"'
        ]);
    }

    public function download(Document $document)
    {
        if (!$document->file) {
            abort(404, 'File path tidak ditemukan di database');
        }

        $filePath = $document->file;

        if (str_starts_with($filePath, 'storage/')) {
            $filePath = str_replace('storage/', '', $filePath);
        }

        if (str_starts_with($filePath, 'public/')) {
            $filePath = str_replace('public/', '', $filePath);
        }

        if (Storage::disk('public')->exists($filePath)) {
            return Storage::disk('public')->download($filePath, $document->title . '.' . pathinfo($filePath, PATHINFO_EXTENSION));
        } elseif (Storage::exists($document->file)) {
            return Storage::download($document->file, $document->title . '.' . pathinfo($document->file, PATHINFO_EXTENSION));
        }

        abort(404, 'File tidak ditemukan');
    }
}
