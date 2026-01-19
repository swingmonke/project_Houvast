<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\ContestansController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\PouleController;

Route::get('/', function () {
    return view('welcome');
})->name('home');



Route::view('Contestants_list', 'Contestants_list')
    ->middleware(['auth', 'verified'])
    ->name('Contestants_list');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::get('clubs', [ClubController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('clubs');

Route::delete('clubs/{id}', [ClubController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('clubs.destroy');


Route::get('poule', [PouleController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('poule');

Route::get('/poules/{poule}', [PouleController::class, 'show'])
->name('poules.show');


Route::delete('poule/{id}', [PouleController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('poule.destroy');


Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
