<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListingController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/', [ListingController::class, 'index'])->name('home');
Route::get('/listings/create', [ListingController::class, 'create'])->name('listings.create');
Route::post('/listings', [ListingController::class, 'store'])->name('listings.store');
Route::get('/search_metro', [ListingController::class, 'searchMetro'])->name('search_metro');
Route::get('/listings/{listing}', [ListingController::class, 'show'])->name('listings.show');
Route::get('/listings', [ListingController::class, 'index'])->name('listings.index');
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->name('listings.destroy');
Route::put('/listings/{listing}', [ListingController::class, 'update'])->name('listings.update')->middleware('auth');
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->name('listings.edit')->middleware('auth');


