<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentGatewayController;
use App\Http\Controllers\PaymentMethodController;
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

    Route::controller(PaymentMethodController::class)->group(function () {
    Route::get('/paymentmethod',  'index')->name('paymentmethods');
    Route::post('/paymentmethod',  'store');
    Route::get('/paymentmethod/{id}',   'paymentmethodedit');
    Route::put('/paymentmethod/{id}', 'paymentmethodupdate');
    Route::patch('/paymentmethod/{id}', 'paymentdefaultupdate')->name('paymentdefaultupdate');
    Route::delete('/paymentmethod/{id}', 'paymentmethoddelete');
    });

   Route::controller(PaymentGatewayController::class)->group(function () {
        Route::get('/paymentgateway',  'index')->name('paymentgateways');
        Route::post('/paymentgateway',  'store');
        Route::get('/paymentgateway/{id}',   'paymentgatewayedit');
        Route::put('/paymentgateway/{id}', 'paymentgatewayupdate');
        Route::delete('/paymentgateway/{id}', 'paymentgatewaydelete');
    });

    Route::controller(PaymentController::class)->group(function () {
        Route::get('/mypayment',  'index')->name('mypayment');
        Route::post('/mypayment',  'storetrans');
        Route::post('/makepayment',  'makepayment');
        Route::get('/successredirect',  'paymentsuccess');
        Route::get('/failedredirect',  'paymentfailed');
        //  Route::get('/mypayment',  'paymentmode')->name('paymentmode');
      //  Route::get('/mypayment',  'paymentmode')->name('paymentmode');

      /*  Route::post('/paymentgateway',  'store');
        Route::get('/paymentgateway/{id}',   'paymentgatewayedit');
        Route::put('/paymentgateway/{id}', 'paymentgatewayupdate');
        Route::delete('/paymentgateway/{id}', 'paymentgatewaydelete'); */
    });



});





