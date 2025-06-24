<?php

use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Public routes
Route::get('/documents/{document}/preview', [DocumentController::class, 'preview'])->name('document.preview');
Route::get('/documents/{document}/download', [DocumentController::class, 'download'])->name('document.download');

Route::get('/tentang', function () {
    return view('pages.about');
})->name('about');

Route::get('/galeri', function () {
    return view('pages.gallery');
})->name('gallery');

Route::get('/berita', function () {
    return view('pages.news.index');
})->name('news.index');

// Static news detail route
Route::get('/berita/{slug}', function ($slug) {
    return view('pages.news.show', ['slug' => $slug]);
})->name('news.show');

Route::get('/produk', function () {
    return view('pages.products.index');
})->name('products.index');

Route::get('/kontak', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/layanan', function () {
    return view('pages.services');
})->name('services');

Route::get('/pengaduan', function () {
    return view('pages.complaints.create');
})->name('complaints.create');

Route::get('/transparansi', function () {
    return view('pages.transparency');
})->name('transparency');

// SEO Routes
Route::get('/sitemap.xml', function () {
    return response()->file(public_path('sitemap.xml'));
})->name('sitemap');

require __DIR__ . '/auth.php';
