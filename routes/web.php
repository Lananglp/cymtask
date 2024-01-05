<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\TokoController;

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

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    
    Route::get('/register', function () {
        return view('register');
    });
    
    Route::post('/register', [LoginController::class, 'register'])->name('register');
    Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
});

Route::middleware('IsLogin')->group(function () {

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/dashboard',[TugasController::class, 'dashboard'])->name('Dashboard');
    Route::get('/tugas/{id}/show',[TugasController::class, 'show'])->name('Detail Tugas');
    Route::get('/tugas/create',[TugasController::class, 'create'])->name('Buat Tugas');
    Route::post('/tugas',[TugasController::class, 'store'])->name('store');
    Route::get('/tugas/{id}/edit',[TugasController::class, 'edit'])->name('Edit Tugas');
    Route::post('/tugas/{id}/update',[TugasController::class, 'update'])->name('update');
    Route::post('/tugas/{id}/setujui',[TugasController::class, 'setujui'])->name('setujui');
    Route::delete('/tugas/{id}/destroy',[TugasController::class, 'destroy'])->name('destroy');
    Route::post('/tugas/tugasConfig',[TugasController::class, 'tugasConfig']);

    Route::get('/tugas/tugasAll',[TugasController::class, 'tugasAll'])->name('Semua Tugas');
    Route::get('/tugas/tugasProgress',[TugasController::class, 'tugasProgress'])->name('Tugas Berproses');
    Route::get('/tugas/tugasTerlambat',[TugasController::class, 'tugasTerlambat'])->name('Tugas Terlambat');
    Route::get('/tugas/tugasSelesai',[TugasController::class, 'tugasSelesai'])->name('Tugas Selesai');

    Route::get('/users', [UserController::class, 'index'])->name('Akun');
    Route::get('/users/create', [UserController::class, 'create'])->name('Tambah Akun');
    Route::post('/users', [UserController::class, 'store'])->name('store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('Edit Akun');
    Route::post('/users/{id}/update', [UserController::class, 'update'])->name('update');
    Route::get('/users/{id}/editPassword', [UserController::class, 'editPassword'])->name('Edit password');
    Route::post('/users/{id}/updatePassword', [UserController::class, 'updatePassword'])->name('updatePassword');
    Route::delete('/users/{id}/destroy', [UserController::class, 'destroy'])->name('destroy');

    Route::get('/absensi', [AbsensiController::class, 'index'])->name('Absensi');
    Route::post('/absensi/store', [AbsensiController::class, 'store'])->name('store');
    Route::post('/absensi/{id}/update', [AbsensiController::class, 'update'])->name('update');
    Route::get('/absensi/alasan', [AbsensiController::class, 'alasan'])->name('Alasan');
    Route::post('/absensi/reportAlasan', [AbsensiController::class, 'reportAlasan'])->name('reportAlasan');
    Route::get('/absensi/pengaturan', [AbsensiController::class, 'AturAbsensi'])->name('Pengaturan Absensi');
    Route::post('/absensi/setWaktu', [AbsensiController::class, 'setWaktu']);
    Route::get('/absensi/rekapAbsensi', [AbsensiController::class, 'rekapAbsensi'])->name('Rekap Absensi');
    Route::get('/absensi/{id}/show', [AbsensiController::class, 'show'])->name('Detail Absensi');

    Route::get('/chat', [ChatController::class, 'index'])->name('Chat Grup');
    Route::post('/chat', [ChatController::class, 'store']);

    Route::get('/toko', [TokoController::class, 'index'])->name('Toko');
    Route::get('/toko/show', [TokoController::class, 'show'])->name('Toko Detail');

    Route::post('/komentar', [TugasController::class, 'komentar'])->name('komentar');
});