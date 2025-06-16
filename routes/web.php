<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BienesController;

Route::get('/', function () {
    return view('home');
});

Route::resource('bienes', BienesController::class)->parameters([
    'bienes' => 'bien'
]);

use App\Http\Controllers\MantenimientoController;

Route::resource('mantenimientos', MantenimientoController::class);
