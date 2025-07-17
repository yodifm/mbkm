<?php


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatambkmController;
use App\Http\Controllers\PemberkasanController;
use App\Http\Controllers\DatamahasiswasController;
use App\Http\Controllers\DatadosensController;
use App\Http\Controllers\Documents\LaporanAkhirController;
use App\Http\Controllers\Documents\LaporanPertengahanController;
use App\Http\Controllers\Documents\SertifikatPenilaianController;
use App\Http\Controllers\RejectController;
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

            Route::prefix('/documents')->group(function () {
                Route::resource('/laporan-pertengahan', LaporanPertengahanController::class);
                Route::resource('/laporan-akhir', LaporanAkhirController::class);
                Route::resource('/sertifikat', SertifikatPenilaianController::class);
            });
        });

        Route::middleware(['checkrole:admin,dosen'])->group(function () {
            Route::resource('/datamahasiswas', DatamahasiswasController::class);
            Route::post('/rejection/{id}', [RejectController::class, 'reject'])->name('rejection');
            Route::prefix('/status')->group(function () {
                Route::patch('/rekomendasi/{id}/approve', [StatusController::class, 'approveRekomendasi'])->name('status.arekomendasi');

                Route::patch('/pernyataan/{id}/approv', [StatusController::class, 'approvePernyataan'])->name('status.apernyataan');
                Route::patch('/LoA/{id}/approv', [StatusController::class, 'approveLoA'])->name('status.aLoA');

                Route::patch('/laporan_pertengahan/{id}/approv', [StatusController::class, 'approveLaporan_pertengahan'])->name('status.alaporan_pertengahan');

                Route::patch('/laporan_akhir/{id}/approv', [StatusController::class, 'approveLaporan_akhir'])->name('status.alaporan_akhir');

                Route::patch('/sertifikat/{id}/approv', [StatusController::class, 'approveSertifikat'])->name('status.asertifikat');

                Route::patch('/penilaian/{id}/approv', [StatusController::class, 'approvePenilaian'])->name('status.apenilaian');
            });
            Route::middleware(['checkrole:admin'])->group(function () {
                Route::resource('/datadosens', DatadosensController::class);
            });
        });
    });
});

require __DIR__ . '/auth.php';
