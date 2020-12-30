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

// LOCALIZATION
Route::get('locale/{locale}', [UserController::class, 'changeLocale'])->name('locale');

Route::group(['middleware' => ['SetLocale']], function(){

    // ___ADMIN___

    // VIEW
    Route::view('/admin', 'adminLogin');

    // POST
    Route::post('adminLogin', [AdminController::class, 'adminLogin']);

    // GET
    Route::get('adminLogout', [AdminController::class, 'adminLogout']);


    // ___USER___

    // POST AJAX
    Route::post('ajax/request/getcomment', [UserController::class, 'getComments'])->name('ajax.request.getcomment');
    Route::post('ajax/request/getlang', [UserController::class, 'getLang'])->name('ajax.request.getlang');

    // GET
    Route::get('/details/{id}', [UserController::class, 'getDetails']);
    Route::get('home', [UserController::class, 'getHomeProducts']);
    Route::get('/', [UserController::class, 'getHomeProducts']);
    Route::get('logout', [UserController::class, 'logout']);
    Route::get('search', [UserController::class, 'search']);

    // Redirect pages when admin is not loggined
    Route::group(['middleware' => ['AdminNotLoggined']], function(){
    // VIEW
    Route::view('/addCat', 'addCat');

    // POST
    Route::post('addCat', [AdminController::class, 'addCat']);
    Route::post('addProduct', [AdminController::class, 'addProduct']);
    Route::post('saveProduct', [AdminController::class, 'saveProduct']);

    // GET
    Route::get('addProduct', [AdminController::class, 'getCat']);
    Route::get('editProduct/{id}', [AdminController::class, 'getProduct']);
    Route::get('activeProducts', [AdminController::class, 'getActiveProducts']);
    Route::get('blockedProducts', [AdminController::class, 'getBlockedProducts']);
    Route::get('removedProducts', [AdminController::class, 'getRemovedProducts']);

    Route::get('/blockProductFromActive/{id}', [AdminController::class, 'blockProductFromActive']);
    Route::get('/removeProductFromActive/{id}', [AdminController::class, 'removeProductFromActive']);

    Route::get('/recoverProductFromBlocked/{id}', [AdminController::class, 'recoverProductFromBlocked']);
    Route::get('/removeProductFromBlocked/{id}', [AdminController::class, 'removeProductFromBlocked']);

    Route::get('/recoverProductFromTrash/{id}', [AdminController::class, 'recoverProductFromTrash']);
    Route::get('/blockProductFromTrash/{id}', [AdminController::class, 'blockProductFromTrash']);
    });


    // Redirect pages when user is not loggined
    Route::group(['middleware' => ['userNotLogined']], function(){
    // GET
    Route::get('/myProfile', [UserController::class, 'getUserProfile']);
    Route::get('/cart', [UserController::class, 'getUserCart']);
    Route::get('/cart/removeFromCart/{id}', [UserController::class, 'removeFromCart']);
    Route::get('/buyAll', [UserController::class, 'buyAll']);
    Route::get('/orders', [UserController::class, 'getOrders']);

    // POST
    Route::post('updateUserData', [UserController::class, 'updateUserData']);
    Route::post('updateUserPass', [UserController::class, 'updateUserPass']);
    Route::post('updateUserImage', [UserController::class, 'updateUserImage']);
    Route::post('details/addToCart', [UserController::class, 'addToCart']);
    Route::post('/buyNow', [UserController::class, 'buyNow']);
    Route::post('/orderAll', [UserController::class, 'orderAll']);
    Route::post('/orderNow', [UserController::class, 'orderNow']);
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

    // Admin or User is logined
    Route::post('ajax/request/sendcomment', [UserController::class, 'leaveComment'])->name('ajax.request.sendcomment');

});