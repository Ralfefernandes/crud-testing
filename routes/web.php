<?php

use App\Http\Controllers\AdresController;
use App\Http\Controllers\BedrijfController;
use App\Http\Controllers\ContactfController;
use App\Http\Controllers\UpdateDetailsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Display the form to update details
Route::get('/update-details/{id}', [UpdateDetailsController::class, 'edit'])->name('update-details.edit');

// Display the edit form
Route::get('/edit-form/{id}', [ContactfController::class, 'showEditForm'])->name('edit-form');
// Display the edit form
Route::get('/edit-details/{id}', [ContactfController::class, 'showEditForm'])->name('edit-details');
Route::put('/update-details/{id}', [ContactfController::class, 'update'])->name('update-details.update');
// Show the success page for details updated
Route::get('/details-updated/{id}', [ContactfController::class, 'contactPersoon'])->name('persoon-updated');
// Show the invalid hash error page
Route::get('/invalid-hash', [ContactfController::class, 'showInvalidHash'])->name('invalid-hash');
// Delete details / Edit form /delete edit-form
Route::post('/delete-details/{id}', [ContactfController::class, 'delete'])->name('delete-details');
Route::delete('/delete-column/{id}/{column}', [ContactfController::class, 'deleteColumn'])->name('delete-column');
// Download csv files for contactpersonen
Route::get('/download-contactpersonen', [ContactfController::class, 'downloadContactpersonen'])->name('download-contactpersonen');

// Route for editing bedrijven details
Route::get('/edit-bedrijven/{id}', [BedrijfController::class, 'editBedrijven'])->name('edit-bedrijven');
Route::put('/update-bedrijven/{id}', [BedrijfController::class, 'updateBedrijven'])->name('update-bedrijven.update');
Route::get('/bedrijven/{id}', [BedrijfController::class, 'showUpdatedBedrijven'])->name('show-updated-bedrijven');
// Delete bedrijven field
Route::delete('/delete-bedrijven/{id}/{column}', [BedrijfController::class, 'deleteBedrijven'])->name('delete-bedrijven');
// Download csv files for bedrijf gegevens
Route::get('/download-updated-bedrijven', [BedrijfController::class, 'downloadUpdatedBedrijven'])->name('download-updated-bedrijven');

// Add this line for show-updated-adressen route
Route::get('/adressen/{id}', [AdresController::class, 'showUpdatedAdressen'])->name('show-updated-adressen');
Route::get('/edit-adressen/{id}', [AdresController::class, 'editAdressen'])->name('edit-adressen');
Route::put('/update-adressen/{id}', [AdresController::class, 'updateAdressen'])->name('update-adressen.update');
Route::delete('/delete-adressen/{id}/{column}', [AdresController::class, 'deleteAdressen'])->name('delete-adressen');
// Download csv files from adressen
Route::get('/download-updated-addresses', [AdresController::class, 'downloadUpdatedAddresses'])->name('download-updated-addresses');





