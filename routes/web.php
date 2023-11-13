<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManajemenController;
use App\Http\Controllers\DashboardJKN;
use App\Http\Controllers\DashboardKaruController;
use App\Http\Controllers\formController;
use Illuminate\Auth\Events\Login;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\ApiController;

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







Route::middleware(['guest'])->group(function () {


// Process Login
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'auth']);
 

//  Process Register
    Route::prefix('register')->group(function () {
    Route::get('/', [RegisterController::class, 'index']);
    Route::post('/create-register', [RegisterController::class, 'create']);

   
    });

    
    Route::get('/dashboard-manajemen', [ManajemenController::class, 'index']);
Route::get('/manajemen-datatable/datatable', [ManajemenController::class, 'datatable']);
});




 // Dashboard
Route::middleware(['auth'])->group(function () {

   
    //  Role Admin
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index']);
        Route::get('/datatable', [DashboardController::class, 'datatable']);
        Route::get('/document-detail/{id}', [DashboardController::class, 'docDetail']);
        Route::get('/history-patient/{id}', [DashboardController::class, 'historyPatient']);
        Route::get('/get-file/{id}', [DashboardController::class, 'getFile']);
        Route::post('create-data', [DashboardController::class, 'create']);
        Route::get('/edit-document/{id}', [DashboardController::class, 'editDocument']);
        Route::patch('/update-document/{id}', [DashboardController::class, 'updateDocument']);
        Route::delete('/delete-document/{id}', [DashboardController::class, 'destroyDocument']);
        Route::patch('/revisi-document/{id}/{patientId}', [DashboardController::class, 'revisiDocument']);
        Route::put('/edit-status-pasien/{id}', [DashboardController::class, 'editStatusPasien']);
        Route::put('/ajukan-dokumen-status/{id}', [DashboardController::class, 'ajukanDokumenStatus']);
        Route::put('/ajukan-dokumen-ulang/{id}', [DashboardController::class, 'ajukanDokumenUlang']);
        // sync data
        Route::get('/sync-data', [ApiController::class, 'syncData']);
        Route::get('/sync-single-data', [ApiController::class, 'syncSingleData']);
        Route::put('/pindahkan-pasien', [DashboardController::class, 'pindahkanPasien']);
        });


 //  Role JKN
        Route::prefix('dashboard-jkn')->group(function () {
            Route::get('/', [DashboardJKN::class, 'index']);
            Route::get('/datatable', [DashboardJKN::class, 'datatable']);
            Route::get('/document-detail/{id}', [DashboardJKN::class, 'docDetail']);
            Route::get('/history-patient/{id}', [DashboardJKN::class, 'historyPatient']);
            Route::post('create-data', [DashboardJKN::class, 'create']);
            Route::get('/edit-document/{id}', [DashboardJKN::class, 'editDocument']);
            Route::put('/revisi-document/{id}', [DashboardJKN::class, 'revisiDocument']);
            Route::put('/edit-revisi-document/{id}', [DashboardJKN::class, 'editRevisiDocument']);
            Route::put('/validasi-note-document/{id}', [DashboardJKN::class, 'validasiNoteDocument']);
            Route::put('/update-ver/{id}', [DashboardJKN::class, 'updateVer']);
            Route::put('/update-ver-all/{id}', [DashboardJKN::class, 'updateVerAll']);
            Route::put('/update-grouping-all/{id}', [DashboardJKN::class, 'updateGroupingAll']);
            Route::delete('/delete-document/{id}', [DashboardJKN::class, 'destroyDocument']);
            Route::put('/update-status-document/{id}', [DashboardJKN::class, 'updateStatusDocument']);
            Route::put('/update-status-patient', [DashboardJKN::class, 'updateStatusPatient']);
          
            });


 //  Role kepala ruangan
        Route::prefix('dashboard-karu')->group(function () {
            Route::get('/', [DashboardKaruController::class, 'index']);
            Route::get('/datatable', [DashboardKaruController::class, 'datatable']);
            Route::get('/document-detail/{id}', [DashboardKaruController::class, 'docDetail']);
            Route::get('/history-patient/{id}', [DashboardKaruController::class, 'historyPatient']);
            Route::post('create-data', [DashboardKaruController::class, 'create']);
            Route::get('/edit-document/{id}', [DashboardKaruController::class, 'editDocument']);
            Route::put('/update-document/{id}', [DashboardKaruController::class, 'updateDocument']);
            Route::put('/update-verify/{id}', [DashboardKaruController::class, 'updateVerify']);
            Route::put('/update-verify-all/{id}', [DashboardKaruController::class, 'updateVerifyAll']);
            Route::delete('/delete-document/{id}', [DashboardKaruController::class, 'destroyDocument']);
            Route::get('/check-status/{$id}', [DashboardKaruController::class, 'checkStatus']);
            });


            Route::get('/arsip', [DashboardJKN::class, 'arsip']);
            Route::get('/datatable-arsip', [DashboardJKN::class, 'datatableArsip']);
    // Logout
            Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
       
});




// Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
// Route::post('/login', 'Auth\LoginController@login');
// Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


