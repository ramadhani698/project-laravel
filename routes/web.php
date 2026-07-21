<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CarouselController as AdminCarouselController;
use App\Http\Controllers\Admin\KeunggulanController as AdminKeunggulanController;
use App\Http\Controllers\Admin\JurusanController as AdminJurusanController;
use App\Http\Controllers\Admin\JurusanHeadController;
use App\Http\Controllers\Admin\JurusanVisiMisiController;
use App\Http\Controllers\Admin\JurusanGalleryController;
use App\Http\Controllers\Admin\StatistikController as AdminStatistikController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\SchoolHistoryController as AdminSchoolHistoryController;
use App\Http\Controllers\Admin\VisionController as AdminVisionController;
use App\Http\Controllers\Admin\PrincipalMessageController as AdminPrincipalMessageController;
use App\Http\Controllers\Admin\SarprasController as AdminSarprasController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\PrestasiController as AdminPrestasiController;
use App\Http\Controllers\Admin\BerandaSettingController;
use App\Http\Controllers\Admin\Ppdb\ProsedurSettingController;
// Frontend Controllers
use App\Http\Controllers\HomeController as FrontendHomeController;
use App\Http\Controllers\JurusanController as FrontendJurusanController;
use App\Http\Controllers\BeritaController as FrontendBeritaController;
use App\Http\Controllers\ProfilController as FrontendProfilController;
use App\Http\Controllers\InformasiController as FrontendInformasiController;
use App\Http\Controllers\PrestasiController as FrontendPrestasiController;

// PPDB Controllers
use App\Http\Controllers\Ppdb\AuthController as PpdbAuthController;
use App\Http\Controllers\Ppdb\PpdbDashboardController;
use App\Http\Controllers\Ppdb\Auth\ForgotPasswordController;
use App\Http\Controllers\PpdbBerandaController;
use App\Http\Controllers\Admin\Ppdb\PendaftarController as AdminPpdbPendaftarController;
use App\Http\Controllers\Admin\Ppdb\DataPendaftaranController as AdminPpdbDataPendaftaranController;


/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [FrontendHomeController::class, 'index'])->name('home');

// Jurusan
Route::get('/jurusan/{slug}', [FrontendJurusanController::class, 'show'])->name('jurusan.show');

// TODO: pindahkan ke view dinamis via FrontendJurusanController jika kontennya sudah seragam
Route::view('/jurusan/tkj', 'frontend.jurusan.tkj');
Route::view('/jurusan/dkv', 'frontend.jurusan.dkv');
Route::view('/jurusan/mplb', 'frontend.jurusan.mplb');

// Profil
Route::get('/profil/sejarah', [FrontendProfilController::class, 'sejarah'])->name('profil.sejarah');
Route::get('/profil/visi-misi', [FrontendProfilController::class, 'visiMisi'])->name('profil.visi-misi');
Route::get('/profil/kata-kepsek', [FrontendProfilController::class, 'kataKepsek'])->name('profil.kata-kepsek');

// Informasi & Berita
Route::get('/informasi/berita', [FrontendBeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [FrontendBeritaController::class, 'show'])->name('berita.show');
Route::get('/informasi/sarpras', [FrontendInformasiController::class, 'sarpras'])->name('informasi.sarpras');
Route::get('/informasi/gallery', [FrontendInformasiController::class, 'gallery'])->name('informasi.gallery');

// Prestasi
Route::get('/prestasi', [FrontendPrestasiController::class, 'index'])->name('prestasi.index');

/*
|--------------------------------------------------------------------------
| PPDB Routes
|--------------------------------------------------------------------------
*/

Route::prefix('ppdb')
    ->name('ppdb.')
    ->group(function () {
        Route::get('/', [PpdbBerandaController::class, 'index'])->name('home');
        Route::get('/prosedur', [\App\Http\Controllers\Ppdb\ProsedurController::class, 'index'])->name('prosedur');       
        Route::view('/daftar', 'ppdb.daftar')->name('daftar'); 
        Route::view('/persyaratan', 'ppdb.persyaratan')->name('persyaratan');
        Route::view('/kontak', 'ppdb.kontak')->name('kontak'); 

        Route::prefix('auth')
            ->name('auth.')
            ->group(function () {
                Route::get('/daftar', [PpdbAuthController::class, 'showRegister'])->name('daftar');
                Route::post('/daftar', [PpdbAuthController::class, 'register'])->name('daftar.store');

                Route::get('/login', [PpdbAuthController::class, 'showLogin'])->name('login');
                Route::post('/login', [PpdbAuthController::class, 'login'])->name('login.store');

                // ===============================
                // Lupa Password
                // ===============================
                Route::prefix('lupa-password')
                    ->name('lupa-password.')
                    ->group(function () {
                        Route::get('/', [ForgotPasswordController::class, 'showVerifyForm'])->name('verify');
                        Route::post('/', [ForgotPasswordController::class, 'verify'])->name('verify.store');

                        Route::get('/reset', [ForgotPasswordController::class, 'showResetForm'])->name('reset');
                        Route::post('/reset', [ForgotPasswordController::class, 'resetPassword'])->name('reset.store');
                    });
            });

        Route::middleware('auth:ppdb')->group(function () {
            Route::get('/dashboard', [PpdbDashboardController::class, 'index'])->name('dashboard');
            Route::post('/dashboard/step/{step}', [PpdbDashboardController::class, 'saveStep'])->name('dashboard.step');
            Route::post('/dashboard/berkas', [PpdbDashboardController::class, 'uploadBerkas'])->name('dashboard.berkas.upload');
            Route::delete('/dashboard/berkas/{berkas}', [PpdbDashboardController::class, 'deleteBerkas'])->name('dashboard.berkas.delete');
            Route::post('/dashboard/submit', [PpdbDashboardController::class, 'submit'])->name('dashboard.submit');
            Route::post('/logout', [PpdbAuthController::class, 'logout'])->name('logout');
        });
    });

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::resource('carousel', AdminCarouselController::class);
        Route::resource('keunggulan', AdminKeunggulanController::class);
        Route::resource('statistik', AdminStatistikController::class);

        // Jurusan + child resources (head, visi-misi, gallery)
        Route::resource('jurusan', AdminJurusanController::class);

        Route::put('jurusan/{jurusan}/head', [JurusanHeadController::class, 'update'])
            ->name('jurusan.head.update');

        Route::put('jurusan/{jurusan}/visi-misi', [JurusanVisiMisiController::class, 'update'])
            ->name('jurusan.visi-misi.update');

        Route::post('jurusan/{jurusan}/gallery', [JurusanGalleryController::class, 'store'])
            ->name('jurusan.gallery.store');

        Route::delete('jurusan/gallery/{gallery}', [JurusanGalleryController::class, 'destroy'])
            ->name('jurusan.gallery.destroy');

        // WIZARD ROUTES (alur create jurusan bertahap)
        Route::get('jurusan/{jurusan}/wizard/head', [AdminJurusanController::class, 'wizardHead'])
            ->name('jurusan.wizard.head');

        Route::get('jurusan/{jurusan}/wizard/visi-misi', [AdminJurusanController::class, 'wizardVisiMisi'])
            ->name('jurusan.wizard.visi-misi');

        Route::get('jurusan/{jurusan}/wizard/gallery', [AdminJurusanController::class, 'wizardGallery'])
            ->name('jurusan.wizard.gallery');

        Route::get('jurusan/{jurusan}/wizard/finish', [AdminJurusanController::class, 'wizardFinish'])
            ->name('jurusan.wizard.finish');

        Route::resource('berita', AdminBeritaController::class);
        Route::resource('histories', AdminSchoolHistoryController::class);
        Route::resource('vision', AdminVisionController::class);
        Route::resource('principal-message', AdminPrincipalMessageController::class);
        Route::resource('sarpras', AdminSarprasController::class);
        Route::resource('gallery', AdminGalleryController::class);
        Route::resource('prestasi', AdminPrestasiController::class);

        // ROUTE PPDB ADMIN
        Route::prefix('ppdb')->name('ppdb.')->group(function () {
            Route::get('pendaftar', [AdminPpdbPendaftarController::class, 'index'])
                ->name('pendaftar.index');

            Route::delete('pendaftar/{pendaftar}', [AdminPpdbPendaftarController::class, 'destroy'])
                ->name('pendaftar.destroy');


            Route::resource('data-pendaftaran', AdminPpdbDataPendaftaranController::class)
                ->except(['create', 'store', 'show'])
                ->parameters(['data-pendaftaran' => 'formulir']);

            Route::patch('data-pendaftaran/berkas/{berkas}/verifikasi', [AdminPpdbDataPendaftaranController::class, 'verifikasiBerkas'])
                ->name('data-pendaftaran.berkas.verifikasi');

        });
         // ROUTE BERANDA SETTING
            Route::get('/beranda-setting', [BerandaSettingController::class, 'edit'])->name('beranda-setting.edit');
            Route::put('/beranda-setting', [BerandaSettingController::class, 'update'])->name('beranda-setting.update');

            //ROUTE PROSEDUR SETTING
            Route::resource('/prosedur-setting', ProsedurSettingController::class);
    });


Route::get('/dashboard', [AdminDashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';