<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

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







Route::middleware(['banned'])->group(function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/bookmark', [HomeController::class, 'bookmarks'])->name('bookmark');
    Route::post('/delbookmark', [HomeController::class, 'Delbookmarks'])->name('Delbookmark');

    route::get('/register', [RegisterController::class, 'create'])->name('user.create');
    route::post('/register', [RegisterController::class, 'store'])->name('user.store');
    
    route::middleware(['guest'])->group(function(){
        route::get('/login', [RegisterController::class, 'LoginCreate'])->name('login.create');
        route::post('/login', [RegisterController::class, 'LoginStore'])->name('login.store');
    });
    
    route::middleware(['auth'])->group(function(){
        route::get('/logout', [RegisterController::class, 'logout'])->name('logout');
        route::get('/post', [PostController::class, 'create'])->name('post.create');
        route::post('/post', [PostController::class, 'store'])->name('post.store');
    });
    
    route::middleware(['admin'])->group(function(){
        route::get('/admin', [AdminController::class, 'admin'])->name('admin');
        route::post('/admin', [AdminController::class, 'admin2'])->name('admin2');

        route::get('/admin/posts', [AdminController::class, 'post'])->name('post.check');
        route::post('/admin/posts/confirm', [AdminController::class, 'post2'])->name('post.check2');
        route::post('/admin/posts', [AdminController::class, 'post3'])->name('post.check3');
    });



    Route::get('/banned', function () {
        return view('user.banned');
    })->name('banned');
});
route::get('/logout', [RegisterController::class, 'logout'])->name('logout');
