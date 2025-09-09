<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feed extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'text', 'media_path', 'media_type', 'is_private',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function feedComments()
    {
        return $this->hasMany(Comment::class);
    }

    public function feedLikes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
}
