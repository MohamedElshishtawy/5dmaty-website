<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\SocialAuthController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;

Livewire::setUpdateRoute(function ($handle) {
    return Route::post(env('APP_ASSET').'/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(env('APP_ASSET').'/livewire/livewire.js', $handle);
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/auth/google', [SocialAuthController::class, 'googleRedirect'])->name('google.redirect');
Route::get('/auth/google/callback', [SocialAuthController::class, 'googleCallback'])->name('google.callback');

// Public property routes
Route::get('real-estate', [PropertyController::class, 'publicIndex'])->name('properties.index');
Route::get('real-estate/{property:slug}', [PropertyController::class, 'show'])->name('properties.show');

// Admin area
Route::prefix('dashboard')->middleware(['auth', 'role:superadmin|admin'])->name('admin.')->group(function () {
    Route::view('/', 'admin.dashboard')->name('dashboard');
    // keep users link to avoid layout route errors
    Route::view('users', 'admin.users.index')->name('users.index');
    Route::get('users/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
    Route::post('users', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
    Route::get('users/{user}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');


    Route::resource('categories', CategoryController::class);
    Route::get('properties', [PropertyController::class, 'index'])->name('properties.index');
});

//Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Auth::routes();
