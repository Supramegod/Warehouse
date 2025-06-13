<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PenataanGudangController;
use App\Http\Controllers\GeneticAlgorithmController;
use App\Services\GeneticAlgorithmService;
use Illuminate\Support\Facades\Route;

// ========================
// ✅ Rute Login & Register
// ========================

// Arahkan root ke form login
// Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');

// Form action login & register
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================
// ✅ Rute yang Butuh Login
// ==========================
Route::middleware('auth')->group(function () {
    // Halaman dashboard utama setelah login
   Route::get('/index', [GudangController::class, 'index'])->name('index');

    Route::get('/', [GudangController::class, 'index']);
    Route::get('/test-external', [GudangController::class, 'testExternalDb']);
    Route::get('/profile', function () {
        return view('profile');})->name('profile')->middleware('auth');
    Route::get('/tables.html', [ItemController::class, 'tampilItems']);
    Route::get('/hasil.html', [ItemController::class, 'tampilPenataan']);
    Route::post('/forms', [ItemController::class, 'store'])->name('items.store');
    Route::post('/items/import', [ItemController::class, 'import'])->name('items.import');
    Route::get('/download-template', [ItemController::class, 'downloadTemplate'])->name('download.template');
    Route::view('/forms.html', 'forms');
    Route::get('/genetic', [GeneticAlgorithmController::class, 'index']);
    Route::get('/run-ga', function (GeneticAlgorithmService $gaService) {
        $gaService->run();
        return 'GA sudah selesai dijalankan!';
    });
});
