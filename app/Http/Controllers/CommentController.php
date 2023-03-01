<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Post $post)
    {
        $validated = request()->validate([
            "body" => "required|string"
        ]);

        $post->comments()->create([
            "body" => $validated["body"],
            "user_id" => auth()->id(),
        ]);

        return back();
    }
}
