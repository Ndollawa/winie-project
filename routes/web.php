<?php

use App\Http\Controllers\Diagnose\DiagnoseController;
use App\Http\Controllers\Prescription\PrescriptionController;
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

Route::get('/', 'Auth\LoginController@index')->name('login');
Route::get('register', 'Auth\LoginController@register')->name('register');
Route::post('register-action', 'Auth\LoginController@registerAction')->name('register-action');

Route::get('dashboard', 'Dashboard\DashboardController@index')->name('dashboard.home');

Route::get('/select-symptoms', [DiagnoseController::class, 'showForm'])->name('symptoms.form');
Route::post('/get-top-sicknesses', [DiagnoseController::class, 'getTopSicknesses'])->name('symptoms.get_top_sicknesses');
Route::get('/get-symptoms', [DiagnoseController::class, 'getSymptoms'])->name('symptoms.get_symptoms');

Route::get('/prescription', [PrescriptionController::class, 'index'])->name('prescription');


Route::post('loginAction', 'Auth\LoginController@loginAction')->name('login.verify');
Route::get('logout', 'Auth\LoginController@logOut')->name('logout');
