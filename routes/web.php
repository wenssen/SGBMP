<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BienesController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Rutas públicas
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Rutas protegidas (requieren login)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    // Vista principal
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Importar desde Excel
    Route::get('/bienes/importar', [BienesController::class, 'importForm'])->name('bienes.import.form');
    Route::post('/bienes/importar', [BienesController::class, 'importExcel'])->name('bienes.import.excel');
    
    // Bienes
    Route::resource('bienes', BienesController::class)->parameters(['bienes' => 'bien']);

    // Mantenimientos
    Route::resource('mantenimientos', MantenimientoController::class);

    // Perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

