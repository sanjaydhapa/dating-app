<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class OtpCode extends Model
{
    protected $fillable = ['mobile', 'email', 'otp', 'expires_at'];
    public $timestamps = true;
}
