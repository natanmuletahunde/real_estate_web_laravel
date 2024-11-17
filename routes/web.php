<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Props\PropertiesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\UsersController;


// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [PropertiesController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', [PropertiesController::class, 'index'])->name('home');
// group route
Route::group(['prefix'=> 'props'] , function(){
   
    
Route::get('prop-details/{id}', [PropertiesController::class, 'single'])->name('single.prop');
// inserting request 
Route::post('prop-details/{id}', [PropertiesController::class, 'insertRequests'])->name('insert.request');

// saving props
Route::post('saved-props/{id}', [PropertiesController::class, 'saveProps'])->name('save.prop');

// displying props by rent and buy

Route::get('type/Buy', [PropertiesController::class, 'propsBuy'])->name('buy.prop');

Route::get('type/rent', [PropertiesController::class, 'propsRent'])->name('rent.prop');
  

// displying props by  hometype


Route::get('home-type/{hometype}', [PropertiesController::class, 'displayByHomeType'])->name('display.prop.hometytpe');


// displying props by  price asc and desc 
   

Route::get('price-asc', [PropertiesController::class, 'priceAsc'])->name('price.asc.prop');
Route::get('price-desc', [PropertiesController::class, 'priceDesc'])->name('price.desc.prop');
});



// display contact and about pages

// user pages
Route::get('users/all-requests', [UsersController::class, 'allRequests'])->name('all.requests');
Route::get('users/all-saved-props', [UsersController::class, 'allSavedProps'])->name('all.saved.props');





Route::get('contact', [HomeController::class, 'contact'])->name('contact');
Route::get('about', [HomeController::class, 'about'])->name('about');
 


