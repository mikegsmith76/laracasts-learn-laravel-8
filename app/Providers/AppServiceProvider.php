<?php

namespace App\Providers;

use App\Models\User;
use App\Services\MailchimpNewsletter;
use App\Services\Newsletter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->bind(ApiClient::class, function() {
            return (new ApiClient())->setConfig([
                'apiKey' => config("services.mailchimp.key"),
                'server' => config("services.mailchimp.server"),
            ]);
        });

        app()->bind(Newsletter::class, function() {
            return app()->make(MailchimpNewsletter::class);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define("admin", function (User $user) {
            return $user->username === "mail@mikegsmith.co.uk";
        });
    }
}
