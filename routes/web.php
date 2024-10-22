<?php

use App\Http\Controllers\APIController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DiskonController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SUController;
use App\Http\Controllers\TransaksiController;
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


Route::middleware(['auth'])->group(
    function () {
        Route::get('/', function () {
            return view('index', ['title' => 'Dashboard']);
        });

        Route::get('/kategori', [KategoriController::class, 'index']);
        Route::post('/kategori/store', [KategoriController::class, 'store']);
        Route::post('/kategori/update/{id}', [KategoriController::class, 'update']);
        Route::get('/kategori/destroy/{id}', [KategoriController::class, 'destroy']);

        Route::get('/produk', [ProdukController::class, 'index']);
        Route::post('/produk/store', [ProdukController::class, 'store']);
        Route::post('/produk/update/{id}', [ProdukController::class, 'update']);
        Route::get('/produk/destroy/{id}', [ProdukController::class, 'destroy']);

        Route::get('/transaksi', [TransaksiController::class, 'index']);
        Route::post('/transaksi/store', [TransaksiController::class, 'store']);
        Route::post('/transaksi/update/{id}', [TransaksiController::class, 'update']);
        Route::get('/transaksi/destroy/{id}', [TransaksiController::class, 'destroy']);

        Route::get('/diskon', [DiskonController::class, 'index']);
        Route::post('/diskon/store', [DiskonController::class, 'store']);
        Route::post('/diskon/update/{id}', [DiskonController::class, 'update']);
        Route::get('/diskon/destroy/{id}', [DiskonController::class, 'destroy']);

        Route::get('/su/laporan', [SUController::class, 'laporan']);
        Route::post('/su/cetak', [SUController::class, 'cetak']);

        Route::get('/su/admin', [SUController::class, 'kelolaAdmin']);
        Route::post('/su/admin/store', [SUController::class, 'adminStore']);
        Route::post('/su/admin/update/{id}', [SUController::class, 'adminUpdate']);
        Route::get('/su/admin/destroy/{id}', [SUController::class, 'adminDestroy']);
    }
);

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
