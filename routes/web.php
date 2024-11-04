<?php
use App\Http\Controllers\Props\PropertiesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [PropertiesController::class, 'index'])->name('properties.index');
