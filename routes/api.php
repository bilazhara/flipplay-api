<?php

use App\Http\Controllers\MediaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// CRUD Media (index, show, store, update, destroy)
Route::apiResource('media', MediaController::class)->parameters(['media' => 'media']);

// Pengguna & koleksi media (custom action yang mengubah relasi)
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{user}/collection', [UserController::class, 'collection']);
Route::post('/users/{user}/collection', [UserController::class, 'addToCollection']);
Route::delete('/users/{user}/collection/{media}', [UserController::class, 'removeFromCollection']);
