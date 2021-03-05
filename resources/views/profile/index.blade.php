@extends('templates.default')

@section('content')
<div class="row">
   <div class="col-lg-5">
      @include('search.usersearch')
   </div>

   <div class="col-lg-4 col-lg-offset-3">

      @if (Auth::user()->AddFriendPending($user))
           <p>{{ $user->UserName() }} должен подтвердить запрос</p>
      @elseif(Auth::user()->FriendReceived($user))
           <a href="{{route('friends.accept',['username'=> $user->username])}}" class="btn btn-primary mb-2">Подтвердить дружбу</a>
      @elseif(Auth::user()->isFriend($user))
           <p>{{ $user->UserName()  }} у вас в друзьях</p>
      @elseif(Auth::user()->id !== $user->id)
           <a href="{{route('friends.add',['username'=> $user->username])}}" class="btn btn-primary mb-2">Добавить в друзья</a>
      @endif
      
      <h4>{{ $user->username }} друзья</h4>

      @if (!$user->friends()->count())
           <p>{{ $user->username }} нет друзей</p>
      @else
         @foreach($user->friends() as $user)
           @include('search.usersearch')
         @endforeach
      @endif
   </div>
</div>

@endsection