<?php

namespace App\Models;

use App\Notifications\MyResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'AspNetUsers';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'UserName'
        ,'NormalizedUserName'
        ,'Email'
        ,'NormalizedEmail'
        ,'EmailConfirmed'
        ,'PasswordHash'
        ,'SecurityStamp'
        ,'ConcurrencyStamp'
        ,'PhoneNumber'
        ,'PhoneNumberConfirmed'
        ,'TwoFactorEnabled'
        ,'LockoutEnd'
        ,'LockoutEnabled'
        ,'AccessFailedCount'
        ,'RefreshToken'
        ,'RefreshTokenExpiryTime'
        ,'FirstUse'
        ,'Online'
        ,'LastPasswordChange'
        ,'ProfilePic'
        ,'ConfirmedAccount'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function getIsAdminAttribute()
    {
        return true;
    }
    public function coupons()
    {
        return $this->hasMany('App\Models\UserCoupon' , 'user_id' , 'id');
    }
    public function Nation()
    {
        return $this->belongsTo('App\Models\Nation' , 'country_id' , 'id');
    }
    public function Member()
    {
        return $this->belongsTo('App\Models\Member' , 'employee_id' , 'ID');
    }


    public function articles()
    {
        return $this->hasMany('App\Models\Article' , 'user_id' , 'id');
    }

    public function accepted_articles()
    {
        return $this->hasMany('App\Models\Article' , 'user_id' , 'id')->whereIsAccepted('1');
    }
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer' , 'employee_id' , 'ID');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MyResetPassword($token));
    }

}
