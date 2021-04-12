<?php

use App\Http\Livewire\EventPage;
use App\Http\Livewire\MessagePage;
use App\Http\Livewire\TemplatePage;
use App\Http\Livewire\ApplicantPage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
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
    //Applicant pages
    Route::get('/applicants', ApplicantPage::class)->name('applicant.home');
    Route::resource('applicant', ApplicantController::class);
    Route::resource('applicant.guardian', GuardianController::class);

    //Template pages
    Route::get('/template', TemplatePage::class)->name('template');

    //Message page
    Route::get('/message', MessagePage::class)->name('message');
    Route::post('/message', [MailController::class, 'create'])->name('message.create');

    //Event page
    Route::get('/events', EventPage::class)->name('event');
});


Route::get('signaturepad', [SignaturePadController::class, 'index']);
Route::post('signaturepad', [SignaturePadController::class, 'upload'])->name('signaturepad.upload');


Route::get('/form', [FormController::class, 'index']);
Route::post('/form', [FormController::class, 'submit'])->name('form.submit');

Route::get('thank-you', function(){ 
    return view('form-success');
})->name('success');