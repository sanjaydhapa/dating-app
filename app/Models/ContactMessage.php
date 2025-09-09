<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = ['user_id', 'message', 'reply'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

