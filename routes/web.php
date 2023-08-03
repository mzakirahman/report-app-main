<?php

use App\Http\Controllers\Backsite\ChatController;
use App\Http\Controllers\Backsite\DashboardController;
use App\Http\Controllers\Backsite\DosenController;
use App\Http\Controllers\Backsite\KelasController;
use App\Http\Controllers\Backsite\LaporanController;
use App\Http\Controllers\Backsite\MahasiswaController;
use App\Http\Controllers\Backsite\PermissionController;
use App\Http\Controllers\Backsite\PositionController;
use App\Http\Controllers\Backsite\RoleController;
use App\Http\Controllers\Backsite\TypeUserController;
use App\Http\Controllers\Backsite\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

// Backsite Page Start
Route::group(['prefix' => 'backsite', 'as' => 'backsite.', 'middleware' => ['auth:sanctum', 'verified']], function(){

    // Dasboard Page
    Route::resource('dashboard', DashboardController::class);

    // Permission Page
    Route::resource('permission', PermissionController::class);

    // Role Page
    Route::resource('role', RoleController::class);
    
    // User Page
    Route::resource('user', UserController::class);

    // Kelas Page
    Route::resource('kelas', KelasController::class);
    
    // Position Page
    Route::resource('position', PositionController::class);

    // Type User Page
    Route::resource('type_user', TypeUserController::class);
    
    // Chat Page
    Route::resource('chat', ChatController::class);
    
    // Dosen Page
    Route::resource('dosen', DosenController::class);

    // Laporan Page
    Route::resource('laporan', LaporanController::class);
    Route::put('/laporan/status_kaprodi/{id}', [LaporanController::class, 'status_kaprodi'])->name('laporan.status_kaprodi');
    Route::put('/laporan/status_kajur/{id}', [LaporanController::class, 'status_kajur'])->name('laporan.status_kajur');
    Route::get('/laporan/{laporan}/revisi', [LaporanController::class, 'revisi'])->name('laporan.revisi');
    Route::put('/laporan/confirm_revisi/{laporan}', [LaporanController::class, 'confirm_revisi'])->name('laporan.confirm_revisi');
    Route::get('/laporan/{laporan}/pdf', [LaporanController::class, 'pdf'])->name('laporan.pdf');
    
    // Mahasiswa Page
    Route::resource('mahasiswa', MahasiswaController::class);
});
// Backsite Page End
