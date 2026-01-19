<?php

use App\Livewire;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('leads/dashboard', Livewire\Lead\Dashboard::class)
    ->middleware(['auth'])
    ->name('leads.dashboard');

require __DIR__.'/auth.php';
