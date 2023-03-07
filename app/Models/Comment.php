<?php

namespace App\Models;

use App\Events\Comment\Created as CommentCreatedEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

/*    protected $dispatchesEvents = [
        "created" => CommentCreatedEvent::class,
    ];*/

    protected $fillable = [
        "body",
        "post_id",
        "user_id",
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
