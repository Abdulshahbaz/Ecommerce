<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
        View::composer('layout.header', function ($view) {
            $userId = auth()->check() ? auth()->id() : session('guest_id');
            $count_items = Cart::where('user_id', $userId)->count();
            $view->with('count_items', $count_items);
        });
        
    }
}
