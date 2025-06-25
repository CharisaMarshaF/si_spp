<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PembayaranController;

// Arahkan root ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Hanya untuk tamu (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Hanya untuk yang sudah login
Route::middleware('auth')->group(function () {
    Route::resource('kelas', KelasController::class);
    Route::resource('spp', SppController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('petugas', PetugasController::class);
    Route::delete('siswa/{nisn}', [SiswaController::class, 'destroy'])->name('siswa.destroy');
    Route::put('siswa/{nisn}', [SiswaController::class, 'update'])->name('siswa.update');
    Route::resource('pembayaran', PembayaranController::class);
    // Tambahan Riwayat dan Export
    Route::get('/riwayat-pembayaran', [PembayaranController::class, 'riwayat'])->name('pembayaran.riwayat');
    Route::get('/export-excel', [PembayaranController::class, 'exportExcel'])->name('pembayaran.export.excel');
    Route::get('/export-pdf', [PembayaranController::class, 'exportPDF'])->name('pembayaran.export.pdf');
    Route::get('/riwayat-saya', [PembayaranController::class, 'riwayatSiswa'])->name('pembayaran.siswa.riwayat');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
