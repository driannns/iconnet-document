<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PdfController;
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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('index');
    });

    Route::get('/pengajuan', function () {
        return view('surattugas');
    });
    
    Route::get('/pdf', [PdfController::class, 'index'])->name('pdf.index');
    Route::post('/pdf', [PdfController::class, 'create'])->name('pdf.create');

    Route::get('/history', [PdfController::class, 'history'])->name('history.index');
    Route::post('/history', [PdfController::class, 'search'])->name('history.search');
    Route::get('/history/export', [PdfController::class, 'export'])->name('history.export');
    
    Route::post('/preview', [PdfController::class, 'preview'])->name('preview.index');
    Route::put('/preview/{id}', [PdfController::class, 'update'])->name('preview.update');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
