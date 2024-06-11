<?php
use App\Http\Controllers\LandingController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PeminjamanBarangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SliderController;
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
//Landing
Route::get('/', [LandingController::class, 'index'])->name('landing');

//Auth
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');

Route::middleware('auth')->group(function(){
    Route::get('/tes', [LandingController::class, 'tes'])->name('landingpage.test');
    Route::post('/peminjaman-ruangan-cek', [LandingController::class, 'showAvailableRooms'])->name('show.available.rooms');
    Route::post('/peminjaman-barang-cek', [LandingController::class, 'showAvailableBarangs'])->name('show.available.barangs');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('/peminjaman',[LandingController::class,'store'])->name('landingpage.peminjaman.store');
    Route::get('/histori', [LandingController::class, 'histori'])->name('landingpage.histori');
    Route::delete('/histori/{id}',[LandingController::class,'destroy'])->name('landingpage.histori.destroy');
    Route::get('/profile', [ProfileController::class, 'profile'])->name('landingpage.profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('landingpage.editprofile');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/change-password', [ProfileController::class, 'pass'])->name('landingpage.change-password');
    Route::post('/change-password', [ProfileController::class, 'change'])->name('change-password.update');

    Route::middleware('role:admin|dekan|rumah tangga|perkuliahan')->group(function(){
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/calendar', [DashboardController::class, 'calendar'])->name('dashboardpage.calendar');
        Route::get('/ruangan', [RuangController::class, 'index'])->name('dashboardpage.ruangan.index');
        Route::get('/barang', [BarangController::class, 'index'])->name('dashboardpage.barang.index');

        Route::get('/ruangan/create', [RuangController::class, 'create'])->name('dashboardpage.ruangan.create');
        Route::post('/ruangan',[RuangController::class,'store'])->name('dashboardpage.ruangan.store');
        Route::get('/ruangan/edit/{id}',[RuangController::class,'edit'])->name('dashboardpage.ruangan.edit');
        Route::put('/ruangan/{id}',[RuangController::class,'update'])->name('dashboardpage.ruangan.update');
        Route::delete('/ruangan/{id}',[RuangController::class,'destroy'])->name('dashboardpage.ruangan.destroy');
        
        Route::get('/barang/create', [BarangController::class, 'create'])->name('dashboardpage.barang.create');
        Route::post('/barang',[BarangController::class,'store'])->name('dashboardpage.barang.store');
        Route::get('/barang/edit/{id}',[BarangController::class,'edit'])->name('dashboardpage.barang.edit');
        Route::put('/barang/{id}',[BarangController::class,'update'])->name('dashboardpage.barang.update');
        Route::delete('/barang/{id}',[BarangController::class,'destroy'])->name('dashboardpage.barang.destroy');

        Route::get('/peminjamans', [PeminjamanController::class, 'index'])->name('dashboardpage.peminjaman.index');
        Route::get('/peminjamans/create', [PeminjamanController::class, 'create'])->name('dashboardpage.peminjaman.create');
        Route::post('/peminjamans',[PeminjamanController::class,'store'])->name('dashboardpage.peminjaman.store');
        Route::get('/peminjamans/edit/{id}',[PeminjamanController::class,'edit'])->name('dashboardpage.peminjaman.edit');
        Route::put('/peminjamans/{id}',[PeminjamanController::class,'update'])->name('dashboardpage.peminjaman.update');
        Route::delete('/peminjamans/{id}',[PeminjamanController::class,'destroy'])->name('dashboardpage.peminjaman.destroy');
        Route::post('/peminjamans/{id}/accept', [PeminjamanController::class, 'accept'])->name('dashboardpage.peminjaman.accept');
        Route::post('/peminjamans/{id}/reject', [PeminjamanController::class, 'reject'])->name('dashboardpage.peminjaman.reject');
        Route::get('/peminjamans/datacsv', [PeminjamanController::class, 'datacsv'])->name('dashboardpage.peminjaman.datacsv');
        Route::post('/peminjamans/csv',[PeminjamanController::class,'importCSV'])->name('dashboardpage.peminjaman.csv');
        Route::get('/download-csv', [PeminjamanController::class,'downloadCSV'])->name('download.csv');
        
        Route::get('/peminjamanbarangs', [PeminjamanBarangController::class, 'index'])->name('dashboardpage.peminjamanbarang.index');
        Route::get('/peminjamanbarangs/create', [PeminjamanBarangController::class, 'create'])->name('dashboardpage.peminjamanbarang.create');
        Route::post('/peminjamanbarangs',[PeminjamanBarangController::class,'store'])->name('dashboardpage.peminjamanbarang.store');
        Route::get('/peminjamanbarangs/edit/{id}',[PeminjamanBarangController::class,'edit'])->name('dashboardpage.peminjamanbarang.edit');
        Route::put('/peminjamanbarangs/{id}',[PeminjamanBarangController::class,'update'])->name('dashboardpage.peminjamanbarang.update');
        Route::delete('/peminjamanbarangs/{id}',[PeminjamanBarangController::class,'destroy'])->name('dashboardpage.peminjamanbarang.destroy');
        Route::post('/peminjamanbarangs/{id}/accept', [PeminjamanBarangController::class, 'accept'])->name('dashboardpage.peminjamanbarang.accept');
        Route::post('/peminjamanbarangs/{id}/reject', [PeminjamanBarangController::class, 'reject'])->name('dashboardpage.peminjamanbarang.reject');
        Route::get('/peminjamanbarangs/datacsv', [PeminjamanBarangController::class, 'datacsv'])->name('dashboardpage.peminjamanbarang.datacsv');
        Route::post('/peminjamanbarangs/csv',[PeminjamanBarangController::class,'importCSV'])->name('dashboardpage.peminjamanbarang.csv');
        Route::get('/download-csv', [PeminjamanBarangController::class,'downloadCSV'])->name('download.csv');

        Route::get('/slider', [SliderController::class, 'index'])->name('dashboardpage.denah.index');
        Route::get('/slider/create', [SliderController::class, 'create'])->name('dashboardpage.denah.create');
        Route::post('/slider', [SliderController::class, 'store'])->name('dashboardpage.denah.store');
        Route::get('/slider/edit/{id}', [SliderController::class, 'edit'])->name('dashboardpage.denah.edit');
        Route::put('/slider/{id}', [SliderController::class, 'update'])->name('dashboardpage.denah.update');
        Route::delete('/slider/{id}', [SliderController::class, 'destroy'])->name('dashboardpage.denah.destroy');

    });
    Route::middleware('role:admin')->group(function(){
        Route::get('/user', [UserController::class, 'index'])->name('dashboardpage.user.index');
        Route::get('/user/create', [UserController::class, 'create'])->name('dashboardpage.user.create');
        Route::post('/user',[UserController::class,'store'])->name('dashboardpage.user.store');
        Route::get('/user/edit/{id}',[UserController::class,'edit'])->name('dashboardpage.user.edit');
        Route::put('/user/{id}',[UserController::class,'update'])->name('dashboardpage.user.update');
        Route::delete('/user/{id}',[UserController::class,'destroy'])->name('dashboardpage.user.destroy');
    });

    // Route::middleware('role:')
});
Route::get('/denah', [LandingController::class, 'denah'])->name('landingpage.denah');
Route::get('/kontak', [LandingController::class, 'kontak'])->name('landingpage.kontak');
Route::get('/login', [LandingController::class, 'login'])->name('landingpage.login');
Route::get('/peminjaman', [LandingController::class, 'peminjaman'])->name('landingpage.peminjaman');
Route::get('/peminjamanbarang', [LandingController::class, 'peminjamanBarang'])->name('landingpage.peminjamanbarang');

