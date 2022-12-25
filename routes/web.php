<?php

use App\Http\Controllers\Cliente\ClienteController;
use App\Http\Controllers\Grupo\GrupoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => '/'], function () {
    Route::get('', function () {
        return view('dashboards.index');
    })->name('index');
    Route::group(['prefix' => 'cliente'], function () {
        Route::get('/', [ClienteController::class, 'index'])->name('cliente.index');
        Route::post('/', [ClienteController::class, 'store'])->name('cliente.create');
        Route::put('/{cliente_id}', [ClienteController::class, 'update'])->name('cliente.update');
        Route::delete('/{cliente_id}', [ClienteController::class, 'delete'])->name('cliente.delete');
    });

    Route::group(['prefix' => 'grupo'], function () {
        Route::get('/', [GrupoController::class, 'index'])->name('grupo.index');
        Route::post('/', [GrupoController::class, 'store'])->name('grupo.create');
        Route::put('/{grupo_id}', [GrupoController::class, 'update'])->name('grupo.update');
        Route::delete('/{grupo_id}', [GrupoController::class, 'delete'])->name('grupo.delete');
    });

});
