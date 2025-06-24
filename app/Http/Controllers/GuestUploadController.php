<?php

namespace App\Http\Controllers;

use App\Models\GuestSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GuestUploadController extends Controller
{
    public function showUploadForm(Request $request)
    {
        $selectedType = $request->get('type'); // Get type from URL parameter

        return view('pages/upload-submission', compact('selectedType'));
    }

    public function submitUpload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'type' => 'required|in:photo,video',
            'category' => 'required|in:Kegiatan,Infrastruktur,Alam,Budaya',
            'file' => [
                'required',
                'file',
                function ($attribute, $value, $fail) use ($request) {
                    $type = $request->input('type');

                    if ($type === 'photo') {
                        if (!in_array($value->getMimeType(), ['image/jpeg', 'image/png', 'image/gif', 'image/webp'])) {
                            $fail('File harus berupa gambar (JPG, PNG, GIF, WEBP).');
                        }
                        if ($value->getSize() > 10485760) { // 10MB
                            $fail('Ukuran file gambar maksimal 10MB.');
                        }
                    } elseif ($type === 'video') {
                        if (!in_array($value->getMimeType(), ['video/mp4', 'video/webm', 'video/quicktime', 'video/x-msvideo', 'video/x-ms-wmv'])) {
                            $fail('File harus berupa video (MP4, WEBM, MOV, AVI, WMV).');
                        }
                        if ($value->getSize() > 209715200) { // 200MB
                            $fail('Ukuran file video maksimal 200MB.');
                        }
                    }
                },
            ],
            'terms' => 'required|accepted',
        ], [
            'name.required' => 'Nama lengkap harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'title.required' => 'Judul harus diisi.',
            'type.required' => 'Jenis konten harus dipilih.',
            'category.required' => 'Kategori harus dipilih.',
            'file.required' => 'File harus diupload.',
            'terms.required' => 'Anda harus menyetujui syarat dan ketentuan.',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $file = $request->file('file');
            $type = $request->input('type');

            // Generate unique filename
            $filename = time() . '_' . $file->getClientOriginalName();

            // Store file
            $directory = $type === 'photo' ? 'guest-submissions/photos' : 'guest-submissions/videos';
            $filePath = $file->storeAs($directory, $filename, 'public');

            // Create submission record
            GuestSubmission::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'type' => $type,
                'category' => $request->input('category'),
                'file_path' => $filePath,
                'file_name' => $filename,
                'file_size' => $file->getSize(),
                'file_type' => $file->getMimeType(),
                'status' => 'pending',
            ]);

            // Success message based on type
            $message = $type === 'photo'
                ? 'Terima kasih! Foto Anda telah berhasil dikirim dan akan direview oleh admin.'
                : 'Terima kasih! Video Anda telah berhasil dikirim dan akan direview oleh admin.';

            return redirect()
                ->route('guest.upload')
                ->with('success', $message);
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat mengupload file. Silakan coba lagi.' . ' Error: ' . $e->getMessage());
        }
    }
}
