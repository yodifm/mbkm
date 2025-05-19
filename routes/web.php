<?php


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatambkmsController;
use App\Http\Controllers\PemberkasansController;
use App\Http\Controllers\datamahasiswasController;
use App\Http\Controllers\datadosensController;
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

        Route::resource('/pemberkasans', PemberkasansController::class);
        Route::resource('/datambkms', DatambkmsController::class);
        Route::resource('/datamahasiswas', DatamahasiswasController::class);
        Route::resource('/datadosens', DatadosensController::class);

        Route::middleware(['checkrole:admin,mahasiswa'])->group(function () {
            Route::resource('/pemberkasans', PemberkasansController::class);
            Route::resource('/datambkms', DatambkmsController::class);
            Route::resource('/datamahasiswas', DatamahasiswasController::class);
        });

        Route::middleware(['checkrole:admin,dosen'])->group(function () {
            Route::resource('/datamahasiswas', DatamahasiswasController::class);
            Route::resource('/datadosens', DatadosensController::class);
        });
    });
});

require __DIR__ . '/auth.php';