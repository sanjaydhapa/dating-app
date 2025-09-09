<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserKycInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'country',
        'id_type',
        'id_document',
        'user_photo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
