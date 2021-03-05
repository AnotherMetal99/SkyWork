<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'first_name',
        'last_name',
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
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function GetImage()
    {
        return "https://www.gravatar.com/avatar/{{md5($this->email}}?d=mm&s50";
    }

    # устанавливаем отношение многие ко многим, мои друзья
    public function Follower()
    {
        return $this->belongsToMany('App\Models\User', 'friends', 'user_id', 'friend_id');    
    }

    # устанавливаем отношение многие ко многим, друг
    public function Unfollower() {
        return $this->belongsToMany('App\Models\User', 'friends', 'friend_id', 'user_id');
    }

    # получить друзей
    public function friends()
    {
        return $this->Follower()->wherePivot('accepted', true)->get()
           ->merge( $this->Unfollower()->wherePivot('accepted', true)->get() );
    }
}
