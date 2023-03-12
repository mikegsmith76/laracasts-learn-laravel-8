<?php

namespace App\Listener\User;

use App\Mail\Welcome as WelcomeEmail;
use \Illuminate\Auth\Events\Registered as RegisteredEvent;
use Illuminate\Bus\Queueable;
use \Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

class Registered implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public Mailer $mailer)
    {
    }

    public function handle(RegisteredEvent $event)
    {
        $this->mailer
            ->to($event->user->email, $event->user->name)
            ->send(
                new WelcomeEmail($event->user),
            );
    }
}
