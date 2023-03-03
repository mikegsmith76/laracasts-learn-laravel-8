<?php

namespace App\Http\Controllers;

use App\Models\Post;

class CommentController extends Controller
{
    public function store(Post $post)
    {
        $validated = request()->validate([
            "body" => "required|string"
        ]);

        $comment = $post->comments()->create([
            "body" => $validated["body"],
            "user_id" => auth()->id(),
        ]);

        return back();
    }
}
