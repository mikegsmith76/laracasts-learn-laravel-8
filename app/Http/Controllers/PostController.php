<?php

namespace App\Http\Controllers;

use App\Models\Post;

use App\Events\Post\Created as PostCreatedEvent;
use App\Events\Post\Updated as PostUpdatedEvent;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', [
            "posts" => Post::latest()->filter(
                request(["author", "category", "search"])
            )->paginate(6),
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            "post" => $post,
        ]);
    }
}
