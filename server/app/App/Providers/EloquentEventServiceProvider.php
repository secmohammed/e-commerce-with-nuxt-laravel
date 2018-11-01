<?php

namespace App\App\Providers;

use Illuminate\Support\ServiceProvider;

class EloquentEventServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        \App\Users\Domain\Models\User::observe(\App\Users\Domain\Observers\UserObserver::class);
        \App\Addresses\Domain\Models\Address::observe(\App\Addresses\Domain\Observers\AddressObserver::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
