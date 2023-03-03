<?php

namespace App\Http\Controllers;

use App\Events\Comment\Created as CommentCreatedEvent;
use App\Models\Post;

class CommentController extends Controller
{
    protected \Illuminate\Events\Dispatcher $dispatcher;

    public function __construct(\Illuminate\Events\Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function store(Post $post)
    {
        $validated = request()->validate([
            "body" => "required|string"
        ]);

        $comment = $post->comments()->create([
            "body" => $validated["body"],
            "user_id" => auth()->id(),
        ]);

        $this->dispatcher->dispatch(new CommentCreatedEvent($post, $comment));

        return back();
    }
}
