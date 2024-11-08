<?php
use App\Http\Controllers\Props\PropertiesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [PropertiesController::class, 'index'])->name('home');
Route::get('/prop-details/{id}', [PropertiesController::class, 'single'])->name('single.prop');

// inserting request 
Route::post('/prop-details/{id}', [PropertiesController::class, 'insertRequests'])->name('insert.request');


