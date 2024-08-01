<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForgetPassword;
use App\Http\Controllers\PostController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatBoxController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\GoogleAuth;
use App\Http\Controllers\GroupChatController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\OrderListController;
use App\Models\Contact;
use App\Models\Exam;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', 'login');
Route::get('login', [AdminController::class, 'login'])->name('login');
Route::get('register', [AdminController::class, 'register'])->name('register');
Route::get('logout', [AdminController::class, 'logout'])->name('logout');

//google login
Route::get('/auth/google/redirect', [GoogleAuth::class, 'redirect']);
Route::get('/auth/google/callback', [GoogleAuth::class, 'callback']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::prefix('dashboard')->group(function () {
        Route::get('admin', [AdminController::class, 'admin'])->name('dashboard#admin');
        Route::get('chart', [AdminController::class, 'chart'])->name('chart');
    });

    Route::prefix('customer')->group(function () {
        Route::get('list', [CustomerController::class, 'list'])->name('customer#list');
        Route::get('delete', [CustomerController::class, 'delete'])->name('customer#delete');
    });

    Route::prefix('category')->group(function () {
        Route::get('list', [CategoryController::class, 'list'])->name('category#list');
        Route::post('create', [CategoryController::class, 'create'])->name('category#create');
        Route::get('delete', [CategoryController::class, 'delete'])->name('category#delete');
        Route::get('editView', [CategoryController::class, 'editView'])->name('category#editView');
        Route::post('edit', [CategoryController::class, 'edit'])->name('category#edit');
    });

    Route::prefix('product')->group(function () {
        Route::get('list', [PostController::class, 'list'])->name('product#list');
        Route::post('create', [PostController::class, 'create'])->name('product#create');
        Route::get('detail', [PostController::class, 'detail'])->name('product#detail');
        Route::get('delete', [PostController::class, 'delete'])->name('product#delete');
        Route::post('edit', [PostController::class, 'edit'])->name('product#edit');
    });

    Route::prefix('order')->group(function () {
        Route::get('list', [OrderListController::class, 'list'])->name('order#list');
        Route::get('status', [OrderListController::class, 'status'])->name('order#status');
        Route::get('detail/{code}', [OrderListController::class, 'detail'])->name('order#detail');
    });

    Route::prefix('admin')->group(function () {
        Route::get('list', [AdminController::class, 'list'])->name('admin#list');
        Route::get('delete', [AdminController::class, 'delete'])->name('admin#delete');
    });

    Route::prefix('chat')->group(function () {
        Route::get('list', [InboxController::class, 'list'])->name('chat#list');
        Route::post('send', [InboxController::class, 'send'])->name('chat#send');
    });

    Route::prefix('setting')->group(function () {
        Route::get('manage', [AdminController::class, 'manage'])->name('setting#manage');
        Route::post('update', [AdminController::class, 'update'])->name('setting#update');
        Route::post('changePassword', [AdminController::class, 'changePassword'])->name('setting#changePassword');
    });
});
