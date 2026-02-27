<?php

use App\Http\Controllers\PetController;
use Illuminate\Support\Facades\Route;

Route::get('/pets', [PetController::class, 'apiIndex']);
Route::post('/pets', [PetController::class, 'apiStore']);
Route::put('/pets/{id}', [PetController::class, 'apiUpdate']);
Route::delete('/pets/{id}', [PetController::class, 'apiDelete']);

