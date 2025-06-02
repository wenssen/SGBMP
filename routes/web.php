<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BienesController;

Route::get('/', function () {
    return view('home');
});

// ? Ruta personalizada DEBE ir antes del resource
Route::get('/bienes/configuracion', [BienesController::class, 'configuracion'])->name('bienes.configuracion');

// ? Recurso general va después
Route::resource('bienes', BienesController::class)->parameters([
    'bienes' => 'bien'
]);
