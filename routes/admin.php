<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategorysController;
use App\Http\Controllers\Admin\CoupansController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\PdfgenerateController;
use App\Http\Controllers\Admin\StatusController;
use App\Http\Controllers\DashboardController;
// Admin Route
Route::get('admin/login',[AdminController::class,'login'])->name('login');
Route::post('admin/login',[AdminController::class,'admin_login_check'])->name('admin.login');


Route::middleware(['admin_auth'])->prefix('/admin')->group(function()
{
    Route::get('/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
  

    Route::resource('/category', CategorysController::class);
    Route::post('/toggle-category',[CategorysController::class,'toggle_Category'])->name('toggle.category');


    Route::resource('/coupan', CoupansController::class);
    Route::post('/toggle-coupan',[CoupansController::class,'toggle_Coupan'])->name('toggle.coupan');

    Route::resource('/product', ProductsController::class);
    Route::post('/toggle-product', [ProductsController::class, 'toggle_Product'])->name('toggle.product');


    Route::resource('/banner', BannerController::class);
    Route::post('/toggle-Banner',[BannerController::class,'toggle_Banner'])->name('toggle.banner');

    Route::resource('/blog',BlogController::class);
    Route::post('/toggle-blog', [BlogController::class, 'toggle_Blog'])->name('toggle.blog');

    Route::resource('/orders',OrderController::class); 
    Route::get('/orders/user/{userId}',[OrderController::class,'index'])->name('orders.user');

    Route::resource('/users',UsersController::class); 
    Route::get('/order/{id}/generate-pdf', [PdfgenerateController::class, 'generate_PDF'])->name('order.generatePDF');


    Route::post('/update-payment-status/{id}', [StatusController::class, 'update_paymen_tStatus'])->name('update.payment.status');
    Route::post('/update-order-status/{id}', [StatusController::class, 'update_order_Status'])->name('update.order.status');

    Route::get('/all-products', [DashboardController::class, 'all_products'])->name('all.products');
    });
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
