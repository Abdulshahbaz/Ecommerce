<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserloginController;
use App\Http\Controllers\ProductdetailController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ShopgridController;
use App\Http\Controllers\RegisteruserController;
use App\Http\Controllers\ShoppingcartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\BlogdetailsController;
use App\Http\Controllers\AddtocartController;
use App\Http\Controllers\RemovetocartController;
use App\Http\Controllers\CartcountController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentController;





Route::get('register-login',[RegisteruserController::class,'user_register'])->name('user.register');
Route::post('register-add',[RegisteruserController::class,'user_register_check'])->name('user.registed');

Route::get('login',[UserloginController::class,'user_login'])->name('user.login');
Route::post('login',[UserloginController::class,'user_login_check'])->name('user.logined');

Route::get('/',[HomeController::class,'index'])->name('home.page');

Route::get('products',[ProductController::class,'products'])->name('products.grid');

Route::get('blog',[BlogController::class,'blog'])->name('blog');
Route::get('contact',[ContactController::class,'contact'])->name('contact');

Route::get('product-details/{id}',[ProductdetailController::class,'product_details'])->name('product.details');

Route::get('shoping-cart',[ShoppingcartController::class,'shoping_cart'])->name('shoping.cart');

Route::middleware(['auth'])->group(function()
{
Route::get('check-out',[CheckoutController::class,'check_out'])->name('check.out');
Route::post('check-out/add',[CheckoutController::class,'check_out_add'])->name('check.add');
});

Route::get('blog-details',[BlogdetailsController::class,'blog_details'])->name('blog.details');

Route::get('cart/{id}',[AddtocartController::class,'add_to_cart'])->name('cart.add');
Route::get('remove/{id}',[RemovetocartController::class,'remove_to_cart'])->name('cart.remove');



Route::get('cart-count', [CartcountController::class, 'cart_count'])->name('cart.count');
Route::get('cart-products', [ProductController::class, 'get_cart_product'])->name('cart.products');

Route::post('/cart/update', [ProductController::class, 'update'])->name('cart.update');

Route::delete('/cart/delete/{id}', [ProductController::class, 'destroy'])->name('cart.delete');
 Route::post('shoping-cart', [CouponController::class, 'apply_coupon'])->name('apply.coupan');
 Route::post('/remove-coupan', [CouponController::class, 'remove_coupon'])->name('remove.coupan');



 Route::get('/get-file', [PaymentController::class, 'get_file'])->name('get.file');
 Route::post('/verify-payment', [PaymentController::class, 'verify_payment'])->name('verify.payment');

 
 Route::get('/success', [HomeController::class, 'success'])->name('/success');


 require __DIR__.'/admin.php';
 require __DIR__.'/user.php';
