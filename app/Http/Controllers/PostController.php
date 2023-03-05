<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    protected \Illuminate\Http\Request $request;

    public function __construct(\Illuminate\Http\Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        $currentCategory = Category::find(
            $this->request->input("category", 0)
        );

        $postsCollection = Post::latest()
            ->filter(
                $this->request->only([
                    "author",
                    "category",
                    "search",
                ])
            )
            ->paginate(6);

        return view('posts.index', [
            "currentCategory" => $currentCategory,
            "posts" => $postsCollection,
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            "post" => $post,
        ]);
    }
}
