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


// Route Views
Route::view('/cart', 'cart');
Route::view('/login', 'login');
Route::view('/register', 'register');
Route::view('/verify', 'verify');
Route::view('/addCat', 'addCat');


// ___ADMIN___

// POST
Route::post('addCat', [AdminController::class, 'addCat']);
Route::post('addProduct', [AdminController::class, 'addProduct']);

// GET
Route::get('addProduct', [AdminController::class, 'getCat']);


// ___USER___

// POST
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

// GET
Route::get('/details/{id}', [UserController::class, 'getDetails']);
Route::get('home', [UserController::class, 'getHomeProducts']);
Route::get('/', [UserController::class, 'getHomeProducts']);
Route::get('logout', [UserController::class, 'logout']);