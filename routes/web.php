<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;
use App\Http\Controllers\VisitController; 
use App\Models\Breed;

Route::resource('pets', PetController::class);

Route::redirect('/', '/pets');

Route::get('/get-breeds/{species}', function ($speciesId) {
    return Breed::where('species_id', $speciesId)->get();
});

// Route Tambah Kunjungan
Route::get('/pets/{pet}/visit/create', [VisitController::class, 'create'])
    ->name('visits.create');

Route::post('/pets/{pet}/visit', [VisitController::class, 'store'])
    ->name('visits.store');