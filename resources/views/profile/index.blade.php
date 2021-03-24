@extends('templates.default')

@section('content')
<div class="row">
  <div class="col-lg-5">
    @include('search.usersearch')
    <hr>
    @if (! $statuses->count() )
    <p>{{$user->UserName()}} ничего не опубликовал!</p>
    @else
    @foreach($statuses as $status)
    <div class="media">
      <div class="mr-3">
        <a href="{{ route('profile.index', ['username' => $status->user->username])}}">
          <img class="media-object rounded" src="{{$status->user->GetImage() }}" alt="{{$status->user->UserName()}}">
        </a>
        <div class="media-body">
          <h4>
            <a href="{{ route('profile.index', ['username' => $status->user->username])}}">{{$status->user->UserName()}}</a>
          </h4>
          <p>{{$status->body}}</p>
          <ul class="list-inline">
            <li class="list-inline-item">{{$status->created_at->diffForHumans()}}</li>
            <li class="list-inline-item">
              <a href=""></a>
            </li>
            <li class="list-inline-item"></li>
          </ul>

          @foreach($status->replies as $reply)
          <a href="{{ route('profile.index', ['username' => $reply->user->username])}}">
            <img class="media-object rounded" src="{{$reply->user->GetImage() }}" alt="{{$reply->user->UserName()}}">
          </a>
          <div class="media-body">
            <h4>
              <a href="{{ route('profile.index', ['username' => $reply->user->username])}}">{{$reply->user->UserName()}}</a>
            </h4>
            <p>{{$reply->body}}</p>
            <ul class="list-inline">
              <li class="list-inline-item">{{$reply->created_at->diffForHumans()}}</li>
              <li class="list-inline-item">
                <a href=""></a>
              </li>
              <li class="list-inline-item"></li>
            </ul>
          </div>

          @endforeach

          @if($UserIsFriend || Auth::user()->id === $status->user->id)
          <form method="POST" action="{{ route('status.out', ['statusId' => $status->id]) }}" class="mb-4">
            @csrf
            <div class="form-group">
              <textarea name="reply-{{$status->id}}" class="form-control {{$errors->has("reply-{$status->id}") ? ' is-invalid' : '' }} " placeholder="Прокомментировать" rows="3"></textarea>
              @if ($errors->has("reply-{$status->id}"))
              <div class="invalid-feedback">
                {{ $errors->first("reply-{$status->id}") }}
              </div>
              @endif
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Отправить</button>
          </form>
          @endif

        </div>
      </div>
      @endforeach
      @endif
    </div>
    </div>

    <div class="col-lg-4 col-lg-offset-3">
      @if (Auth::user()->AddFriendPending($user))
      <p>{{ $user->UserName() }} должен подтвердить запрос</p>
      @elseif(Auth::user()->FriendReceived($user))
      <a href="{{route('friends.accept',['username'=> $user->username])}}" class="btn btn-primary mb-2">Подтвердить дружбу</a>
      @elseif(Auth::user()->isFriend($user))
      <p>{{ $user->UserName()  }} у вас в друзьях</p>

      <form action="{{ route('friends.delete',['username' => $user->username])}}" method="POST">
        @csrf
        <input type="submit" class="btn btn-promary my-2" value="Удалить из друзей">
      </form>
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