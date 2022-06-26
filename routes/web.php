<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\FullCalendarController;


/*
 * Global Routes
 *
 * Routes that are used between both frontend and backend.
 */
 
// Switch between the included languages
Route::get('lang/{lang}', [LocaleController::class, 'change'])->name('locale.change');

/*
 * Frontend Routes
 */
Route::group(['as' => 'frontend.'], function () {
    includeRouteFiles(__DIR__ . '/frontend/');
});

/*
 * Backend Routes
 *
 * These routes can only be accessed by users with type `admin`
 */

//Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
//    includeRouteFiles(__DIR__ . '/backend/');
//});

Route::prefix('admin')->as('admin.')->middleware(['auth'])->group(function () {
    includeRouteFiles(__DIR__ . '/backend/');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    includeRouteFiles(__DIR__.'/backend/');
});



Route::get('calendar/index', [CalendarController::class, 'index'])->name('calendar.index');
Route::post('calendar', [CalendarController::class, 'store'])->name('calendar.store');

Route::patch('calendar/update/{id}', [CalendarController::class, 'update'])->name('calendar.update');
Route::delete('calendar/destroy/{id}', [CalendarController::class, 'destroy'])->name('calendar.destroy');
//Route::patch('calendar/action/{id}', [CalendarController::class, 'action'])->name('calendar.action');