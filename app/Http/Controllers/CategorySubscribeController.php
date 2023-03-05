<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategorySubscribeController extends Controller
{
    public function destroy(Category $category)
    {
        $category->subscribers()->detach(request()->user());

        return back()
            ->with("success", "You are now ubsubscribed from the {$category->name} category.");
    }

    public function store(Category $category)
    {
        $category->subscribers()->attach(request()->user());

        return back()
            ->with("success", "You are now subscribed to the {$category->name} category.");
    }
}
