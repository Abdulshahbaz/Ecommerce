<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserlogedController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\AdminController;

Route::prefix('/user')->name('user.')->group(function()
{
Route::get('/login',[UserlogedController::class,'user_login'])->name('log');
Route::post('/login',[UserlogedController::class,'user_loged'])->name('loged');

Route::get('/dashboard',[UserlogedController::class,'dashboard'])->name('dashboard');

Route::get('/order',[OrderController::class,'order_list'])->name('order');

Route::get('/profile',[ProfileController::class,'user_profile'])->name('profile');
Route::post('/profile/{id}',[ProfileController::class,'user_profile_update'])->name('profile.update');
});
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');