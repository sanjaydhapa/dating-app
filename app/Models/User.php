<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use Laravel\Fortify\TwoFactorAuthenticatable;
//use Laravel\Jetstream\HasProfilePhoto;
//use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    //use HasProfilePhoto;
    use Notifiable;
    //use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'nick_name',
        'profile_photo_path',
        'fcm_token',
        'freeze_account',
        'is_online',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
       // 'profile_photo_url',
    ];


    public function kyc()
    {
        return $this->hasOne(UserKycInfo::class);
    }
    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }
    public function likes()
    {
        return $this->hasMany(UserLike::class);
    }

    public function blocks()
    {
        return $this->hasMany(UserBlock::class);
    }
    public function comments()
    {
        return $this->hasMany(UserComment::class);
    }

    public function feeds()
    {
        return $this->hasMany(Feed::class);
    }

    public function feedComments()
    {
        return $this->hasMany(Comment::class);
    }

    public function feedLikes()
    {
        return $this->hasMany(Like::class);
    }

    public function actionFromCurrentUser()
    {
        return $this->hasOne(UserAction::class, 'target_user_id', 'id')
            ->where('user_id', auth()->id());
    }
    public function actionByCurrentUser()
    {
        return $this->hasOne(UserAction::class, 'target_user_id', 'id')
            ->where('user_id', auth()->id());
    }


    public function viewCount() {
        return $this->hasMany(UserAction::class, 'target_user_id')->where('is_view', 1);
    }



}
