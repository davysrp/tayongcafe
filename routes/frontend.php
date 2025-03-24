<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\CustomerAuth\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Frontend\CartController;


// Route::middleware('guest')->group(function () {
//     Route::group(['prefix' => 'member'], function () {
//         Route::get('login', [AuthController::class, 'loginForm'])->name('memberFormLogin');
//         Route::get('forgot-password', [AuthController::class, 'forgotPasswordForm'])->name('forgotPasswordForm');
//         Route::post('forgot-password-link', [AuthController::class, 'forgotPasswordSendLink'])->name('forgotPasswordSendLink');
//         Route::get('reset-password/{token}', [AuthController::class, 'resetPasswordSendLink'])->name('resetPasswordSendLink');
//         Route::get('register', [AuthController::class, 'registerForm'])->name('memberFormRegister');
//         Route::post('save-change-password', [AuthController::class, 'saveChangePassword'])->name('saveChangePassword');

//         Route::post('login', [AuthController::class, 'login'])->name('memberLogin');
//         Route::post('register', [AuthController::class, 'register'])->name('memberRegister');
//     });

//     Route::get('product-list', [FrontendController::class, 'productList'])->name('productList');
//     Route::get('product-detail/{id}', [FrontendController::class, 'productDetail'])->name('productDetail');
//     Route::get('profile/{username}', [FrontendController::class, 'sellerProfile'])->name('sellerProfile');
//     Route::get('page/{page}', [FrontendController::class, 'page'])->name('page');
// });

// Route::middleware(['auth:customer'])->group(function () {
//     Route::group(['prefix' => 'member'], function () {

//         Route::get('seller-logout',[AuthController::class,'logout'] )->name('sellerlogout');

//         Route::get('cart-list',[CartController::class,'index'] )->name('cartList');
//         Route::get('add-cart/{id}',[CartController::class,'addCart'] )->name('addCart');
//         Route::post('update-cart',[CartController::class,'updateCart'] )->name('updateCart');
//         Route::get('remove-cart/{id}',[CartController::class,'remove'] )->name('removeCart');
//         Route::post('place-order',[CartController::class,'placeOrder'] )->name('placeOrder');
//         Route::get('order-detail/{id}',[CartController::class,'orderDetail'] )->name('orderDetail');
//         Route::post('apply-coupon-code',[CartController::class,'applyCouponCode'] )->name('applyCouponCode');
//         Route::get('request-khqr', [FrontendController::class, 'requestKhqrPay'])->name('requestKhqrPay');
//         Route::get('khqr', [FrontendController::class, 'khqrPay'])->name('khqrPay');
//         Route::get('khqr-success', [CartController::class, 'khqrPaymentSuccess'])->name('khqrPaymentSuccess');
//         Route::post('khqr-check-transaction', [CartController::class, 'checkTransactionOrder'])->name('checkTransactionOrder');
//         // Route::resource('seller-products', ProductController::class);
//         Route::get('get-payment-method',  [CartController::class,'getPaymentMethod'])->name('getPaymentMethod');
//     });
// });













Route::middleware('guest')->group(function () {
    Route::group(['prefix' => 'member'], function () {
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');

        // Route::post('/update-cart', [CartController::class, 'updateCart'])->name('cart.update');
        // Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

        Route::post('/cart/update', [FrontendController::class, 'updateCart'])->name('cart.update');
        Route::post('/cart/remove', [FrontendController::class, 'removeFromCart'])->name('cart.remove');
     


        // Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
        // Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');

        Route::get('register', [AuthController::class, 'registerForm'])->name('memberFormRegister');
        Route::post('register', [AuthController::class, 'register'])->name('memberRegister');
        Route::get('login', [AuthController::class, 'loginForm'])->name('memberFormLogin');
        Route::post('login', [AuthController::class, 'login'])->name('memberLogin'); 
    });
});


Route::middleware('auth:customer')->group(function () {
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
        Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
        Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/member/profile', [AuthController::class, 'showpro'])->name('member.profile');
    Route::post('/member/profile', [AuthController::class, 'updatepro'])->name('member.profile.update');
});
