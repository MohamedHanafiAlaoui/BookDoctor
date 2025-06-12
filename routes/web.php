<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;



Route::middleware('guest')->group(function () {
Route::get('/', function () {
    return view('welcome');
});



Route::get('/inscription', [AuthController::class, 'showRegisterForm'])->name('inscription');
Route::post('/inscription', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showloginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');

});


Route::middleware([ 'auth','isadmin'])->group(function () {
    // Routes des admins
});

Route::middleware(['auth','ismedecin'])->group(function () {
    // Routes des médecins
});

Route::middleware(['auth','ispatient'])->group(function () {

});

    Route::get('/profil ', function(){return view('patients.profil.index');});
    Route::get('/Historique ', function(){return view('patients.Historique');});
    Route::get('/rendez-vous ', function(){return view('patients.rendez-vous');});
