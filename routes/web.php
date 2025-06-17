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

<<<<<<< HEAD
Route::resource('bienes', BienesController::class)->parameters([
    'bienes' => 'bien'
]);

use App\Http\Controllers\MantenimientoController;

Route::resource('mantenimientos', MantenimientoController::class);
=======
// Ruta protegida por Breeze al iniciar sesión
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Rutas protegidas (requieren login)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::resource('bienes', BienesController::class)->parameters(['bienes' => 'bien']);
    Route::resource('mantenimientos', MantenimientoController::class);

    // ?? Rutas para perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
>>>>>>> 2108499 (Actualizar mantenimientos y notificaciones)
