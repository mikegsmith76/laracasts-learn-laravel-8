<?php

namespace App\Listener\Post;

use App\Events\Post\Updated as PostUpdatedEvent;

class Updated
{
    protected \Illuminate\Log\LogManager $logger;

    public function __construct(\Illuminate\Log\LogManager $logger)
    {
        $this->logger = $logger;
    }

    public function handle(PostUpdatedEvent $event)
    {
        $this->logger->info("Post updated event called");
    }
}
