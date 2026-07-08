<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\OpinionController;
use App\Http\Controllers\UsuarioController;

Route::get('/', [OpinionController::class, 'create'])->name('opiniones.create');
Route::post('/opiniones', [OpinionController::class, 'store'])->name('opiniones.store');

Auth::routes([
    'register' => false
]);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return redirect()->route('opiniones.index');
    })->name('home');

    Route::get('/opiniones', [OpinionController::class, 'index'])->name('opiniones.index');
    Route::delete('/opiniones/{opinion}', [OpinionController::class, 'destroy'])->name('opiniones.destroy');

    Route::get('/opiniones/{opinion}/edit', [OpinionController::class, 'edit'])
    ->name('opiniones.edit');

    Route::put('/opiniones/{opinion}', [OpinionController::class, 'update'])
    ->name('opiniones.update');

    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
    Route::delete('/usuarios/{usuario}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
});