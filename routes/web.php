<?php


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatambkmController;
use App\Http\Controllers\PemberkasanController;
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

        Route::middleware(['checkrole:mahasiswa'])->group(function () {
            Route::resource('/pemberkasan', PemberkasanController::class);
            Route::resource('/datambkm', DatambkmController::class);
        });

        Route::middleware(['checkrole:admin,dosen'])->group(function () {
            Route::resource('/datamahasiswas', DatamahasiswasController::class);
            Route::middleware(['checkrole:admin'])->group(function () {
                Route::resource('/datadosens', DatadosensController::class);
            });
        });
    });
});

require __DIR__ . '/auth.php';