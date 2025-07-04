<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalendrierController;
use App\Http\Controllers\MedecinController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;



Route::get('/redirect', [AuthController::class, 'redirectBasedOnRole'])
    ->middleware('auth')
    ->name('dashboard.redirect');

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard.redirect');
    }
    return view('welcome');
})->name('home');

Route::middleware('guest')->group(function () {



    Route::get('/inscription', [AuthController::class, 'showRegisterForm'])->name('inscription');
    Route::post('/inscription', [AuthController::class, 'register'])->name('register');

    Route::get('/login', [AuthController::class, 'showloginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

});




Route::middleware(['auth', 'isadmin'])->group(function () {
    // Routes des admins
});



Route::middleware(['auth', 'ismedecin'])->prefix('medecin')->group(function () {
    Route::get('/profil', [MedecinController::class, 'profileMedecin'])->name('medecin.profil.index');
    Route::get('/profil/edit', [MedecinController::class, 'edit'])->name('medecin.profil.edit');
    Route::post('/profil/update', [MedecinController::class, 'update'])->name('medecin.profil.update');


        // 📅 Gestion des calendriers
    Route::get('/calendriers', [CalendrierController::class, 'index'])->name('medecin.calendriers.index');
    Route::get('/calendriers/ajouter', [CalendrierController::class, 'create'])->name('medecin.calendriers.ajouter');
    Route::post('/calendriers', [CalendrierController::class, 'store'])->name('medecin.calendriers.store');




});





Route::middleware(['auth', 'ispatient'])->prefix('patient')->group(function () {
Route::get('/profil', [PatientController::class, 'profilePatient'])->name('patients.profil.index');

Route::get('/profil/edit', [PatientController::class, 'edit'])->name('patients.profil.edit');
Route::post('/profil/update', [PatientController::class, 'update'])->name('patients.profil.update');

Route::get('/Historique ', function () {
    return view('patients.Historique'); });
Route::get('/rendez-vous ', function () {
    return view('patients.rendez-vous'); });
});



Route::get('/agenda ', function () {
    return view('medecin.calendriers.index'); 
});


Route::get('/calendriers ', function () {
    return view('medecin.calendriers.ajouter'); 
});
