<?php

use App\Http\Controllers\Admins\AdminsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Props\PropertiesController;
use App\Http\Controllers\Users\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [PropertiesController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', [PropertiesController::class, 'index'])->name('home');
Route::get('contact', [HomeController::class, 'contact'])->name('contact');
Route::get('about', [HomeController::class, 'about'])->name('about');
// group route
Route::group(['prefix'=> 'props'] , function(){
   
    
Route::get('prop-details/{id}', [PropertiesController::class, 'single'])->name('single.prop');
// inserting request 
Route::post('prop-details/{id}', [PropertiesController::class, 'insertRequests'])->name('insert.request');


Route::post('saved-props/{id}', [PropertiesController::class, 'saveProps'])->name('save.prop');



Route::get('type/Buy', [PropertiesController::class, 'propsBuy'])->name('buy.prop');

Route::get('type/rent', [PropertiesController::class, 'propsRent'])->name('rent.prop');
  

// displying props by  hometype


Route::get('home-type/{hometype}', [PropertiesController::class, 'displayByHomeType'])->name('display.prop.hometytpe');


// displying props by  price asc and desc 
   

Route::get('price-asc', [PropertiesController::class, 'priceAsc'])->name('price.asc.prop');
Route::get('price-desc', [PropertiesController::class, 'priceDesc'])->name('price.desc.prop');

// searching  for props 

Route::post('search', [PropertiesController::class, 'searchProps'])->name('search.prop');

});
// display contact and about pages
// user pages
Route::group(['prefix'=> 'users'] , function(){
Route::get('all-requests', [UsersController::class, 'allRequests'])->name('all.requests');
Route::get('all-saved-props', [UsersController::class, 'allSavedProps'])->name('all.saved.props');

});
  

Route::get('admin/login', [AdminsController::class, 'viewLogin'])->name('view.login');
Route::post('admin/check-login', [AdminsController::class, 'checkLogin'])->name('check.login');
Route::group(['prefix'=> 'admin','middleware'=> 'auth:admin'] , function(){

Route::get('/index', [AdminsController::class, 'index'])->name('admins.dashboard');


//create the admins 
Route::get('/all-admins', [AdminsController::class, 'allAdmins'])->name('admins.admins');
Route::get('/create-admins', [AdminsController::class, 'createAdmins'])->name('admins.create');
Route::post('/create-admins', [AdminsController::class, 'storeAdmins'])->name('admins.store');
// Hometype
Route::get('/all-hometypes', [AdminsController::class, 'allHomeTypes'])->name('admins.hometypes');

});






 


