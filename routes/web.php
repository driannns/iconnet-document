<?php

use Carbon\Carbon;
use App\Models\History;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdministratorController;
use App\Http\Middleware\Administrator;

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
})->middleware(['auth', 'verified', 'administrator'])->name('dashboard');

Route::middleware(['auth', 'administrator'])->group(function () {
    Route::get('/', function () {
        $date = Carbon::parse(now()->format('Y-m-d'));
        $formattedDate = $date->format('Y-m-d');
        $all = History::all();
        $allCount = $all->count();
        $accepted = History::where('persetujuan', 'Disetujui')->get();
        $acceptedCount = $accepted->count();
        $rejected = History::where('persetujuan', 'Tidak Disetujui')->get();
        $rejectedCount = $rejected->count();
        $edited = History::where('persetujuan', 'Telah diedit')->get();
        $editedCount = $edited->count();
        $today = History::where('created_at',  'LIKE', '%' . $formattedDate . '%')->get();
        $todayCount = $today->count();
        return view('index', compact('allCount','acceptedCount', 'rejectedCount','editedCount','todayCount'));
    });

    Route::post('/pdf', [PdfController::class, 'create'])->name('pdf.create');

    Route::get('/history', [PdfController::class, 'history'])->name('history.index');
    Route::post('/history', [PdfController::class, 'search'])->name('history.search');
    Route::get('/history/export', [PdfController::class, 'export'])->name('history.export');
    

    Route::post('/preview', [PdfController::class, 'preview'])->name('preview.index');
    Route::put('/preview/{id}', [PdfController::class, 'update'])->name('preview.update');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/pdf', [PdfController::class, 'index'])->name('pdf.index');

    Route::middleware('role:user|administrator')->group(function(){

        Route::get('/pengajuan', function () {
            return view('surattugas');
        })->name('pengajuan');
        
        Route::delete('/delete/{id}', [PdfController::class, 'delete'])->name('delete.index');

    });
    
    Route::middleware('role:manager|administrator')->group(function(){

        Route::post('/history/setuju/{id}', [PdfController::class, 'setuju'])->name('history.setuju');
        Route::post('/history/tidaksetuju/{id}', [PdfController::class, 'tidaksetuju'])->name('history.tidaksetuju');

    });

    Route::middleware('role:administrator')->group(function(){
        Route::post('register/admin', [AdministratorController::class, 'storeAdmin'])->name('registerAdmin');
        Route::post('register/manager', [AdministratorController::class, 'storeManager'])->name('registerManager');
        Route::get('administrator/register', [AdministratorController::class, 'index'])->name('administrator.index');
    });

});

require __DIR__.'/auth.php';
