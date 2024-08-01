<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\OrderListController;
use App\Http\Controllers\Api\AuthUserController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\ChatBoxController;
use App\Http\Controllers\OrderToAdminController;
use App\Http\Controllers\React\AuthController;
use App\Models\OrderList;
use App\Models\OrderToAdmin;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [AuthUserController::class, 'login']);
Route::post('register', [AuthUserController::class, 'register']);
Route::post('user', [AuthUserController::class, 'user']);

Route::get('category', [CategoryController::class, 'category']);
Route::post('categorySearch', [CategoryController::class, 'categorySearch']);

Route::get('post', [CategoryController::class, 'post']);

Route::post('postSearch', [CategoryController::class, 'postSearch']);
Route::post('postDetail', [CategoryController::class, 'postDetail']);
Route::post('relatedPost', [CategoryController::class, 'relatedPost']);

Route::post('addCart', [CartController::class, 'addCart']);
Route::post('cart', [CartController::class, 'cart']);
Route::post('cartList', [CartController::class, 'cartList']);
Route::post('cartRemove', [CartController::class, 'cartRemove']);
Route::post('updateLocation', [CartController::class, 'updateLocation']);

Route::post('orderToAdmin', [OrderToAdminController::class, 'orderToAdmin']);
Route::post('viewCount', [OrderToAdminController::class, 'viewCount']);
Route::get('chatUserList', [OrderToAdminController::class, 'chatUserList']);
Route::post('searchUserName', [OrderToAdminController::class, 'searchUserName']);

Route::post('history', [OrderListController::class, 'history']);
Route::post('getHistory', [OrderListController::class, 'getHistory']);
Route::post('getLike', [OrderListController::class, 'getLike']);
Route::post('like', [OrderListController::class, 'like']);
Route::post('unlike', [OrderListController::class, 'unlike']);

Route::post('sendMessage', [ChatBoxController::class, 'sendMessage']);
Route::post('getMessage', [ChatBoxController::class, 'getMessage']);
Route::post('getComment', [ChatBoxController::class, 'getComment']);
Route::post('postComment', [ChatBoxController::class, 'postComment']);
