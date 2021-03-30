<?php

use App\Http\Livewire\ApplicantPage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\GuardianController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\SignaturePadController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/
Route::get('/',function()
{
    return view('welcome');
});


Route::get('send-email', [MailController::class, 'sendEmail']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::get('/applicants', ApplicantPage::class)->name('applicant.home');
    Route::resource('applicant', ApplicantController::class);
    Route::resource('applicant.guardian', GuardianController::class);
});


Route::get('signaturepad', [SignaturePadController::class, 'index']);
Route::post('signaturepad', [SignaturePadController::class, 'upload'])->name('signaturepad.upload');
