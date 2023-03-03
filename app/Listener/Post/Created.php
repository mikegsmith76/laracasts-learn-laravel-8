<?php

namespace App\Listener\Post;

use App\Events\Post\Created as PostCreatedEvent;

class Created
{
    protected \Illuminate\Log\LogManager $logger;

    public function __construct(\Illuminate\Log\LogManager $logger)
    {
        $this->logger = $logger;
    }

    public function handle(PostCreatedEvent $event)
    {
        $this->logger->info("Post created event called");
    }
}
