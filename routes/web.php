<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('mahasiswa', MahasiswaController::class);

Route::get('/mahasiswas', [MahasiswaController::class, 'index'])->name('mahasiswas.index');

Route::get('/mahasiswas/create', [MahasiswaController::class, 'create'])->name('mahasiswas.create');

Route::get('/mahasiswas/edit/{Nim}', [MahasiswaController::class, 'edit'])->name('mahasiswas.edit');

Route::put('/mahasiswas/{Nim}', [MahasiswaController::class, 'update'])->name('mahasiswas.update');

Route::post('/mahasiswas/store', [MahasiswaController::class, 'store'])->name('mahasiswas.store');

Route::delete('/mahasiswas/{mahasiswa}', [MahasiswaController::class, 'destroy'])->name('mahasiswas.destroy');

Route::get('/mahasiswas/{mahasiswa}', [MahasiswaController::class, 'show'])->name('mahasiswas.show');