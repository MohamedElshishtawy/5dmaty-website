<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\EmployeeProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JobAdminController;
use App\Http\Controllers\Admin\FaqAdminController;
use App\Http\Controllers\LangSwitchController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SocialAuthController;
use App\Models\Category;
use Facebook\Facebook;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;
use Illuminate\Support\Facades\Http;

Livewire::setUpdateRoute(function ($handle) {
    return Route::post(env('APP_ASSET').'/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(env('APP_ASSET').'/livewire/livewire.js', $handle);
});

// Language switcher
Route::post('lang/{lang}', [LangSwitchController::class, 'switchLang'])->name('lang.switch');

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/auth/google', [SocialAuthController::class, 'googleRedirect'])->name('google.redirect');
Route::get('/auth/google/callback', [SocialAuthController::class, 'googleCallback'])->name('google.callback');

// Public property routes
Route::get('real-estate', [PropertyController::class, 'publicIndex'])->name('properties.index');
Route::get('real-estate/{property:slug}', [PropertyController::class, 'show'])->name('properties.show');

// Public job routes
Route::get('jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('jobs/{job:slug}', [JobController::class, 'show'])->name('jobs.show');

// Public categories routes
Route::get('categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');
// Fallback by ID if slug missing (temporary support)
Route::get('categories/id/{category}', [CategoryController::class, 'show'])->name('categories.showById');

// Auth-required job routes
Route::middleware('auth')->group(function () {
    Route::post('jobs', [JobController::class, 'store'])->name('jobs.store');
    Route::post('jobs/{job}/apply', [JobApplicationController::class, 'store'])->name('jobs.apply');
    Route::post('jobs/{job}/toggle-active', [JobController::class, 'toggleActive'])->name('jobs.toggleActive');
    Route::post('jobs/{job}/applications/{application}/status', [JobController::class, 'updateApplicationStatus'])->name('jobs.applications.updateStatus');
    Route::post('employee-profile', [EmployeeProfileController::class, 'upsert'])->name('employee-profile.upsert');
});

// Admin area
Route::prefix('dashboard')->middleware(['auth', 'role:superadmin|admin'])->name('admin.')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    // keep users link to avoid layout route errors
    Route::view('users', 'admin.users.index')->name('users.index');
    Route::delete('users/{user}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');


    Route::resource('categories', CategoryController::class);
    Route::get('properties', [PropertyController::class, 'index'])->name('properties.index');
    
    // Job management routes
    Route::get('jobs', [JobAdminController::class, 'index'])->name('jobs.index');
    Route::post('jobs/{job}/approve', [JobAdminController::class, 'approve'])->name('jobs.approve');
    Route::post('jobs/{job}/reject', [JobAdminController::class, 'reject'])->name('jobs.reject');
    Route::get('jobs/{job}/applications', [JobAdminController::class, 'applications'])->name('jobs.applications');
    Route::delete('jobs/{job}', [JobAdminController::class, 'destroy'])->name('jobs.destroy');
    
    // FAQ management routes
    Route::get('faqs', [FaqAdminController::class, 'index'])->name('faqs.index');

    // Settings
    Route::get('settings', [App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings.index');
    Route::post('settings', [App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('settings.update');
    // Languages management (simple)
    Route::post('languages', [App\Http\Controllers\Admin\LanguageAdminController::class, 'store'])->name('languages.store');
    Route::post('languages/{language}/toggle', [App\Http\Controllers\Admin\LanguageAdminController::class, 'toggle'])->name('languages.toggle');

    // Employee management routes
    Route::get('employees', [App\Http\Controllers\Admin\EmployeeProfileAdminController::class, 'index'])->name('employees.index');
    Route::get('employees/{employee}', [App\Http\Controllers\Admin\EmployeeProfileAdminController::class, 'show'])->name('employees.show');
    Route::delete('employees/{employee}', [App\Http\Controllers\Admin\EmployeeProfileAdminController::class, 'destroy'])->name('employees.destroy');
    Route::post('employees/{employee}/toggle-public', [App\Http\Controllers\Admin\EmployeeProfileAdminController::class, 'togglePublic'])->name('employees.togglePublic');

    // Services are managed within categories page (no standalone services index)
});

//Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Auth::routes();

Route::get('/reviews-test', function () {
     $pageId = 'awlaadelblad'; // Or use your numeric page ID
            $accessToken = env('FACEBOOK_PAGE_ACCESS_TOKEN');

            // Facebook Graph API endpoint for page reviews
            $url = "https://graph.facebook.com/v18.0/{$pageId}/ratings";

            $fb = new Facebook([
                'app_id' => env('FACEBOOK_APP_ID'),
                'app_secret' => env('FACEBOOK_APP_SECRET'),
                'default_access_token' => $accessToken,
            ]);

            // Make the API call using official SDK
            $response = $fb->get(
                "/{$pageId}/ratings",
                $accessToken
            );

            
            $response = Http::get($url, [
                'access_token' => $accessToken,
                'fields' => 'reviewer{name,picture},rating,review_text,created_time'
                ]);
                
                dd($response);
            if ($response->successful()) {
                $data = $response->json();
                return $this->formatReviews($data['data'] ?? []);
            }

            return $this->getDefaultReviews();

       
            return $this->getDefaultReviews();
});
