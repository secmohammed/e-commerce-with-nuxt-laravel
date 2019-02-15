<?php

namespace App\App\Providers;

use App\App\Domain\Cart\Cart;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Cart::class , function ($app){
            if ($app->auth->user()) {
                $app->auth->user()->load([
                    'cart.stock'
                ]);
            }
            
            return new Cart($app->auth->user());
        });
    }
}
