<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RankingController;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

// Route::middleware(['guest'])->group(function () {});
/*Route::controller(LoginController::class)->group(function () {
	Route::get('/', 'index');
	Route::get('/login', 'index');
	Route::post('/login', 'authenticate');
})->name('login');*/

Route::redirect('/', 'login');
Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.auth');
Route::resource('register', RegisterController::class)->only(['index', 'store']);

Route::middleware(['auth', 'XSS'])->group(function () {
	Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
	
	Route::get('/datasiswa', [SiswaController::class, 'getDataSiswa'])->name('data.siswa');
	Route::get('/siswa/{siswa}/download', [SiswaController::class, 'download'])->name('siswa.download');
	Route::resource('siswa', SiswaController::class);
	
	Route::get('/datakelas', [KelasController::class, 'getDataKelas'])->name('data.kelas');
	Route::resource('kelas', KelasController::class)->except(['show']);
	
	Route::get('/datamapel', [MapelController::class, 'getDataMapel'])->name('data.mapel');
	Route::resource('mapel', MapelController::class)->except(['show']);
	
	Route::get('/datanilai', [NilaiController::class, 'getDataNilai'])->name('data.nilai');
	Route::resource('nilai', NilaiController::class)->except(['show']);
	
	Route::get('/dataranking', [RankingController::class, 'getDataRanking'])->name('data.ranking');
	Route::get('/ranking', [RankingController::class, 'index'])->name('ranking');
});