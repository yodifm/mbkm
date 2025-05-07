<?php


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatambkmsController;

use App\Http\Controllers\PemberkasansController;
use App\Http\Controllers\DatambksController;
use App\Http\Controllers\datamahasiswasController;
use App\Http\Controllers\datadosensController;


use App\Models\Datambkms;
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

        
        // Route::prefix('about')->group(function () {
        //     Route::get('/', [AboutController::class, 'index'])->name('about.index');
        //     Route::post('/post', [AboutController::class, 'store'])->name('about.post');
        //     Route::put('/{id}/update', [AboutController::class, 'update'])->name('about.update');
        // });
        // Route::resource('/educations', EducationController::class);
        // Route::resource('/certificates', CertificatesController::class);
        // Route::resource('/projects', ProjectsController::class);
        // Route::prefix('projects/{id}/skills')->group(function () {
        //     Route::get('/', [ProjectSkillController::class, 'index'])->name('projectSkills.index');
        //     Route::post('/post', [ProjectSkillController::class, 'store'])->name('projectSkills.post');
        //     Route::delete('/{iddel}/delete', [ProjectSkillController::class, 'delete'])->name('projectSkills.delete');
        // });
        // Route::prefix('work')->group(function () {
        //     Route::prefix('/status')->group(function () { 
        //         Route::get('/', [WorkStatusController::class, 'index'])->name('WorkStatus.index');
        //         Route::post('/post', [WorkStatusController::class, 'store'])->name('WorkStatus.store');
        //         Route::delete('/{id}/delete', [WorkStatusController::class, 'delete'])->name('WorkStatus.delete');
        //     });

        //     Route::prefix('/experience')->group(function () { 
        //         Route::get('/', [WorkExperienceController::class, 'index'])->name('WorkExperience.index');
        //         Route::get('/create', [WorkExperienceController::class, 'create'])->name('WorkExperience.create');
        //         Route::post('/store', [WorkExperienceController::class, 'store'])->name('WorkExperience.store');
        //         Route::get('/{id}/edit', [WorkExperienceController::class, 'edit'])->name('WorkExperience.edit');
        //         Route::put('/{id}', [WorkExperienceController::class, 'update'])->name('WorkExperience.update');
        //         Route::delete('/{id}', [WorkExperienceController::class, 'destroy'])->name('WorkExperience.delete');
        //     });
        // });
        // Route::resource('/skills', SkillController::class);
        // Route::resource('/contacts', ContactController::class);
       

       

    });
});

require __DIR__.'/auth.php';
