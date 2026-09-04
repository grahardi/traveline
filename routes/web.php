<?php

use App\Http\Controllers\Admin\ArmadaController as AdminArmadaController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KetersediaanController;
use App\Http\Controllers\Admin\LayananController as AdminLayananController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TestimoniController;
use App\Http\Controllers\ArmadaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// ==================== SITUS PUBLIK ====================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
Route::get('/layanan/{slug}', [LayananController::class, 'show'])->name('layanan.show');
Route::get('/armada', [ArmadaController::class, 'index'])->name('armada.index');
Route::get('/armada/{slug}', [ArmadaController::class, 'show'])->name('armada.show');
Route::get('/tentang-kami', [PageController::class, 'about'])->name('about');
Route::get('/kontak', [PageController::class, 'contact'])->name('contact');
Route::get('/testimoni', [PageController::class, 'testimoni'])->name('testimoni');

// ==================== ADMIN ====================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
    Route::post('login', [AuthController::class, 'login'])->name('login.submit')->middleware('guest');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

    Route::middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('banners', BannerController::class)->except('show');
        Route::resource('layanans', AdminLayananController::class)->except('show');
        Route::resource('testimonis', TestimoniController::class)->except('show');
        Route::resource('armadas', AdminArmadaController::class)->except('show');
        Route::delete('armadas/{armada}/foto/{foto}', [AdminArmadaController::class, 'hapusFoto'])->name('armadas.foto.destroy');

        Route::get('ketersediaan', [KetersediaanController::class, 'index'])->name('ketersediaan.index');
        Route::put('ketersediaan/{armada}', [KetersediaanController::class, 'update'])->name('ketersediaan.update');

        Route::get('pengaturan', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('pengaturan', [SettingController::class, 'update'])->name('settings.update');
    });
});
