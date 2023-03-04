<?php

namespace App\Models;

use App\Events\Post\Created as PostCreatedEvent;
use App\Events\Post\Deleted as PostDeletedEvent;
use App\Events\Post\Updated as PostUpdatedEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        "body",
        "excerpt",
        "slug",
        "title",
        "thumbnail",
        "user_id",
    ];

    protected $dispatchesEvents = [
        "created" => PostCreatedEvent::class,
        "deleted" => PostDeletedEvent::class,
        "updated" => PostUpdatedEvent::class,
    ];

    protected $with = [
        "author",
        "categories",
    ];

    public function scopeFilter(\Illuminate\Database\Eloquent\Builder $query, array $filters = [])
    {
        $query->when($filters["author"] ?? false, function($query, $author) {
            $query
                ->whereHas("author", fn($query) => $query->where("username", $author));
        });

        $query->when($filters["category"] ?? false, function($query, $category) {
            $query
                ->whereHas("categories", fn($query) => $query->where("id", $category));
        });

        $query->when($filters["search"] ?? false, function($query, $search) {
            $query
                ->where(function($query) use ($search) {
                    $query
                        ->where("title", "like", "%" . $search . "%")
                        ->orWhere("body", "like", "%" . $search . "%");
                });
        });
    }

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
}
