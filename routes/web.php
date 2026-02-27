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

Route::get('/pets/{pet}/visit/create', [VisitController::class, 'create'])
    ->name('visits.create');

Route::prefix('api')
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class])
    ->group(function () {
        Route::get('/pets', [PetController::class, 'apiIndex']);
        Route::post('/pets', [PetController::class, 'apiStore']);
        Route::put('/pets/{id}', [PetController::class, 'apiUpdate']);
        Route::delete('/pets/{id}', [PetController::class, 'apiDelete']);
    });