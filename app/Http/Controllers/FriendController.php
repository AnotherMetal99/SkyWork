<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function GetIndex()
    {
        $friends = Auth::user()->friends();
        $requests = Auth::user()->FriendFollow();
        return view('friends.index',[
            'friends' => $friends,
            'requests' => $requests
        ]);
    }

    public function GetAdd($username)
    {
     $user = User::where('username',$username)->first();

      if(!$user){
        return redirect()
          ->route('home')
          ->with('info','Пользователь не найден');
      }

      if(Auth::user()->id === $user->id){
        return redirect()->route('home');
      }

      if(Auth::user()->AddFriendPending($user)
        || $user->AddFriendPending(Auth::user() ) ){
            return redirect()
              ->route('profile.index',['username'=>$user->username])
              ->with('info','Пользователю отправлен запрос в друзья!');
      }

      if(Auth::user()->isFriend($user)){
            return redirect()
              ->route('profile.index',['username'=>$user->username])
              ->with('info','Пользователь в друзьях!');
      }

      Auth::user()->AddFriend($user);

      return redirect()
              ->route('profile.index',['username'=>$username])
              ->with('info','Пользователю отправлен запрос в друзья!');
    }

    public function GetAccept($username)
    {
        $user = User::where('username',$username)->first();
        
        if(!$user){
            return redirect()
              ->route('home')
              ->with('info','Пользователь не найден');
          }
          if(!Auth::user()->FriendReceived($user)){
             return redirect()->route('home');
          }

          Auth::user()->AcceptFriend($user);

          return redirect()
              ->route('home')
              ->with('info','Запрос принят');
    }
}
