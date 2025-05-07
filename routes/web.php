<?php

use App\Http\Controllers\Admin\AdminDoctorController;
use App\Http\Controllers\Admin\AdminPatientController;
use App\Http\Controllers\Admin\AdminPharmacistController;
use App\Http\Controllers\Admin\AdminPortalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Doctor\DoctorPortalController;
use App\Http\Controllers\Doctor\PrescriptionController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\MedicationController;
use App\Http\Controllers\Pharmacist\PharmacistPortalController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/services', [FrontendController::class, 'services'])->name('services');
Route::get('/join', [FrontendController::class, 'joinUs'])->name('join');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::get('/choose_type_login', [FrontendController::class, 'choose_type_login'])->name('choose_type_login');
Route::get('/choose_type_register', [FrontendController::class, 'choose_type_register'])->name('choose_type_register');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'handleRegister'])->name('register.post');
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('dashboard', [AdminPortalController::class, 'dashboard'])->name('dashboard');
        Route::get('prescriptions', [AdminPortalController::class, 'prescriptions'])->name('prescriptions');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('profile/edit', [AdminPortalController::class, 'editProfile'])->name('profile.edit');
        Route::put('profile', [AdminPortalController::class, 'updateProfile'])->name('profile.update');
        Route::resource('doctors', AdminDoctorController::class);
        Route::resource('pharmacists', AdminPharmacistController::class);
        Route::resource('patients', AdminPatientController::class);
    });
});
Route::prefix('pharmacist')->name('pharmacist.')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [PharmacistPortalController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile', [PharmacistPortalController::class, 'editProfile'])->name('profile.edit');
        Route::put('/profile', [PharmacistPortalController::class, 'updateProfile'])->name('profile.update');
        Route::get('/prescriptions', [PharmacistPortalController::class, 'prescriptions'])->name('prescriptions');
        Route::post('prescriptions/{prescription}/dispense', [PharmacistPortalController::class, 'dispense'])
            ->name('prescriptions.dispense');

    });
});

Route::prefix('doctor')->name('doctor.')->middleware(['auth'])->group(function () {
    Route::middleware('auth')->group(function () {
     Route::get('dashboard', [DoctorPortalController::class, 'dashboard'])->name('dashboard');
        Route::get('profile/edit', [DoctorPortalController::class, 'editProfile'])->name('profile.edit');
        Route::put('profile', [DoctorPortalController::class, 'updateProfile'])->name('profile.update');
        Route::resource('prescriptions', PrescriptionController::class);
});
});


use App\Http\Controllers\Patient\PatientPortalController;

Route::prefix('patient')->name('patient.')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [PatientPortalController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile', [PatientPortalController::class, 'editProfile'])->name('profile.edit');
        Route::put('/profile', [PatientPortalController::class, 'updateProfile'])->name('profile.update');
        Route::get('/prescriptions', [PatientPortalController::class, 'prescriptions'])->name('prescriptions');
        Route::get('/consultations', [PatientPortalController::class, 'consultations'])->name('consultations');
    });
});
Route::middleware('auth')->group(function () {
    Route::resource('medications', MedicationController::class);

    Route::match(['get', 'post'], 'checking_medication', [MedicationController::class, 'checkInteractions'])->name('medications_check');

    Route::resource('chat', ChatController::class);
    Route::get('/chating/get-users', [ChatController::class, 'getUsers'])->name('chat.getUsers');
    Route::get('/chating/getHistory', [ChatController::class, 'getHistory'])->name('chat.getHistory');
});

