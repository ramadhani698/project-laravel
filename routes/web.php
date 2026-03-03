<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CarouselController as AdminCarouselController;
use App\Http\Controllers\Admin\KeunggulanController as AdminKeunggulanController;
use App\Http\Controllers\Admin\JurusanController as AdminJurusanController;
use App\Http\Controllers\Admin\StatistikController as AdminStatistikController;
use App\Http\Controllers\Admin\JurusanHeadController;
use App\Http\Controllers\Admin\JurusanVisiMisiController;
use App\Http\Controllers\Admin\JurusanGalleryController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\SchoolHistoryController as AdminSchoolHistoryController;
use App\Http\Controllers\Admin\VisionController as AdminVisionController;
use App\Http\Controllers\Admin\PrincipalMessageController as AdminPrincipalMessageController;
use App\Http\Controllers\Admin\SarprasController as AdminSarprasController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\PrestasiController as AdminPrestasiController;
use App\Http\Controllers\JurusanController as FrontendJurusanController;
use App\Http\Controllers\BeritaController as FrontendBeritaController;
use App\Http\Controllers\ProfilController as FrontendProfilController;
use App\Http\Controllers\InformasiController as FrontendInformasiController;
use App\Http\Controllers\PrestasiController as FrontendPrestasiController;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Route::get('/jurusan/tkj', function () {
    return view('frontend.jurusan.tkj');
});

Route::get('/jurusan/dkv', function () {
    return view('frontend.jurusan.dkv');
});

Route::get('/jurusan/mplb', function () {
    return view('frontend.jurusan.mplb');
});

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // crud carousel
        Route::resource('carousel', AdminCarouselController::class);

        // crud keunggulan
        Route::resource('keunggulan', AdminKeunggulanController::class);

        // crud statistik
        Route::resource('statistik', AdminStatistikController::class);

        // crud jurusan
        Route::resource('jurusan', AdminJurusanController::class);

        // kepala kompetensi (child)
        Route::put(
            'jurusan/{jurusan}/head',
            [JurusanHeadController::class, 'update']
        )->name('jurusan.head.update');

        // visi misi (child)
        Route::put(
            'jurusan/{jurusan}/visi-misi',
            [JurusanVisiMisiController::class, 'update']
        )->name('jurusan.visi-misi.update');

        // gallery (child)
        Route::post(
            'jurusan/{jurusan}/gallery',
            [JurusanGalleryController::class, 'store']
        )->name('jurusan.gallery.store');

        Route::delete(
            'jurusan/gallery/{gallery}',
            [JurusanGalleryController::class, 'destroy']
        )->name('jurusan.gallery.destroy');

        // crud berita
        Route::resource('berita', AdminBeritaController::class);

        // crud sejarah sekolah
        Route::resource('histories', AdminSchoolHistoryController::class);

        // crud visi misi
        Route::resource('vision', AdminVisionController::class);

        // crud principal message
        Route::resource('principal-message', AdminPrincipalMessageController::class);

        // crud sarpras
        Route::resource('sarpras', AdminSarprasController::class);

        // crud gallery
        Route::resource('gallery', AdminGalleryController::class);

        // crud prestasi
        Route::resource('prestasi', AdminPrestasiController::class);
    });

Route::get('/profil/sejarah', [FrontendProfilController::class, 'sejarah'])
->name('profil.sejarah');

Route::get('/profil/visi-misi', [FrontendProfilController::class, 'visiMisi'])
->name('profil.visi-misi');

Route::get('/profil/kata-kepsek', [FrontendProfilController::class, 'kataKepsek'])
->name('profil.kata-kepsek');

Route::get('jurusan/{slug}', [FrontendJurusanController::class, 'show'])
->name('jurusan.show');

Route::get('/informasi/berita', [FrontendBeritaController::class, 'index'])
->name('berita.index');

Route::get('berita/{slug}', [FrontendBeritaController::class, 'show'])
->name('berita.show');

Route::get('/informasi/sarpras',[FrontendInformasiController::class, 'sarpras'])
->name('informasi.sarpras');

Route::get('/informasi/gallery', [FrontendInformasiController::class, 'gallery'])
->name('informasi.gallery');

Route::get('/prestasi', [FrontendPrestasiController::class, 'index'])
->name('prestasi.index');

Route::get('/dashboard', [AdminDashboardController::class, 'index'])
->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::middleware(['auth'])->group(function () {
//     Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
// });


require __DIR__.'/auth.php';
