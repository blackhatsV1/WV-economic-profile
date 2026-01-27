<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard.regional-overview');
});


// Hidden Admin Portal
Route::prefix('admin-portal-access')->group(function () {
    Route::get('/login', [App\Http\Controllers\AdminController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [App\Http\Controllers\AdminController::class, 'login'])->name('admin.login.post');
    Route::post('/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');

    Route::middleware(['admin'])->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/page/{page}', [App\Http\Controllers\AdminController::class, 'editPage'])->name('admin.page.edit');
        Route::post('/kpi/{kpi}', [App\Http\Controllers\AdminController::class, 'updateKpi'])->name('admin.kpi.update');
        // Future CRUD routes will go here
    });
});
Route::prefix('dashboard')->group(function () {
    Route::get('/regional-overview', [App\Http\Controllers\DashboardController::class, 'regionalOverview'])->name('dashboard.regional-overview');
    Route::get('/industry-contribution', [App\Http\Controllers\DashboardController::class, 'industryContribution'])->name('dashboard.industry-contribution');
    Route::get('/business-profile', [App\Http\Controllers\DashboardController::class, 'businessProfile'])->name('dashboard.business-profile');
    Route::get('/workforce-education', [App\Http\Controllers\DashboardController::class, 'workforceEducation'])->name('dashboard.workforce-education');
    Route::get('/infrastructure', [App\Http\Controllers\DashboardController::class, 'infrastructure'])->name('dashboard.infrastructure');
    Route::get('/priority-industries', [App\Http\Controllers\DashboardController::class, 'priorityIndustries'])->name('dashboard.priority-industries');
});

