<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    protected \Illuminate\Http\Request $request;
    protected Post $postRepository;

    public function __construct(\Illuminate\Http\Request $request, Post $postRepository)
    {
        $this->request = $request;
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $currentCategory = Category::find(
            $this->request->input("category", 0)
        );

        $posts = $this->postRepository
            ->searchWithFilters(
                $requestParameters["search"] ?? "*",
                $this->request->only([
                    "author",
                    "categories",
                ])
            )
            ->paginate(50);

        return view('posts.index', [
            "currentCategory" => $currentCategory,
            "posts" => $posts,
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            "post" => $post,
        ]);
    }
}
