<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AppController;
use \App\Http\Controllers\AgentsController;
use \App\Http\Controllers\InstallerController;
use \App\Http\Controllers\FunderController;
use \App\Http\Controllers\LeadsController;
use \App\Http\Controllers\AuthController;

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

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login-attempt', [AuthController::class, 'login_attempt'])->name('login_attempt');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/', [AppController::class, 'dashboard'])->name('home');
    Route::resource('agents', AgentsController::class);
    Route::resource('installers', InstallerController::class);
    Route::resource('funders', FunderController::class);
    Route::resource('leads', LeadsController::class);
    Route::get('leads-details/{lead}', [LeadsController::class, 'leads_details'])->name('leads.details');
});
