<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CarouselController;
use App\Http\Controllers\Admin\JurusanController as AdminJurusanController;
use App\Http\Controllers\Admin\JurusanHeadController;
use App\Http\Controllers\Admin\JurusanVisiMisiController;
use App\Http\Controllers\Admin\JurusanGalleryController;
use App\Http\Controllers\JurusanController as FrontendJurusanController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\BeritaController as FrontendBeritaController;
use App\Http\Controllers\Admin\SchoolHistoryController as AdminSchoolHistoryController;
use App\Http\Controllers\ProfilController as FrontendProfilController;
use App\Http\Controllers\Admin\VisionController as AdminVisionController;
use App\Http\Controllers\Admin\PrincipalMessageController as AdminPrincipalMessageController;
use App\Http\Controllers\Admin\SarprasController as AdminSarprasController;
use App\Http\Controllers\InformasiController as FrontendInformasiController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

// Route::prefix('profil')->name('profil.')->group(function () {
//     Route::get('/sejarah', function () {
//         return view('frontend.profil.sejarah');
//     })->name('sejarah');
// });

// Route::get('/profil/visi-misi', function () {
//     return view('frontend.profil.visi-misi');
// });

// Route::get('/profil/kata-kepsek', function () {
//     return view('frontend.profil.kata-kepsek');
// });

Route::get('/jurusan/tkj', function () {
    return view('frontend.jurusan.tkj');
});

Route::get('/jurusan/dkv', function () {
    return view('frontend.jurusan.dkv');
});

Route::get('/jurusan/mplb', function () {
    return view('frontend.jurusan.mplb');
});

// Route::get('/informasi/berita', function () {
//     return view('frontend.informasi.berita');
// });

// Route::get('/informasi/sarpras', function () {
//     return view('frontend.informasi.sarpras');
// });

Route::get('/informasi/galeri', function () {
    return view('frontend.informasi.galeri');
});

Route::get('/prestasi', function () {
    return view('frontend.prestasi');
});

Route::middleware('auth')
    ->prefix('admin')
    ->group(function () {
        Route::get('/carousel', 
            [\App\Http\Controllers\Admin\CarouselController::class, 'index']
        )->name('admin.carousel.index');
        
        Route::get('/carousel/create',
            [\App\Http\Controllers\Admin\CarouselController::class, 'create']
        )->name('admin.carousel.create');

        Route::post('/carousel',
            [\App\Http\Controllers\Admin\CarouselController::class, 'store']
        )->name('admin.carousel.store');

        Route::get('/carousel/{id}/edit',
            [App\Http\Controllers\Admin\CarouselController::class, 'edit']
        )->name('admin.carousel.edit');
        
        Route::put('/carousel/{id}',
            [App\Http\Controllers\Admin\CarouselController::class, 'update']
        )->name('admin.carousel.update');

        Route::delete('/carousel/{id}',
            [App\Http\Controllers\Admin\CarouselController::class, 'destroy']
        )->name('admin.carousel.destroy');
    });

Route::middleware('auth')
    ->prefix('admin')
    ->group(function () {
        Route::get('/keunggulan',
            [App\Http\Controllers\Admin\KeunggulanController::class, 'index']
        )->name('admin.keunggulan.index');

        Route::get('/keunggulan/create',
            [App\Http\Controllers\Admin\KeunggulanController::class, 'create']
        )->name('admin.keunggulan.create');

        Route::post('/keunggulan',
            [App\Http\Controllers\Admin\KeunggulanController::class, 'store']
        )->name('admin.keunggulan.store');

        Route::get('/keunggulan/{id}/edit',
            [App\Http\Controllers\Admin\KeunggulanController::class, 'edit']
        )->name('admin.keunggulan.edit');

        Route::put('/keunggulan/{id}',
            [App\Http\Controllers\Admin\KeunggulanController::class, 'update']
        )->name('admin.keunggulan.update');

        Route::delete('/keunggulan/{id}',
            [App\Http\Controllers\Admin\KeunggulanController::class, 'destroy']
        )->name('admin.keunggulan.destroy');
    });

Route::middleware('auth')
    ->prefix('admin')
    ->group(function () {
        Route::get('/statistik',
            [App\Http\Controllers\Admin\StatistikController::class, 'index']
        )->name('admin.statistik.index');

        Route::get('/statistik/create',
            [App\Http\Controllers\Admin\StatistikController::class, 'create']
        )->name('admin.statistik.create');

        Route::post('/statistik',
            [App\Http\Controllers\Admin\StatistikController::class, 'store']
        )->name('admin.statistik.store');

        Route::get('statistik/{id}/edit',
            [App\Http\Controllers\Admin\StatistikController::class, 'edit']
        )->name('admin.statistik.edit');

        Route::put('statistik/{id}',
            [App\Http\Controllers\Admin\StatistikController::class, 'update']
        )->name('admin.statistik.update');

        Route::delete('statistik/{id}',
            [App\Http\Controllers\Admin\StatistikController::class, 'destroy']
        )->name('admin.statistik.destroy');
    });

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

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

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::middleware(['auth'])->group(function () {
//     Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
// });


require __DIR__.'/auth.php';
