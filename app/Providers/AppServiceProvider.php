<?php

namespace App\Providers;

use App\Models\Product;
use Illuminate\Support\ServiceProvider;

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
        // view()->composer('*', function($view) {
        //     $min_price = Product::min('price_product')->where;
        //     $max_price = Product::max('price_product');
        //     $view->with('max_price', ceil($max_price))->with('min_price', $min_price);
        // });
    }
}
