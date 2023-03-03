<?php

namespace App\Listener\Post;

use App\Events\Post\Deleted as PostDeletedEvent;

class Deleted
{
    protected \Illuminate\Log\LogManager $logger;

    public function __construct(\Illuminate\Log\LogManager $logger)
    {
        $this->logger = $logger;
    }

    public function handle(PostDeletedEvent $event)
    {
        $this->logger->info("Post deleted event called");
    }
}
