<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        "body",
        "category_id",
        "excerpt",
        "slug",
        "title",
        "thumbnail",
        "user_id",
    ];

    protected $with = [
        "author",
        "category",
    ];

    public function scopeFilter(\Illuminate\Database\Eloquent\Builder $query, array $filters = [])
    {
        $query->when($filters["author"] ?? false, function($query, $author) {
            $query
                ->whereHas("author", fn($query) => $query->where("username", $author));
        });

        $query->when($filters["category"] ?? false, function($query, $category) {
            $query
                ->whereHas("category", fn($query) => $query->where("slug", $category));
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

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
