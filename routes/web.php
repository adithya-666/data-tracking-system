<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\formController;
use Illuminate\Auth\Events\Login;

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
});


 // Dashboard
Route::middleware(['auth'])->group(function () {

   
    //  Process Register
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index']);
        Route::get('/datatable', [DashboardController::class, 'datatable']);
        Route::get('/document-detail/{id}', [DashboardController::class, 'docDetail']);
        Route::get('/history-patient/{id}', [DashboardController::class, 'historyPatient']);
        });

       
});
Route::post('create-data', [formController::class, 'create']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
// Route::post('/login', 'Auth\LoginController@login');
// Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
