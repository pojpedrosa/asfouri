<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\MagicLinkController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/abordagem', 'pages.approach')->name('approach');
Route::view('/servicos', 'pages.services')->name('services');
Route::view('/projetos', 'pages.work')->name('work');
Route::view('/sobre', 'pages.about')->name('about');

Route::get('/contacto', [ContactController::class, 'show'])->name('contact');
Route::post('/contacto', [ContactController::class, 'submit'])
    ->middleware('throttle:6,1')
    ->name('contact.submit');

Route::get('/locale/{locale}', LocaleController::class)
    ->whereIn('locale', ['pt', 'en'])
    ->name('locale.switch');

// Passwordless "magic link" login for the back office.
Route::get('/magic-login', [MagicLinkController::class, 'show'])->name('magic.request');
Route::post('/magic-login', [MagicLinkController::class, 'send'])
    ->middleware('throttle:6,1')
    ->name('magic.send');
Route::get('/magic-login/{token}', [MagicLinkController::class, 'verify'])
    ->where('token', '[A-Za-z0-9]+')
    ->name('magic.verify');
