<?php

namespace App\App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        \App\Orders\Domain\Events\OrderCreated::class => [
            \App\PaymentMethods\Domain\Listeners\ProcessPayment::class,
            \App\Orders\Domain\Listeners\EmptyCart::class
        ],
        \App\Orders\Domain\Events\OrderPaid::class => [
            \App\Orders\Domain\Listeners\MarkOrderProcessing::class,
            \App\Orders\Domain\Listeners\CreateTransaction::class,
            
        ],        
        \App\Orders\Domain\Events\OrderPaymentFailed::class => [
            \App\Orders\Domain\Listeners\MarkOrderPaymentFailed::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
