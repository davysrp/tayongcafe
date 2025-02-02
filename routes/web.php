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
use Illuminate\Support\Facades\Route;

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
Route::get('/', [\App\Http\Controllers\Frontend\FrontendController::class, 'index'])->name('homePage');
Route::get('/page/{category}', [\App\Http\Controllers\Frontend\FrontendController::class, 'index'])->name('productCategory');


Route::middleware('auth:user')->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('adminDashboard');


        Route::resource('users', \App\Http\Controllers\UserController::class);
        Route::resource('web-pages', \App\Http\Controllers\WebpageController::class);
        Route::resource('products', \App\Http\Controllers\ProductController::class);
        Route::resource('categories', \App\Http\Controllers\CategoryController::class);
        Route::resource('coupon-code', \App\Http\Controllers\CouponCodeController::class);
        Route::resource('sells', \App\Http\Controllers\SellController::class);
        Route::resource('payment-method', \App\Http\Controllers\PaymentMethodController::class);

        Route::put('renew-token/{id}', [\App\Http\Controllers\PaymentMethodController::class, 'renewToken'])->name('renewToken');

        Route::resource('users', \App\Http\Controllers\UserController::class);
        Route::resource('web-pages', \App\Http\Controllers\WebpageController::class);
        Route::resource('categories', \App\Http\Controllers\CategoryController::class);


        Route::resource('coupon-code', \App\Http\Controllers\CouponCodeController::class);
        Route::resource('sells', \App\Http\Controllers\SellController::class);


        Route::resource('customers', CustomerController::class);


        Route::resource('coupon-code', CouponCodeController::class);

        Route::resource('coupon-code', CouponCodeController::class)->parameters(['coupon-code' => 'coupon_code']);




    //    Route::get('/admin/admin/sells/create', [SellController::class, 'create'])->name('sells.create');
    //    Route::post('/admin/admin/sells', [SellController::class, 'store'])->name('sells.store');
       
        Route::resource('customers', CustomerController::class);
       // Route::get('/get-customers', [SellController::class, 'getCustomers'])->name('getCustomer');
       //Route::resource('shipping-methods', ShippingMethodController::class);

       Route::resource('shipping-methods', ShippingMethodController::class);
       Route::resource('roles', RoleController::class);


       Route::get('/invoice/view/{id}', [InvoiceController::class, 'viewInvoice'])->name('invoice.view');
       Route::get('/invoice/download/{id}', [InvoiceController::class, 'downloadInvoice'])->name('invoice.download');

       Route::post('/confirm-payment', [PaymentController::class, 'confirmPayment'])->name('confirm.payment');

       Route::get('/admin/report', [DashboardController::class, 'report'])->name('report.index');
       Route::get('/admin/report/export/pdf', [DashboardController::class, 'exportPdf'])->name('report.export.pdf');

        
        Route::get('/admin/sells/create', [SellController::class, 'create'])->name('sells.create');
        Route::post('/admin/sells', [SellController::class, 'store'])->name('sells.store');


        Route::get('sale-dashboard',[ \App\Http\Controllers\SellController::class, 'saleDashboard'])->name('saleDashboard');
        Route::get('sales/{table}',[ \App\Http\Controllers\SellController::class, 'saleForm'])->name('saleForm');
        Route::get('get-product-by-category',[ \App\Http\Controllers\SellController::class, 'getProductByCategory'])->name('getProductByCategory');
        Route::post('add-cart-item',[ \App\Http\Controllers\SellController::class, 'addCardItem'])->name('addCardItem');
        Route::post('apply-coupon',[ \App\Http\Controllers\SellController::class, 'applyCouponCode'])->name('applyCouponCodeAdmin');
        Route::get('order-item-list',[ \App\Http\Controllers\SellController::class, 'orderItemList'])->name('orderItemList');
        Route::get('get-coupon-code',[ \App\Http\Controllers\SellController::class, 'getCouponCode'])->name('getCouponCode');
        Route::get('get-customer-list',[ \App\Http\Controllers\SellController::class, 'getCustomer'])->name('getCustomer');
        Route::get('getPaymentMethod',[ \App\Http\Controllers\SellController::class, 'getPaymentMethod'])->name('getPaymentMethodAdmin');
        Route::post('place-order',[ \App\Http\Controllers\SellController::class, 'placeOrder'])->name('placeOrderAdmin');
        Route::post('checkTransactionOrder',[ \App\Http\Controllers\SellController::class, 'checkTransactionOrder'])->name('checkTransactionOrderAdmin');
        Route::post('update-remove-qty',[ \App\Http\Controllers\SellController::class, 'updateRemoveQty'])->name('updateRemoveQty');





    });
});

require __DIR__ . '/auth.php';
require __DIR__ . '/frontend.php';
