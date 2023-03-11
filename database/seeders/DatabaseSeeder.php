<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = Category::factory(10)->create();
        $posts = Post::factory(30)->create();
        $users = User::factory(10)->create();

        $posts->each(function($post) use ($categories) {
            $post->categories()->attach(
                $categories->random(rand(2, 3))->pluck("id")->toArray(),
            );
        });

        $users->each(function($user) use ($categories) {
            $user->subscribedCategories()->attach(
                $categories->random(rand(3, 5))->pluck("id")->toArray(),
            );
        });
    }
}
