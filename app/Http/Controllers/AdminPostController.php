<?php

namespace App\Http\Controllers;

use App\Events\Post\Created as PostCreatedEvent;
use App\Events\Post\Deleted as PostDeletedEvent;
use App\Events\Post\Updated as PostUpdatedEvent;
use App\Models\Post;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    protected \Illuminate\Events\Dispatcher $dispatcher;

    public function __construct(\Illuminate\Events\Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function create()
    {
        return view("admin.posts.create");
    }

    public function destroy(Post $post)
    {
        $post->delete();

        $this->dispatcher->dispatch(new PostDeletedEvent($post));

        return back()->with("success", "Post deleted!");
    }

    public function edit(Post $post)
    {
        return view("admin.posts.edit", [
            "post" => $post,
        ]);
    }

    public function index()
    {
        return view("admin.posts.index", [
            "posts" => Post::paginate(50),
        ]);
    }

    public function store()
    {
        $post = new Post();

        $validated = request()->validate(
            $this->validationRulesForPost($post),
        );

        $validated["thumbnail"] = request()->file("thumbnail")->store("thumbnails");
        $validated["user_id"] = auth()->id();

        $post->create($validated);

        $this->dispatcher->dispatch(new PostCreatedEvent($post));

        return back()->with("success", "Post Created!");
    }

    public function update(Post $post)
    {
        $validated = request()->validate(
            $this->validationRulesForPost($post),
        );

        if (isset($validated["thumbnail"])) {
            $validated["thumbnail"] = request()->file("thumbnail")->store("thumbnails");
        }

        $post->update($validated);

        $this->dispatcher->dispatch(new PostUpdatedEvent($post));

        return back()->with("success", "Post Updated!");
    }

    protected function validationRulesForPost(Post $post): array
    {
        return [
            "body" => "required|string",
            "category_id" => ["required", Rule::exists("categories", "id")],
            "excerpt" => "required|string",
            "slug" => ["required", Rule::unique("posts", "slug")->ignore($post)],
            "title" => "required|string",
            "thumbnail" => $post->exists ? ["image"] : ["required", "image"],
        ];
    }
}
