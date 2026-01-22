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


Route::prefix('dashboard')->group(function () {
    Route::get('/regional-overview', [App\Http\Controllers\DashboardController::class, 'regionalOverview'])->name('dashboard.regional-overview');
    Route::get('/industry-contribution', [App\Http\Controllers\DashboardController::class, 'industryContribution'])->name('dashboard.industry-contribution');
    Route::get('/business-profile', [App\Http\Controllers\DashboardController::class, 'businessProfile'])->name('dashboard.business-profile');
    Route::get('/workforce-education', [App\Http\Controllers\DashboardController::class, 'workforceEducation'])->name('dashboard.workforce-education');
    Route::get('/infrastructure', [App\Http\Controllers\DashboardController::class, 'infrastructure'])->name('dashboard.infrastructure');
    Route::get('/priority-industries', [App\Http\Controllers\DashboardController::class, 'priorityIndustries'])->name('dashboard.priority-industries');
});

