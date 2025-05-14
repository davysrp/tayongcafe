<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\CustomerAuth\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Frontend\CartController;


Route::middleware('guest')->group(function () {
    Route::group(['prefix' => 'member'], function () {



        Route::get('register', [AuthController::class, 'registerForm'])->name('memberFormRegister');
        Route::post('register', [AuthController::class, 'register'])->name('memberRegister');
        Route::get('login', [AuthController::class, 'loginForm'])->name('memberFormLogin');
        Route::post('login', [AuthController::class, 'login'])->name('memberLogin');



    });
});

Route::post('/otp-request', [\App\Http\Controllers\OtpController::class, 'sendOtp'])->name('otp.request');
Route::post('/otp-verify', [\App\Http\Controllers\OtpController::class, 'verifyOtp'])->name('otp.verify');

Route::middleware('auth:customer')->group(function () {
    Route::group(['prefix' => 'member'], function () {


        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
        // Route::post('/cart/update', [FrontendController::class, 'updateCart'])->name('cart.update');
        Route::post('/cart/remove', [FrontendController::class, 'removeFromCart'])->name('cart.remove');


        Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
        // Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');


        Route::get('/cart', [CheckoutController::class, 'index'])->name('cart.index');


        // Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

        Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
        Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
        Route::post('apply-coupon', [CheckoutController::class, 'applyCouponCode'])->name('applyCouponCustomer');

        Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('getPaymentMethod', [SellController::class, 'getPaymentMethod'])->name('getPaymentMethodUser');
        Route::post('checkTransactionOrder', [CheckoutController::class, 'checkTransactionOrder'])->name('checkTransactionOrderUser');
        Route::get('/member/profile', [AuthController::class, 'showpro'])->name('member.profile');
        Route::post('/member/profile', [AuthController::class, 'updatepro'])->name('member.profile.update');
    });
});


