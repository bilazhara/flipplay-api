<?php

use App\Http\Controllers\MediaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// CRUD Media (index, show, store, update, destroy)
Route::apiResource('media', MediaController::class)->parameters(['media' => 'media']);

// Pengguna
Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::patch('/users/{user}', [UserController::class, 'update']);

// Koleksi media milik pengguna (custom action yang mengubah relasi)
Route::get('/users/{user}/collection', [UserController::class, 'collection']);
Route::post('/users/{user}/collection', [UserController::class, 'addToCollection']);
Route::delete('/users/{user}/collection/{media}', [UserController::class, 'removeFromCollection']);