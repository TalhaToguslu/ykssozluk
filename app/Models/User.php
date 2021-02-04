<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        'profile_photo_url',
    ];

    public function getTitle(){
      return $this->hasMany('App\Models\titleModel',"user_id","id");
    }

    public function getEntry(){
      return $this->hasMany('App\Models\entryModel',"user_id","id");
    }

    public function getLike(){
      return $this->hasMany('App\Models\entrylikesModel',"user_id","id");
    }

    public function getdisLike(){
      return $this->hasMany('App\Models\entrydislikesModel',"user_id","id");
    }

    public function getReplyLike(){
      return $this->hasMany('App\Models\replylikesModel',"user_id","id");
    }

    public function getReplydisLike(){
      return $this->hasMany('App\Models\replydislikesModel',"user_id","id");
    }
}
