<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\Comment\Created as CommentCreatedEvent;
use App\Events\Post\Created as PostCreatedEvent;
use App\Events\Post\Deleted as PostDeletedEvent;
use App\Events\Post\Updated as PostUpdatedEvent;
use App\Listener\Comment\Created as TestCommentCreatedListener;
use App\Listener\Post\Created as TestPostCreatedListener;
use App\Listener\Post\Deleted as TestPostDeletedListener;
use App\Listener\Post\Updated as TestPostUpdatedListener;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CommentCreatedEvent::class => [
            TestCommentCreatedListener::class,
        ],
        PostCreatedEvent::class => [
            TestPostCreatedListener::class,
        ],
        PostDeletedEvent::class => [
            TestPostDeletedListener::class,
        ],
        PostUpdatedEvent::class => [
            TestPostUpdatedListener::class,
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
