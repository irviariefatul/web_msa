<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\AllowanceController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\PerhitunganGajiController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\OperasionalController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/profil',[ProfilController::class, 'index'])->name('profil');

// Admin
Route::resource('/users', UserController::class);

Route::resource('/permintaans', PermintaanController::class);

// update status
Route::post('/permintaans/update-status/{id}', [PermintaanController::class, 'updateStatus'])->name('permintaans.updateStatus');

Route::resource('/salaries', SalaryController::class);

Route::resource('/allowances', AllowanceController::class);

Route::resource('/qualifications', QualificationController::class);

Route::resource('/perhitungan_gajis', PerhitunganGajiController::class);

Route::resource('/investments', InvestmentController::class);

Route::resource('/operasionals', OperasionalController::class);

