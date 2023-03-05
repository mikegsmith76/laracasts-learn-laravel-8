<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', [
            "currentCategory" => request("category", 0) > 0 ? Category::findOrFail(request("category")) : null,
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
