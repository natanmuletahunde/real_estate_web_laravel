<?php
use App\Http\Controllers\Props\PropertiesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// displying props by rent and buy 

Route::get('props/type/Buy', [PropertiesController::class, 'propsBuy'])->name('buy.prop');

Route::get('props/type/rent', [PropertiesController::class, 'propsRent'])->name('rent.prop');
  

