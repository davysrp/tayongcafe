<?php
Route::middleware('guest')->group(function () {

    // Route::group(['prefix' => 'member'], function () {
    //     Route::get('login', [App\Http\Controllers\SellerAuth\AuthController::class, 'loginForm'])->name('memberFormLogin');
    //     Route::get('forgot-password', [App\Http\Controllers\SellerAuth\AuthController::class, 'forgotPasswordForm'])->name('forgotPasswordForm');
    //     Route::post('forgot-password-link', [App\Http\Controllers\SellerAuth\AuthController::class, 'forgotPasswordSendLink'])->name('forgotPasswordSendLink');
    //     Route::get('reset-password/{token}', [App\Http\Controllers\SellerAuth\AuthController::class, 'resetPasswordSendLink'])->name('resetPasswordSendLink');
    //     Route::get('register', [App\Http\Controllers\SellerAuth\AuthController::class, 'registerForm'])->name('memberFormRegister');
    //     Route::post('save-change-password', [App\Http\Controllers\SellerAuth\AuthController::class, 'saveChangePassword'])->name('saveChangePassword');

    //     Route::post('login', [App\Http\Controllers\SellerAuth\AuthController::class, 'login'])->name('memberLogin');
    //     Route::post('register', [App\Http\Controllers\SellerAuth\AuthController::class, 'register'])->name('memberRegister');
    // });

    Route::get('product-list', [\App\Http\Controllers\Frontend\FrontendController::class, 'productList'])->name('productList');
    Route::get('product-detail/{id}', [\App\Http\Controllers\Frontend\FrontendController::class, 'productDetail'])->name('productDetail');
    Route::get('profile/{username}', [\App\Http\Controllers\Frontend\FrontendController::class, 'sellerProfile'])->name('sellerProfile');
    Route::get('page/{page}', [\App\Http\Controllers\Frontend\FrontendController::class, 'page'])->name('page');
});

Route::middleware(['auth:seller'])->group(function () {
    Route::group(['prefix' => 'member'], function () {

        Route::get('top-up-balance',[\App\Http\Controllers\Frontend\FrontendController::class,'topUpBalance'] )->name('topUpBalance');
        Route::post('submit-top-up-balance',[\App\Http\Controllers\Frontend\FrontendController::class,'submitTopUpBalance'] )->name('submitTopUpBalance');

        // Route::get('seller-logout',[\App\Http\Controllers\SellerAuth\AuthController::class,'logout'] )->name('sellerlogout');

        Route::get('cart-list',[\App\Http\Controllers\Seller\CartController::class,'index'] )->name('cartList');
        Route::get('add-cart/{id}',[\App\Http\Controllers\Seller\CartController::class,'addCart'] )->name('addCart');
        Route::post('update-cart',[\App\Http\Controllers\Seller\CartController::class,'updateCart'] )->name('updateCart');
        Route::get('remove-cart/{id}',[\App\Http\Controllers\Seller\CartController::class,'remove'] )->name('removeCart');
        Route::post('place-order',[\App\Http\Controllers\Seller\CartController::class,'placeOrder'] )->name('placeOrder');
        Route::get('order-detail/{id}',[\App\Http\Controllers\Seller\CartController::class,'orderDetail'] )->name('orderDetail');
        Route::post('apply-coupon-code',[\App\Http\Controllers\Seller\CartController::class,'applyCouponCode'] )->name('applyCouponCode');
        Route::get('request-khqr', [\App\Http\Controllers\Frontend\FrontendController::class, 'requestKhqrPay'])->name('requestKhqrPay');
        Route::get('khqr', [\App\Http\Controllers\Frontend\FrontendController::class, 'khqrPay'])->name('khqrPay');
        Route::get('khqr-success', [\App\Http\Controllers\Seller\CartController::class, 'khqrPaymentSuccess'])->name('khqrPaymentSuccess');
        Route::post('khqr-check-transaction', [\App\Http\Controllers\Seller\CartController::class, 'checkTransactionOrder'])->name('checkTransactionOrder');




        Route::get('soldproduct/{seller}',[\App\Http\Controllers\SellController::class,'soldproduct'] )->name('frontend__.soldproduct');
        Route::get('boughtproduct/{buyer}',[\App\Http\Controllers\SellController::class,'boughtproduct'] )->name('frontend__.boughtproduct');

        Route::resource('seller-products', \App\Http\Controllers\Frontend\ProductController::class);
        Route::get('get-payment-method',  [\App\Http\Controllers\Seller\CartController::class,'getPaymentMethod'])->name('getPaymentMethod');
    });
});
