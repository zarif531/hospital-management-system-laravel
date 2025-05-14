<?php

use App\Http\Controllers\Users\DoctorLoginController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Cruds\AppointmentController;
use App\Http\Controllers\Cruds\DiagnosticController;
use App\Http\Controllers\Cruds\DoctorController;
use App\Http\Controllers\Cruds\LabController;
use App\Http\Controllers\Cruds\PatientController;
use App\Http\Controllers\Cruds\RayController;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::post('doctor/login', [DoctorLoginController::class, 'store'])->name('doctor.login');

    Route::group([
        'prefix' => 'doctor',
        'middleware' => 'auth:doctor',
        'as' => 'doctor.'
    ], function () {
        ################################### Auth ###################################

        Route::get('dashboard', [DoctorLoginController::class, 'index'])->name('dashboard');
        Route::post('logout', [DoctorLoginController::class, 'destroy'])->name('logout');

        ################################### Profile ###################################

        Route::group(['prefix' => 'profile'], function () {
            Route::get('', [DoctorController::class, 'show'])->name('show');
            Route::put('', [DoctorController::class, 'update'])->name('update');
            Route::put('password', [DoctorController::class, 'updatePassword'])->name('update.password');
            Route::delete('', [DoctorController::class, 'destroy'])->name('destroy');
        });

        ################################### Cruds ###################################
        /********************************** Patients **********************************/

        Route::group(['prefix' => 'patients'], function () {
            Route::get('', [PatientController::class, 'index'])->name('patients.index');
            Route::get('{patient}', [PatientController::class, 'show'])->name('patients.show');
            Route::get('{patient}/records', [PatientController::class, 'showRecords'])->name('patients.records');
        });

        /********************************** Appointments **********************************/

        Route::group(['prefix' => 'appointments'], function () {
            Route::get('{status}', [AppointmentController::class, 'index'])->name('appointments.index');
            Route::put('{appointment}/approve', [AppointmentController::class, 'approve'])->name('appointments.approve');
            Route::put('{appointment}/refuse', [AppointmentController::class, 'refuse'])->name('appointments.refuse');
        });

        /********************************** Diagnostics **********************************/

        Route::group(['prefix' => 'diagnostics'], function () {
            Route::get('{status}', [DiagnosticController::class, 'index'])->name('diagnostics.index');
            Route::put('{diagnostic}/diagnosis', [DiagnosticController::class, 'diagnosis'])->name('diagnostics.diagnosis');
            Route::put('{diagnostic}/redirect-to-ray', [DiagnosticController::class, 'redirectToRay'])->name('diagnostics.redirect-to-ray');
            Route::put('{diagnostic}/redirect-to-lab', [DiagnosticController::class, 'redirectToLab'])->name('diagnostics.redirect-to-lab');
        });

        /********************************** Labs **********************************/

        Route::group(['prefix' => 'labs'], function () {
            Route::get('{lab}/gallery', [LabController::class, 'gallery'])->name('labs.gallery');
        });

        /********************************** Rays **********************************/

        Route::group(['prefix' => 'rays'], function () {
            Route::get('{ray}/gallery', [RayController::class, 'gallery'])->name('rays.gallery');
        });
    });
});

/**
 * These names I'll not use.
 * It's just to not be like the admin routes file.
 * I just want different urls and different guards.
 */
