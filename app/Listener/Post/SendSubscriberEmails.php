<?php

namespace App\Listener\Post;

use App\Events\Post\Created as PostCreatedEvent;
use App\Mail\NewPost as NewPostEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

class SendSubscriberEmails implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(protected Mailer $mailer)
    {
    }

    public function handle(PostCreatedEvent $event)
    {
        foreach ($event->post->subscribers as $subscriber) {
            $this->mailer
                ->to($subscriber->email, $subscriber->name)
                ->send(new NewPostEmail($event->post));
        }
    }
}
