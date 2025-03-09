<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductPhotoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CouponCodeController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShippingMethodController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebpageController;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\CartController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\CheckoutController;

Route::get('/', [FrontendController::class, 'index'])->name('homePage');
Route::get('/page/{category}', [FrontendController::class, 'index'])->name('productCategory');


// Checkout route
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');


// Public Cart Routes (accessible to all users)
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

Route::middleware('auth:user')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('adminDashboard');


        Route::resource('users', UserController::class);
        // Route::get('/users', [UserController::class, 'index'])->name('users.index');


        // Resources (only one instance per controller)
        // Route::resource('users', UserController::class);
        Route::resource('web-pages', WebpageController::class);
        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('coupon-code', CouponCodeController::class);
        Route::resource('sells', SellController::class);
        Route::resource('payment-method', PaymentMethodController::class);
        Route::resource('customers', CustomerController::class);
        Route::resource('shipping-methods', ShippingMethodController::class);
        Route::resource('roles', RoleController::class);

        // Payment Routes
        Route::put('renew-token/{id}', [PaymentMethodController::class, 'renewToken'])->name('renewToken');
        Route::post('/confirm-payment', [PaymentController::class, 'confirmPayment'])->name('confirm.payment');

        // Invoice Routes
        Route::get('/invoice/view/{id}', [InvoiceController::class, 'viewInvoice'])->name('invoice.view');
        Route::get('/invoice/download/{id}', [InvoiceController::class, 'downloadInvoice'])->name('invoice.download');

        // Reports
        Route::get('/report', [DashboardController::class, 'report'])->name('report.index');
        Route::get('/report/export/pdf', [DashboardController::class, 'exportPdf'])->name('report.export.pdf');

        // Sales Dashboard & Transactions
        Route::get('sale-dashboard', [SellController::class, 'saleDashboard'])->name('saleDashboard');
        Route::get('sales/{table}', [SellController::class, 'saleForm'])->name('saleForm');
        Route::get('get-product-by-category', [SellController::class, 'getProductByCategory'])->name('getProductByCategory');
        Route::post('add-cart-item', [SellController::class, 'addCardItem'])->name('addCardItem');
        Route::post('apply-coupon', [SellController::class, 'applyCouponCode'])->name('applyCouponCodeAdmin');
        Route::get('order-item-list', [SellController::class, 'orderItemList'])->name('orderItemList');
        Route::get('get-coupon-code', [SellController::class, 'getCouponCode'])->name('getCouponCode');
        Route::get('get-customer-list', [SellController::class, 'getCustomer'])->name('getCustomer');
        Route::get('getPaymentMethod', [SellController::class, 'getPaymentMethod'])->name('getPaymentMethodAdmin');
        Route::post('place-order', [SellController::class, 'placeOrder'])->name('placeOrderAdmin');
        Route::post('checkTransactionOrder', [SellController::class, 'checkTransactionOrder'])->name('checkTransactionOrderAdmin');
        Route::post('update-remove-qty', [SellController::class, 'updateRemoveQty'])->name('updateRemoveQty');





        // Cart routes
        // Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        // Route::post('/add-to-cart', [FrontendController::class, 'addToCart'])->name('add-to-cart');
        // Route::post('/cart/add', [CartController::class, 'addToCart'])->name('addToCart');
        // Route::post('/cart/update', [CartController::class, 'updateCart'])->name('updateCart');
        // Route::get('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('removeFromCart');
        // Route::post('/cart/apply-coupon', [CartController::class, 'applyCouponCode'])->name('applyCouponCode');
        // Route::get('/cart/clear', [CartController::class, 'clearCart'])->name('clearCart');
    });
});



require __DIR__ . '/auth.php';
require __DIR__ . '/frontend.php';
