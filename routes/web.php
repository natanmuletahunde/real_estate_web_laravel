<?php
use App\Http\Controllers\Props\PropertiesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [PropertiesController::class, 'index'])->name('home');
Route::get('props/prop-details/{id}', [PropertiesController::class, 'single'])->name('single.prop');
// inserting request 
Route::post('props/prop-details/{id}', [PropertiesController::class, 'insertRequests'])->name('insert.request');

// saving props
Route::post('props/saved-props/{id}', [PropertiesController::class, 'saveProps'])->name('save.prop');



