<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KasController;
use App\http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\StokBarangController;
use App\http\Controllers\BrgMskController;
use App\http\Controllers\BrgKlrController;
use App\Http\Controllers\LaporanController;

Route::get('/', function () {
    return view('login');
});

// Halaman Login
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/postlogin', [LoginController::class, 'postlogin'])->name('postlogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Route Validasi login sebelum ke Home
Route::group(['middleware' => ['auth', 'ceklevel:admin,gudang,kasir']], function () {
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    // Ganti Password
    Route::get('/ganti_password', [HomeController::class, 'ganti_password']);
    Route::post('/ganti_password/aksi', [HomeController::class, 'ganti_password_aksi']);
});

// Route Kelola Data User
Route::group(['middleware' => ['auth', 'ceklevel:admin']], function () {
    Route::get('/user', [UserController::class, 'user'])->name('user');
    // Route CRUD Data User
    Route::POST('user/store', [UserController::class, 'store']);
    Route::POST('/user/{id}/update', [UserController::class, 'update']);
    Route::get('/user/{id}/destroy', [UserController::class, 'destroy']);
    // Route Laporan Data User
    Route::get('/lap_user', [LaporanController::class, 'lap_user'])->name('lap_user');
    Route::get('/lap_user/cetak_user', [LaporanController::class, 'cetak_user']);
});

// Route Kelola Barang
Route::group(['middleware' => ['auth', 'ceklevel:admin,gudang,']], function () {
    Route::get('/stok_barang', [StokBarangController::class, 'stok_barang'])->name('stok_barang');
    // Route CRUD stok barang
    Route::POST('stok_barang/store', [StokBarangController::class, 'store']);
    Route::POST('/stok_barang/{id}/update', [StokBarangController::class, 'update']);
    Route::get('/stok_barang/{id}/destroy', [StokBarangController::class, 'destroy']);
    // Route Kategori
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
    Route::POST('kategori/store', [KategoriController::class, 'store']);
    Route::POST('/kategori/{id}/update', [KategoriController::class, 'update']);
    Route::get('/kategori/{id}/destroy', [KategoriController::class, 'destroy']);
    // Route CRUD BarangMasuk
    Route::get('/brg_msk', [BrgMskController::class, 'index'])->name('brg_msk');
    Route::get('/brg_msk/ajax', [BrgMskController::class, 'ajax']);
    Route::get('/brg_msk/create', [BrgMskController::class, 'create']);
    Route::POST('brg_msk/store', [BrgMskController::class, 'store']);
    // Route CRUD BarangKeluar
    Route::get('/brg_klr', [BrgKlrController::class, 'index'])->name('brg_klr');
    Route::get('/brg_klr/ajax', [BrgKlrController::class, 'ajax']);
    Route::get('/brg_klr/create', [BrgKlrController::class, 'create']);
    Route::POST('brg_klr/store', [BrgKlrController::class, 'store']);
    // Route Laporan Kategori
    Route::get('/lap_kategori', [LaporanController::class, 'lap_kategori'])->name('lap_kategori');
    Route::get('/lap_kategori/cetak_kategori', [LaporanController::class, 'cetak_kategori']);
    // Route Laporan Barang
    Route::get('/lap_stok_barang', [LaporanController::class, 'lap_stok_barang'])->name('lap_stok_barang');
    Route::get('/lap_stok_barang/cetak_stok_barang', [LaporanController::class, 'cetak_stok_barang']);
    // Route Laporan Barang Masuk
    Route::get('/lap_brg_msk', [LaporanController::class, 'lap_brg_msk'])->name('lap_brg_msk');
    Route::get('/lap_brg_msk/cetak_brg_msk', [LaporanController::class, 'cetak_brg_msk']);
    // Route Laporan Barang Keluar
    Route::get('/lap_brg_klr', [LaporanController::class, 'lap_brg_klr'])->name('lap_brg_klr');
    Route::get('/lap_brg_klr/cetak_brg_klr', [LaporanController::class, 'cetak_brg_klr']);
});

// Route Kelola Keuangan
Route::group(['middleware' => ['auth', 'ceklevel:admin,kasir']], function () {
    // Route CRUD Kas
    Route::get('/kas/{type}', [KasController::class, 'kas'])->name('kas');
    Route::get('/kasedit/{id}', [KasController::class, 'edit'])->name('kas-edit');
    Route::get('/kashapus/{id}', [KasController::class, 'destroy'])->name('kas-hapus');
    Route::put('/kasedit/{id}', [KasController::class, 'update'])->name('kas-update');
    Route::POST('/kas/{type}', [KasController::class, 'store']);
    // Route Transaksi
    Route::get('/transaksi', [KasController::class, 'transaksi'])->name('kas_transaksi');
    // Route Laporan Transaksi
    Route::get('/lap_transaksi', [LaporanController::class, 'lap_transaksi'])->name('lap_transaksi');
    Route::get('/lap_transaksi/cetak_transaksi', [LaporanController::class, 'cetak_transaksi']);
    // Route Laporan Kas Masuk
    Route::get('/lap_kas_msk', [LaporanController::class, 'lap_kas_msk'])->name('lap_kas_msk');
    Route::get('/lap_kas_msk/cetak_kas_msk', [LaporanController::class, 'cetak_kas_msk']);
    // Route Laporan Kas Keluar
    Route::get('/lap_kas_klr', [LaporanController::class, 'lap_kas_klr'])->name('lap_kas_klr');
    Route::get('/lap_kas_klr/cetak_kas_klr', [LaporanController::class, 'cetak_kas_klr']);
});
