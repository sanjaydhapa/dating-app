<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserComment extends Model
{
    use HasFactory;
    protected $fillable = [
        'target_user_id',
        'user_id',
        'comment',
        // Add any other mass-assignable fields you use
    ];
}
