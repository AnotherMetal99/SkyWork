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

    public function UserName() 
    {
        return $this->first_name ?: $this->username;
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

    public function FriendFollow()
    {
        return $this->Follower()->wherePivot('accepted', false)->get();
    }
    # запрос на ожидание друга 
    public function FriendPending()
    {
        return $this->Unfollower()->wherePivot('accepted', false)->get();
    }

    # запрос на добавление в друзья
    public function AddFriendPending(User $user)
    {
        return (bool) $this->FriendPending()->where('id', $user->id)->count();
    }

    # получить запрос о дружбе
    public function FriendReceived(User $user)
    {
        return (bool) $this->FriendFollow()->where('id', $user->id)->count();
    }

    # добавить друга
    public function AddFriend(User $user)
    {
        $this->Unfollower()->attach($user->id);
    }

    # принять запрос дружбы
    public function AcceptFriend(User $user)
    {
        $this->FriendFollow()->where('id', $user->id)->first()->pivot->update([
            'accepted' => true
        ]);
    }
    # дружбa
    public function isFriend(User $user)
    {
      return (bool) $this->friends()->where('id', $user->id)->count();
    }

}
