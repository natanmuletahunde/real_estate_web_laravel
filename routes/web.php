<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Props\PropertiesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [PropertiesController::class, 'index'])->name('home');
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
  

// displying props by  hometype
   

Route::get('props/home-type/{hometype}', [PropertiesController::class, 'displayByHomeType'])->name('display.prop.hometytpe');


// displying props by  price asc and desc 
   

Route::get('props/price-asc', [PropertiesController::class, 'priceAsc'])->name('price.asc.prop');
Route::get('props/price-desc', [PropertiesController::class, 'priceDesc'])->name('price.desc.prop');

// display contact and about pages

// user pages
Route::get('users/all-req uests', [PropertiesController::class, 'priceDesc'])->name('price.desc.prop');




Route::get('contact', [HomeController::class, 'contact'])->name('contact');
Route::get('about', [HomeController::class, 'about'])->name('about');
 


