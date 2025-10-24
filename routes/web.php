<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\siteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', [siteController::class, 'home'])->name('home');
Route::get('/layanan', [siteController::class, 'layanan'])->name('layanan');
Route::get('/visi-misi', [siteController::class, 'visiMisi'])->name('visi-misi');
Route::get('/organisasi', [siteController::class, 'organisasi'])->name('organisasi');

Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/pemilik', [dashboardController::class, 'user'])->name('user-data');
Route::get('/dashboard/jenis-hewan', [dashboardController::class, 'jenisHewan'])->name('jenis-hewan-data');
Route::get('/dashboard/ras-hewan', [dashboardController::class, 'rasHewan'])->name('ras-hewan-data');
Route::get('/dashboard/kategori', [dashboardController::class, 'kategori'])->name('kategori-data');
Route::get('/dashboard/kategori-klinis', [dashboardController::class, 'kategoriKlinis'])->name('kategori-klinis-data');
Route::get('/dashboard/kode-tindakan-terapi', [dashboardController::class, 'kodeTindakanTerapi'])->name('kategori-tindakan-terapi');

