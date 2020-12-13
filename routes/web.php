<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

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



// ___ADMIN___

// VIEW
Route::view('/addCat', 'addCat');

// POST
Route::post('addCat', [AdminController::class, 'addCat']);
Route::post('addProduct', [AdminController::class, 'addProduct']);

// GET
Route::get('addProduct', [AdminController::class, 'getCat']);


// ___USER___

// GET
Route::get('/details/{id}', [UserController::class, 'getDetails']);
Route::get('home', [UserController::class, 'getHomeProducts']);
Route::get('/', [UserController::class, 'getHomeProducts']);
Route::get('logout', [UserController::class, 'logout']);


// Redirect pages when user is not loggined
Route::group(['middleware' => ['userNotLogined']], function(){
    // VIEW
    Route::view('/cart', 'cart');

    // GET
    Route::get('/myProfile', [UserController::class, 'getUserProfile']);

    // POST
    Route::post('updateUserData', [UserController::class, 'updateUserData']);
    Route::post('updateUserPass', [UserController::class, 'updateUserPass']);
    Route::post('updateUserImage', [UserController::class, 'updateUserImage']);
});


// Redirect pages when user is loggined
Route::group(['middleware' => ['userLogined']], function(){
    // VIEW
    Route::view('/login', 'login');
    Route::view('/register', 'register');
    Route::view('/verify', 'verify');

    // POST
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);
});