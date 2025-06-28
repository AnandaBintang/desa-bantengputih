<?php

use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GuestUploadController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PopulationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransparencyController;
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

Route::get('/tentang', [AboutController::class, 'index'])->name('about');

Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/gallery/load-more', [GalleryController::class, 'loadMore'])->name('gallery.load-more');
Route::get('/galeri/{gallery}', [GalleryController::class, 'show'])->name('gallery.show');

// News routes
Route::get('/berita', [NewsController::class, 'index'])->name('news.index');
Route::get('/berita/load-more', [NewsController::class, 'loadMore'])->name('news.load-more');
Route::get('/berita/{news:slug}', [NewsController::class, 'show'])->name('news.show');

// Service routes
Route::get('/layanan', [ServiceController::class, 'index'])->name('services');
Route::get('/layanan/{document}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/layanan/{document}/preview', [ServiceController::class, 'preview'])->name('services.preview');
Route::get('/layanan/{document}/download', [ServiceController::class, 'download'])->name('services.download');

// Population routes
Route::get('/penduduk', [PopulationController::class, 'index'])->name('population');

Route::get('/produk', [ProductController::class, 'index'])->name('products.index');
Route::get('/produk/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('/kontak', [ContactController::class, 'index'])->name('contact');

// Complaint routes
Route::get('/pengaduan', [ComplaintController::class, 'create'])->name('complaints.create');
Route::post('/pengaduan', [ComplaintController::class, 'submit'])->name('complaints.submit');

Route::get('/transparansi', [TransparencyController::class, 'index'])->name('transparency');

// SEO Routes
Route::get('/sitemap.xml', function () {
    return response()->file(public_path('sitemap.xml'));
})->name('sitemap');

// Guest upload routes
Route::get('/upload', [GuestUploadController::class, 'showUploadForm'])->name('guest.upload');
Route::post('/upload', [GuestUploadController::class, 'submitUpload'])->name('guest.submit');

require __DIR__ . '/auth.php';
