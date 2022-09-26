<?php

declare(strict_types=1);

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PromoController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

Route::get('/', fn (): Application | Factory | View => view('welcome'))->name('home');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');

Route::middleware('auth')->group(function (): void {
    Route::get('/promo', [PromoController::class, 'getPromo'])->name('promo');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});
