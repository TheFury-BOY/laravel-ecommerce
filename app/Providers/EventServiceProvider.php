<?php

namespace App\Providers;

use App\Events\UserHasRegisteredEvent;
use App\Listeners\UserHasRegisteredListener;
use App\Listeners\CartUpdatedListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserHasRegisteredEvent::class => [
            UserHasRegisteredListener::class,
        ],
        'cart.added' => [
            CartUpdatedListener::class,
        ],
        'cart.updated' => [
            CartUpdatedListener::class,
        ],
        'cart.removed' => [
            CartUpdatedListener::class,
        ],
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
