<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use
        HasFactory,
        Searchable
    ;

    protected $fillable = [
        "body",
        "excerpt",
        "slug",
        "title",
        "thumbnail",
        "user_id",
    ];

    protected $with = [
        "author",
        "categories",
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function categoryIds(): array
    {
        return $this->categories()->pluck("id")->toArray();
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * accessor for calling $post->subscribers
     **/
    public function getSubscribersAttribute()
    {
        return $this->categories()->with("subscribers")->get()->flatMap(function($category) {
            return $category->subscribers;
        })->keyBy("email");
    }

    public function searchWithFilters(string $phrase, array $filters): \Laravel\Scout\Builder
    {
        $queryBuilder = $this->search($phrase);

        foreach ($filters as $key => $values) {
            $queryBuilder->whereIn($key, (array) $values);
        }

        return $queryBuilder;
    }

    public function toSearchableArray(): array
    {
        return [
            "id" => $this->id,
            "author" => $this->author->username,
            "categories" => $this->categories->pluck("name")->toArray(),
            "excerpt" => $this->excerpt,
            "slug" => $this->slug,
            "title" => $this->title,
        ];
    }
}
