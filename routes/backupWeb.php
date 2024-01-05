<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\AbsensiController;

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

    Route::get('/dashboard',[TugasController::class, 'dashboard'])->name('dashboard');
    Route::get('/tugas/{id}/show',[TugasController::class, 'show'])->name('show');
    Route::get('/tugas/create',[TugasController::class, 'create'])->name('create');
    Route::post('/tugas',[TugasController::class, 'store'])->name('store');
    Route::get('/tugas/{id}/edit',[TugasController::class, 'edit'])->name('edit');
    Route::post('/tugas/{id}/update',[TugasController::class, 'update'])->name('update');
    Route::post('/tugas/{id}/setujui',[TugasController::class, 'setujui'])->name('setujui');
    Route::delete('/tugas/{id}/destroy',[TugasController::class, 'destroy'])->name('destroy');

    Route::get('/tugas/tugasAll',[TugasController::class, 'tugasAll'])->name('tugasAll');
    Route::get('/tugas/tugasProgress',[TugasController::class, 'tugasProgress'])->name('tugasProgress');
    Route::get('/tugas/tugasTerlambat',[TugasController::class, 'tugasTerlambat'])->name('tugasTerlambat');
    Route::get('/tugas/tugasSelesai',[TugasController::class, 'tugasSelesai'])->name('tugasSelesai');

    Route::get('/users', [UserController::class, 'index'])->name('index');
    Route::get('/users/create', [UserController::class, 'create'])->name('create');
    Route::post('/users', [UserController::class, 'store'])->name('store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('edit');
    Route::post('/users/{id}/update', [UserController::class, 'update'])->name('update');
    Route::get('/users/{id}/editPassword', [UserController::class, 'editPassword'])->name('editPassword');
    Route::post('/users/{id}/updatePassword', [UserController::class, 'updatePassword'])->name('updatePassword');
    Route::delete('/users/{id}/destroy', [UserController::class, 'destroy'])->name('destroy');

    Route::get('/absensi', [AbsensiController::class, 'index'])->name('index');
    Route::post('/absensi/store', [AbsensiController::class, 'store'])->name('store');
    Route::post('/absensi/{id}/update', [AbsensiController::class, 'update'])->name('update');
    Route::get('/absensi/alasan', [AbsensiController::class, 'alasan'])->name('alasan');
    Route::post('/absensi/reportAlasan', [AbsensiController::class, 'reportAlasan'])->name('reportAlasan');

    Route::post('/komentar', [TugasController::class, 'komentar'])->name('komentar');
});