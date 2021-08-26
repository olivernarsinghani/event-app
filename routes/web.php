<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

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

Route::get('/', [EventController::class,'eventList'])->name('event-list');
Route::get('/add-event', [EventController::class,'addEvent'])->name('add-event');
Route::post('/save-event', [EventController::class,'addEvent'])->name('save-event');

Route::get('/edit-event/{id}', [EventController::class,'getEventDetails'])->name('edit-event');
Route::get('/delete-event/{id}', [EventController::class,'deleteEvent'])->name('delete-event');


Route::get('/view-event/{id}', [EventController::class,'viewEvent'])->name('view-event');