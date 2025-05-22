<?php


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatambkmController;
use App\Http\Controllers\PemberkasanController;
use App\Http\Controllers\datamahasiswasController;
use App\Http\Controllers\datadosensController;
use App\Http\Controllers\StatusController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::middleware(['checkrole:mahasiswa'])->group(function () {
            Route::resource('/pemberkasan', PemberkasanController::class);
            Route::resource('/datambkm', DatambkmController::class);
        });

        Route::middleware(['checkrole:admin,dosen'])->group(function () {
            Route::resource('/datamahasiswas', DatamahasiswasController::class);
            Route::prefix('/status')->group(function () {
                Route::patch('/rekomendasi/{id}/approve', [StatusController::class, 'approveRekomendasi'])->name('status.arekomendasi');
                Route::patch('/rekomendasi/{id}/reject', [StatusController::class, 'rejectRekomendasi'])->name('status.rrekomendasi');
                Route::patch('/pernyataan/{id}/approv', [StatusController::class, 'approvePernyataan'])->name('status.apernyataan');
                Route::patch('/pernyataan/{id}/reject', [StatusController::class, 'rejectPernyataan'])->name('status.rpernyataan');
                Route::patch('/LoA/{id}/approv', [StatusController::class, 'approveLoA'])->name('status.aLoA');
                Route::patch('/LoA/{id}/reject', [StatusController::class, 'rejectLoA'])->name('status.rLoA');
                Route::patch('/laporan_pertengahan/{id}/approv', [StatusController::class, 'approvelaporan_pertengahan'])->name('status.alaporan_pertengahan');
                Route::patch('/laporan_pertengahan/{id}/reject', [StatusController::class, 'rejectLaporan_pertengahan'])->name('status.rlaporan_pertengahan');
                Route::patch('/laporan_akhir/{id}/approv', [StatusController::class, 'approveLaporan_akhir'])->name('status.alaporan_akhir');
                Route::patch('/laporan_akhir/{id}/reject', [StatusController::class, 'rejectLaporan_akhir'])->name('status.rlaporan_akhir');
                Route::patch('/sertifikat/{id}/approv', [StatusController::class, 'approveSertifikat'])->name('status.asertifikat');
                Route::patch('/sertifikat/{id}/reject', [StatusController::class, 'rejectSertifikat'])->name('status.rsertifikat');
                Route::patch('/penilaian/{id}/approv', [StatusController::class, 'approvePenilaian'])->name('status.apenilaian');
                Route::patch('/penilaian/{id}/reject', [StatusController::class, 'rejectPenilaian'])->name('status.rpenilaian');
            });
            Route::middleware(['checkrole:admin'])->group(function () {
                Route::resource('/datadosens', DatadosensController::class);
            });
        });
    });
});

require __DIR__ . '/auth.php';