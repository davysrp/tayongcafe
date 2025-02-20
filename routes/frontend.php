<?php
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Seller\CartController;
use App\Http\Controllers\SellController;




Route::middleware('guest')->group(function () {
    Route::group(['prefix' => 'member'], function () {
        Route::get('login', [AuthenticatedSessionController::class, 'loginForm'])->name('memberFormLogin');
        Route::get('forgot-password', [AuthenticatedSessionController::class, 'forgotPasswordForm'])->name('forgotPasswordForm');
        Route::post('forgot-password-link', [AuthenticatedSessionController::class, 'forgotPasswordSendLink'])->name('forgotPasswordSendLink');
        Route::get('reset-password/{token}', [AuthenticatedSessionController::class, 'resetPasswordSendLink'])->name('resetPasswordSendLink');
        Route::get('register', [AuthenticatedSessionController::class, 'registerForm'])->name('memberFormRegister');
        Route::post('save-change-password', [AuthenticatedSessionController::class, 'saveChangePassword'])->name('saveChangePassword');

        Route::post('login', [AuthenticatedSessionController::class, 'login'])->name('memberLogin');
        Route::post('register', [AuthenticatedSessionController::class, 'register'])->name('memberRegister');
    });

    Route::get('product-list', [FrontendController::class, 'productList'])->name('productList');
    Route::get('product-detail/{id}', [FrontendController::class, 'productDetail'])->name('productDetail');
    Route::get('profile/{username}', [FrontendController::class, 'sellerProfile'])->name('sellerProfile');
    Route::get('page/{page}', [FrontendController::class, 'page'])->name('page');
});

Route::middleware(['auth:seller'])->group(function () {
    Route::group(['prefix' => 'member'], function () {

        Route::get('top-up-balance',[FrontendController::class,'topUpBalance'] )->name('topUpBalance');
        Route::post('submit-top-up-balance',[FrontendController::class,'submitTopUpBalance'] )->name('submitTopUpBalance');
        Route::get('seller-logout',[AuthenticatedSessionController::class,'logout'] )->name('sellerlogout');

        Route::get('cart-list',[CartController::class,'index'] )->name('cartList');
        Route::get('add-cart/{id}',[CartController::class,'addCart'] )->name('addCart');
        Route::post('update-cart',[CartController::class,'updateCart'] )->name('updateCart');
        Route::get('remove-cart/{id}',[CartController::class,'remove'] )->name('removeCart');
        Route::post('place-order',[CartController::class,'placeOrder'] )->name('placeOrder');
        Route::get('order-detail/{id}',[CartController::class,'orderDetail'] )->name('orderDetail');
        Route::post('apply-coupon-code',[CartController::class,'applyCouponCode'] )->name('applyCouponCode');
        Route::get('request-khqr', [FrontendController::class, 'requestKhqrPay'])->name('requestKhqrPay');
        Route::get('khqr', [FrontendController::class, 'khqrPay'])->name('khqrPay');
        Route::get('khqr-success', [CartController::class, 'khqrPaymentSuccess'])->name('khqrPaymentSuccess');
        Route::post('khqr-check-transaction', [CartController::class, 'checkTransactionOrder'])->name('checkTransactionOrder');




        Route::get('soldproduct/{seller}',[SellController::class,'soldproduct'] )->name('frontend__.soldproduct');
        Route::get('boughtproduct/{buyer}',[SellController::class,'boughtproduct'] )->name('frontend__.boughtproduct');

        Route::resource('seller-products', ProductController::class);
        Route::get('get-payment-method',  [CartController::class,'getPaymentMethod'])->name('getPaymentMethod');
    });
});
