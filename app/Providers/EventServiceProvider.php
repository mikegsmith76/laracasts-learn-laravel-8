<?php

namespace App\Providers;

use App\Events\Post\Created as PostCreatedEvent;
use App\Listener\Post\SendSubscriberEmails;
use App\Listener\User\Registered as RegisteredListener;
use Illuminate\Auth\Events\Registered as RegisteredEvent;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        RegisteredEvent::class => [
            RegisteredListener::class,
        ],
        PostCreatedEvent::class => [
            SendSubscriberEmails::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
