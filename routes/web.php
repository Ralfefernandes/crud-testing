<?php

use App\Http\Controllers\UpdateDetailsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Display the form to update details
Route::get('/update-details/{id}', [UpdateDetailsController::class, 'edit'])->name('update-details.edit');

// Display the edit form
Route::get('/edit-form/{id}', [UpdateDetailsController::class, 'showEditForm'])->name('edit-form');


// Display the edit form
Route::get('/edit-details/{id}', [UpdateDetailsController::class, 'showEditForm'])->name('edit-details');

Route::put('/update-details/{id}', [UpdateDetailsController::class, 'update'])->name('update-details.update');

// Show the success page for details updated
Route::get('/details-updated/{id}', [UpdateDetailsController::class, 'contactPersoon'])->name('persoon-updated');

// Show the invalid hash error page
Route::get('/invalid-hash', [UpdateDetailsController::class, 'showInvalidHash'])->name('invalid-hash');

// Route for editing bedrijven details
Route::get('/edit-bedrijven/{id}', [UpdateDetailsController::class, 'editBedrijven'])->name('edit-bedrijven');
Route::put('/update-bedrijven/{id}', [UpdateDetailsController::class, 'updateBedrijven'])->name('update-bedrijven.update');
Route::get('/bedrijven/{id}', [UpdateDetailsController::class, 'showUpdatedBedrijven'])->name('show-updated-bedrijven');

// Add this line for show-updated-adressen route
Route::get('/adressen/{id}', [UpdateDetailsController::class, 'showUpdatedAdressen'])->name('show-updated-adressen');
Route::get('/edit-adressen/{id}', [UpdateDetailsController::class, 'editAdressen'])->name('edit-adressen');
Route::put('/update-adressen/{id}', [UpdateDetailsController::class, 'updateAdressen'])->name('update-adressen.update');
Route::delete('/delete-adressen/{id}/{column}', [UpdateDetailsController::class, 'deleteAdressen'])->name('delete-adressen');

// Delete details
Route::post('/delete-details/{id}', [UpdateDetailsController::class, 'delete'])->name('delete-details');
Route::delete('/delete-column/{id}/{column}', [UpdateDetailsController::class, 'deleteColumn'])->name('delete-column');

// Delete bedrijven field
Route::delete('/delete-bedrijven/{id}/{column}', [UpdateDetailsController::class, 'deleteBedrijven'])->name('delete-bedrijven');


// Download csv files from adressen
Route::get('/download-updated-addresses', [UpdateDetailsController::class, 'downloadUpdatedAddresses'])->name('download-updated-addresses');

// Download csv files for bedrijf gegevens
Route::get('/download-updated-bedrijven', [UpdateDetailsController::class, 'downloadUpdatedBedrijven'])->name('download-updated-bedrijven');

// Download csv files for contactpersonen
Route::get('/download-contactpersonen', [UpdateDetailsController::class, 'downloadContactpersonen'])->name('download-contactpersonen');




