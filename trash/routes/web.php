<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UsersController;

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


Route::get('/alpha', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/','index')->name('home');
    Route::get('login', 'index')->name('login');
    Route::get('register',  'registration')->name('register');
    Route::post('create-user', 'create')->name('user.create');
    Route::post('post-login', 'postLogin')->name('login.post');
    Route::get('logout',  'logout')->name('logout');
});


Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    Route::controller(MessageController::class)->group(function () {
        Route::get('mymessages', 'index')->name('mymessages');
        Route::get('newmessage',  'newmessage')->name('new.message');
        Route::post('sendmessage',  'store')->name('sendmessage');
    });

    Route::middleware(['admin'])->group(function () {
        Route::controller(UsersController::class)->group(function () {
            Route::get('/users', 'alluser');
            Route::post('/users',  'alluser');
            Route::get('/viewuser/{id}', 'userdetails');
            Route::get('/updateuser/{uid}/{id}', 'userupdate');
        });
    });

});
