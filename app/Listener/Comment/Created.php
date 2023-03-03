<?php

namespace App\Listener\Comment;

use App\Events\Comment\Created as CommentCreatedEvent;

class Created
{
    protected \Illuminate\Log\LogManager $logger;

    public function __construct(\Illuminate\Log\LogManager $logger)
    {
        $this->logger = $logger;
    }

    public function handle(CommentCreatedEvent $event)
    {
        $this->logger->info("Comment created event called");
    }
}
